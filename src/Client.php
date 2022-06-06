<?php

namespace OzonRocketSDK;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use \OzonRocketSDK\{AuthException,OzonRocketException,RequestException};
use InvalidArgumentException;

final class Client
{
    /**
     * Аккаунт сервиса интеграции
     * @var string
     */
    private string $account;

    /**
     * Тип Аккаунта
     * @var string
     */
    private string $account_type;

    /**
     * Секретный пароль сервиса интеграции
     * @var string
     */
    private string $secure;

    /**
     * Authorization: Bearer Токен
     * @var string
     */
    private string $token;

    /**
     * URL для получения токена
     * @var string
     */
    private string $token_url;

    /**
     * URL для рабочей среды
     * @var string
     */
    private string $base_url;

    /**
     * Настройки. Массив сохранения.
     * @var array
     */
    private array $memory;

    /**
     * Коллбэк сохранения токена
     * @var callable
     */
    private $memory_save_fu;

    /** @var int */
    private $expire = 0;

    /** @var GuzzleClient */
    private GuzzleClient $http;


    /**
     * @param string $account - Логин Account в сервисе Интеграции
     * @param string|null $secure - Пароль Secure password в сервисе Интеграции
     * @param float|null $timeout - Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго (поведение по умолчанию)
     */
    public function __construct(string $account, ?string $secure = null, ?float $timeout = 5.0)
    {
        if ($account == 'TEST') {
            $this->token_url = Constants::API_TOKEN_TEST_URL;
            $this->account = Constants::TEST_CLIENT_ID;
            $this->secure = Constants::TEST_CLIENT_SECRET;
            $this->account_type = Constants::GRANT_TYPE;
            $this->base_url = Constants::API_URL_TEST;
            $this->http = new GuzzleClient([
                'base_url' => $this->base_url,
                'timeout' => $timeout,
                'http_errors' => false
            ]);
        } else {
            $this->token_url = Constants::API_TOKEN_URL;
            $this->account = $account;
            $this->secure = $secure;
            $this->account_type = Constants::GRANT_TYPE;
            $this->base_url = Constants::API_URL;
            $this->http = new GuzzleClient([
                'base_url' => $this->base_url,
                'timeout' => $timeout,
                'http_errors' => false
            ]);
        }
    }


    /**
     * Выполняет вызов к API.
     */
    private function apiRequest(string $type, string $uri, $params = null)
    {
        // Авторизуемся или получаем данные из кэша\сессии
        if ($this->checkSavedToken() == false) {
            $this->authorize();
        }

        // Проверяем является ли запрос на файл pdf
        $is_pdf_file_request = strpos($uri, '.pdf');

        if ($is_pdf_file_request !== false) {
            $headers['Accept'] = 'application/pdf';
        } else {
            $headers['Accept'] = 'application/json';
        }

        $headers['authorization'] = 'Bearer '.$this->token;

        if ( ! empty($params) && is_object($params)) {
            $params = $params->prepareRequest();
        }

        switch ($type) {
            case 'GET':
                $response = $this->http->get($uri, ['query' => $params, 'headers' => $headers]);
                break;
            case 'DELETE':
                $response = $this->http->delete($uri, ['headers' => $headers]);
                break;
            case 'POST':
                $response = $this->http->post($uri, ['json' => $params, 'headers' => $headers]);
                break;
            case 'PATCH':
                $response = $this->http->patch($uri, ['json' => $params, 'headers' => $headers]);
                break;
        }
        // Если запрос на файл pdf был успешным сразу отправляем его в ответ
        if ($is_pdf_file_request) {
            if ($response->getStatusCode() == 200) {
                if (strpos($response->getHeader('Content-Type')[0], 'application/pdf') !== false) {
                    return $response->getBody();
                }
            }
        }
        $json = $response->getBody()->getContents();
        $apiResponse = json_decode($json, true);

        $this->checkErrors($uri, $response, $apiResponse);

        return $apiResponse;
    }

