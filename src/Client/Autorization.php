<?php

namespace OzonRocketSDK\Client;

use GuzzleHttp\Client as GuzzleClient;
use OzonRocketSDK\Client\Map;
use OzonRocketSDK\Constants;

class Autorization
{
    /**
     * АЛогин Account в сервисе Интеграции
     * @var string
     */
    private string $account;

    /**
     * Тип Аккаунта
     * @var string
     */
    private string $account_type;

    /**
     * Пароль Secure password в сервисе Интеграции
     * @var string
     */
    private string $secure;

    /**
     * Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго (поведение по умолчанию)
     * @var float
     */
    private float $timeout;

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
     * URL адрес рабочей среды
     * @var string
     */
    private string $base_uri;


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

    /**
     * @var \OzonRocketSDK\Client\Map
     */
    private \OzonRocketSDK\Client\Map $map;


    /**
     * @param string $account - Логин Account в сервисе Интеграции
     * @param string|null $secure - Пароль Secure password в сервисе Интеграции
     * @param float|null $timeout - Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго (поведение по умолчанию)
     */
    public function __construct(string $account, ?string $secure, ?float $timeout = 5.0)
    {
        if ($account == 'TEST') {
            $this->map = new Map('TEST');
            $this->token_url = $this->map->getMap('tokenGenerate');
            $this->base_uri = $this->map->getBaseURL();

            $this->account = Constants::TEST_CLIENT_ID;
            $this->secure = Constants::TEST_CLIENT_SECRET;
            $this->account_type = Constants::GRANT_TYPE;
        } else {
            $this->map = new Map();
            $this->token_url = $this->map->getMap('tokenGenerate');
            $this->base_uri = $this->map->getBaseURL();

            $this->account = $account;
            $this->secure = $secure;
            $this->account_type = Constants::GRANT_TYPE;
        }
        $this->timeout = $timeout;

    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(): string
    {
        // Проверяем наличие токена в сессии, есть - отдаем из сессии
        if (!$this->getTokenFromSession()) {
            // Авторизуемся и получаем token
            $this->authorize();
        }

        return $this->token;
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function authorize(): void
    {
        $http = new GuzzleClient([
            'base_uri' => $this->base_uri,
            'timeout' => $this->timeout,
            'http_errors' => false,
        ]);
        $param = [
            Constants::AUTH_KEY_TYPE => $this->account_type,
            Constants::AUTH_KEY_CLIENT_ID => $this->account,
            Constants::AUTH_KEY_SECRET => $this->secure,
        ];
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        $response = $http->post(
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
            $this->expire = (int)(time() + $this->expire - 10);

            if (!empty($this->token))
                $this->saveTokenToSession();

            return;
        }
        throw new \Exception(Constants::AUTH_FAIL);
    }


    /**
     * @return void
     */
    private function saveTokenToSession(): void
    {
        if (!session_id()) session_start();
        $_SESSION['ozonAuth'] = [
            'expires_in' => $this->expire, // здесь будет сохранено время до исчерпания срока действия токэна
            'access_token' => $this->token, // здесь будет сохранен токэн
            'account_type' => $this->account_type, // здесь будет тип среды
        ];
    }

    private function getTokenFromSession()
    {
        if (!isset($_SESSION['ozonAuth'])) return false;

        $check_memory = $_SESSION['ozonAuth'];

        // Если не передан верный сохраненный массив данных для авторизации, функция возвратит false
        if (!isset($check_memory['account_type'])
            || empty($check_memory)
            || !isset($check_memory['expires_in'])
            || !isset($check_memory['access_token'])) return false;

        // Если не передан верный сохраненный массив данных для авторизации,
        // но тип аккаунта не тот, который был при прошлой сохраненной авторизации - функция возвратит false
        if ($check_memory['account_type'] !== $this->account_type) {
            return false;
        }

        return ($check_memory['expires_in'] > time() && !empty($check_memory['access_token']))
            ? $this->setToken($check_memory['access_token'])
            : false;

    }

    /**
     * @param string $token
     * @return $this
     */
    private function setToken(string $token)
    {
        $this->token = $token;
        echo "\n токен получен из сессии \n";
        return $this;
    }
}