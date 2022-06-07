<?php

namespace OzonRocketSDK\Client;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use OzonRocketSDK\{AuthException, OzonRocketException, RequestException};
use OzonRocketSDK\Client\{Map, Autorization};
use OzonRocketSDK\Tariff\TariffList;
use OzonRocketSDK\Constants;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;

final class Client
{
    /**
     * Authorization: Bearer Токен
     * @var string
     */
    private string $token;

    /** @var int */
    private $expire = 0;

    /** @var GuzzleClient */
    private GuzzleClient $http;

    /** @var \OzonRocketSDK\Client\Map */
    private \OzonRocketSDK\Client\Map $map;


    /**
     * @param string $account - Логин Account в сервисе Интеграции
     * @param string|null $secure - Пароль Secure password в сервисе Интеграции
     * @param float|null $timeout - Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго (поведение по умолчанию)
     * @throws GuzzleException
     */
    public function __construct(string $account, ?string $secure = null, ?float $timeout = 5.0)
    {
        // Получает token
        $this->token = (new Autorization(
            $account,
            $secure,
            $timeout)
        )->getToken();
        if (empty($this->token))
            throw new InvalidArgumentException('Не передан API-токен!');


        if ($account == 'TEST') {
            $this->map = new Map('TEST');
            $this->http = new GuzzleClient([
                'base_uri' => $this->map->getBaseURL(),
                'timeout' => $timeout,
                'http_errors' => false,
            ]);
        } else {
            $this->map = new Map();
            $this->http = new GuzzleClient([
                'base_uri' => $this->map->getBaseURL(),
                'timeout' => $timeout,
                'http_errors' => false,
            ]);
        }
    }


    /**
     * Выполняет вызов к API.
     * @throws Exception
     * @throws GuzzleException
     */
    private function apiRequest(string $type, string $uri, $params = null)
    {

        // Проверяем является ли запрос на файл pdf
        $is_pdf_file_request = strpos($uri, '.pdf');

        if ($is_pdf_file_request !== false) {
            $headers['Accept'] = 'application/pdf';
        } else {
            $headers['Accept'] = 'application/json';
        }

        $headers['authorization'] = 'Bearer ' . $this->token;

        if (!empty($params) && is_object($params)) {
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



    /**
     * @param $method
     * @param $response
     * @param $apiResponse
     * @return bool
     * @throws Exception
     */
    private function checkErrors($method, $response, $apiResponse): bool
    {
        if (empty($apiResponse)) {
            throw new Exception('От API OZON при вызове метода ' . $method . ' пришел пустой ответ', $response->getStatusCode());
        }
        if (
            $response->getStatusCode() > 202 && isset($apiResponse['requests'][0]['errors'])
            || isset($apiResponse['requests'][0]['state']) && $apiResponse['requests'][0]['state'] == 'INVALID'
        ) {
            throw new Exception('От API OZON при вызове метода ' . $method . ' получена ошибка: ', $response->getStatusCode());
        }
        if (
            $response->getStatusCode() == 200 && isset($apiResponse['errors'])
            || isset($apiResponse['state']) && $apiResponse['state'] == 'INVALID' || $response->getStatusCode() !== 200 && isset($apiResponse['errors'])
        ) {
            throw new Exception('От API OZON при вызове метода ' . $method . ' получена ошибка: ', $response->getStatusCode());
        }
        if ($response->getStatusCode() > 202 && !isset($apiResponse['requests'][0]['errors'])) {
            throw new Exception('Неверный код ответа от сервера OZON при вызове метода 
             ' . $method . ': ' . $response->getStatusCode(), $response->getStatusCode());
        }

        return false;
    }


    /**
     * Метод возвращает полный список всех тарифов в системе OZON
     * @return array
     * @throws GuzzleException
     */
    public function getTariffList(): array
    {
        $response = $this->apiRequest('GET', $this->map->getMap('tariffList'), []);
        $resp = [];
        foreach ($response['items'] as $key => $value) {
            $resp[] = new TariffList($value);
        }

        return $resp;
    }



}