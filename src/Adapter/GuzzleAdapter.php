<?php

namespace OzonRocketSDK\Adapter;

use GuzzleHttp\Client as GuzzleClient;
use OzonRocketSDK\Client\Constants;
use OzonRocketSDK\Exceptions\OzonRocketException;

class GuzzleAdapter
{
    /**
     * @var GuzzleClient
     */
    protected GuzzleClient $http;

    /**
     * @var string
     */
    protected string $url;

    /**
     * @var string
     */
    protected string $requestType;

    /**
     * @var array
     */
    protected array $headers = [];


    /**
     * @var string
     */
    protected string $method = 'unconfigured_request';

    private float $timeout;

    private string $token;


    public function __construct(?float $timeout = 5.0)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return void
     */
    private function guzzleInit()
    {
        $this->http = new GuzzleClient([
            'base_uri' => $this->url,
            'timeout' => $this->timeout,
            'http_errors' => false,
        ]);
    }

    /**
     * @param $param
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function form($param)
    {
        $this->guzzleInit();
        $this->appendHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);

        $response = $this->http->post(
            $this->url,
            [
                'form_params' => $param,
                'headers' => $this->headers
            ]
        );
        if ($response->getStatusCode() == 200) return json_decode($response->getBody());

        throw new \Exception(Constants::AUTH_FAIL);
    }


    /**
     * @param $param
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function post($param)
    {
        $this->guzzleInit();
        $this->appendHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer ' . $this->token
        ]);
        //var_dump(json_encode($param));
        $response = $this->http->post($this->url, ['headers' => $this->headers, 'json' => $param]);

        $apiResponse = json_decode($response->getBody()->getContents(), true);

        $this->checkErrors($this->url, $response, $apiResponse);

        return $apiResponse;
    }


    /**
     * @param $param
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function get($param)
    {
        $this->guzzleInit();
        $this->appendHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer ' . $this->token
        ]);

        $response = $this->http->get($this->url, ['query' => $param, 'headers' => $this->headers]);
        $json = $response->getBody()->getContents();

        $apiResponse = json_decode($json, true);

        $this->checkErrors($this->url, $response, $apiResponse);

        return $apiResponse;
    }


    public function put($param)
    {
        print_r("Метод не реализован");
        var_dump($param);
        return false;
    }
    public function delete()
    {
        print_r("Метод не реализован");
        var_dump($this);
        return false;
    }


    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return
     */
    public function setUrl(string $url): GuzzleAdapter
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestType(): ?string
    {
        return $this->requestType;
    }

    /**
     * @param string $requestType
     * @return
     */
    public function setRequestType(string $requestType): GuzzleAdapter
    {
        $this->requestType = $requestType;
        return $this;
    }


    /**
     * @param array $headers
     * @return
     */
    public function appendHeaders(array $headers): GuzzleAdapter
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * @param string $method
     * @return
     */
    public function setMethod(string $method): GuzzleAdapter
    {
        $this->method = $method;
        return $this;
    }

    public function getToken():string
    {
        return $this->token;
    }
    public function setToken(string $token):void
    {
        $this->token = $token;
    }



    /**
     * @param $method
     * @param $response
     * @param $apiResponse
     * @return void
     * @throws \Exception
     */
    private function checkErrors($method, $response, $apiResponse): void
    {
        if (empty($apiResponse))
            throw new OzonRocketException(
                OzonRocketException::getErrorMessage($method, $apiResponse),
                $response->getStatusCode()
            );

        if ($response->getStatusCode() > 202 && isset($apiResponse['errorCode']) && isset($apiResponse['message']))
            throw new OzonRocketException(
                OzonRocketException::getErrorMessage($method, $apiResponse),
                $response->getStatusCode()
            );

        if ($response->getStatusCode() == 200 && isset($apiResponse['errorCode']) && isset($apiResponse['message']))
            throw new OzonRocketException(
                OzonRocketException::getErrorMessage($method, $apiResponse),
                $response->getStatusCode()
            );
    }
}