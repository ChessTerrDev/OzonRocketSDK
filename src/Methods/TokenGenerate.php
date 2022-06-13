<?php

namespace OzonRocketSDK\Methods;

use OzonRocketSDK\Client\Constants;

class TokenGenerate extends AbstractMethod
{
    /**
     * Authorization: Bearer Токен
     * @var string
     */
    private string $token;

    /**
     * Тип Аккаунта
     * @var string
     */
    private string $account_type = Constants::GRANT_TYPE;

    /** @var int */
    private $expire = 0;

    public function __construct($account, $secure, $gizzleAdapter)
    {
        if ($this->getTokenFromSession()) return $this;

        if ($account == 'TEST') {
            $param = [
                Constants::AUTH_KEY_TYPE => Constants::GRANT_TYPE,
                Constants::AUTH_KEY_CLIENT_ID => Constants::TEST_CLIENT_ID,
                Constants::AUTH_KEY_SECRET => Constants::TEST_CLIENT_SECRET,
            ];
        } else {
            $param = [
                Constants::AUTH_KEY_TYPE => Constants::GRANT_TYPE,
                Constants::AUTH_KEY_CLIENT_ID => $account,
                Constants::AUTH_KEY_SECRET => $secure,
            ];
        }
        parent::__construct($param, $gizzleAdapter);

        $token_info = $this->request();

        $this->token = $token_info->access_token ?? '';
        $this->expire = $token_info->expires_in ?? 0;
        $this->expire = (int)(time() + $this->expire - 10);

        if (!empty($this->token))
            $this->saveTokenToSession();

        return $this;
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

    public function getToken():string
    {
        return $this->token;
    }
}