    private function authorize(): bool
    {
        $param = [
            Constants::AUTH_KEY_TYPE => $this->account_type,
            Constants::AUTH_KEY_CLIENT_ID => $this->account,
            Constants::AUTH_KEY_SECRET => $this->secure,
        ];
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $this->http->post(
            $this->token_url,
            [
                'form_params' => $param,
                'headers' => $headers,
            ]
        );

        if ($response->getStatusCode() == 200) {
            $token_info = json_decode($response->getBody());
            $this->token = $token_info->access_token ?? '';
            $this->expire = $token_info->expires_in ?? 0;
            $this->expire = (int) (time() + $this->expire - 10);

            if (!empty($this->memory_save_fu)) {
                $this->saveToken($this->memory_save_fu);
            }

            return true;
        }
        throw new Exception(Constants::AUTH_FAIL);
    }

    private function checkSavedToken()
    {
        $check_memory = $this->getMemory();

        // Если не передан верный сохраненный массив данных для авторизации, функция возвратит false
        if ( ! isset($check_memory['account_type'])
            || empty($check_memory)
            || ! isset($check_memory['expires_in'])
            || ! isset($check_memory['access_token'])) {
            return false;
        }

        // Если не передан верный сохраненный массив данных для авторизации,
        // но тип аккаунта не тот, который был при прошлой сохраненной авторизации - функция возвратит false
        if (isset($check_memory['account_type']) && $check_memory['account_type'] !== $this->account_type) {
           return false;
        }

        return ($check_memory['expires_in'] > time() && !empty($check_memory['access_token']))
            ? $this->setToken($check_memory['access_token'])
            : false;
    }

    private function saveToken(callable $fu)
    {
        return $fu(['ozonAuth' => [
            'access_token' => $this->token,
            'account_type' => $this->account_type, ]]);
    }

    public function setMemory(?array $memory, callable $fu)
    {
        $this->memory = $memory;
        $this->memory_save_fu = $fu;

        return $this;
    }

    private function getMemory()
    {
        return $this->memory;
    }

    private function getToken(): string
    {
        if (empty($this->token)) {
            throw new InvalidArgumentException('Не передан API-токен!');
        }

        return $this->token;
    }

    private function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }


    private function checkErrors($method, $response, $apiResponse): bool
    {
        if (empty($apiResponse)) {
            throw new Exception('От API OZON при вызове метода '.$method.' пришел пустой ответ', $response->getStatusCode());
        }
        if (
            $response->getStatusCode() > 202 && isset($apiResponse['requests'][0]['errors'])
            || isset($apiResponse['requests'][0]['state']) && $apiResponse['requests'][0]['state'] == 'INVALID'
        ) {
            throw new Exception('От API OZON при вызове метода '.$method.' получена ошибка: ', $response->getStatusCode());
        }
        if (
            $response->getStatusCode() == 200 && isset($apiResponse['errors'])
            || isset($apiResponse['state']) && $apiResponse['state'] == 'INVALID' || $response->getStatusCode() !== 200 && isset($apiResponse['errors'])
        ) {
            throw new Exception('От API OZON при вызове метода '.$method.' получена ошибка: ', $response->getStatusCode());
        }
        if ($response->getStatusCode() > 202 && ! isset($apiResponse['requests'][0]['errors'])) {
            throw new Exception('Неверный код ответа от сервера OZON при вызове метода 
             '.$method.': '.$response->getStatusCode(), $response->getStatusCode());
        }

        return false;
    }


    /**
     * @return array
     */
    public function getTariffList(): array
    {
        $response = $this->apiRequest('GET', $this->base_url.Constants::TARIFF_LIST_URL, []);
        var_dump($response);
        /*$resp = [];
        foreach ($response['items'] as $key => $value) {
            $resp[] = new Tariff\TariffList($value);
        }

        return $resp;*/
    }

}