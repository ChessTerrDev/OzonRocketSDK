<?php

namespace OzonRocketSDK\Methods;

use OzonRocketSDK\Adapter\GuzzleAdapter;

abstract class AbstractMethod
{
    /**
     * @var GuzzleAdapter
     */
    protected GuzzleAdapter $guzzleAdapter;

    /**
     * @var string
     */
    protected string $method;

    /**
     * @var array
     */
    protected array $dataPost = [];

    /**
     * @var array
     */
    protected array $dataGet = [];


    /**
     * @throws \Exception
     */
    public function __construct($data, $guzzleAdapter)
    {
        $this->guzzleAdapter = $guzzleAdapter;
        if ($data) {
            if (is_object($data)) {
                $this->setData($data->getFields());
            } elseif (is_array($data)) {
                $this->setData($this->parseFields($data));
            } else {
                $this->setData($data);
            }
        }
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    public function setData($data)
    {
        switch($this->guzzleAdapter->getRequestType())
        {
            case 'PUT':
            case 'FORM':
            case 'POST':
                $this->setDataPost($data);
                break;
            case 'GET':
                $this->setDataGet($data);
                break;
            default:
                throw new \Exception('Для пользовательского типа запрос post и получение данных должны быть установлены вручную');
        }
    }


    /**
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        switch($this->guzzleAdapter->getRequestType())
        {
            case 'GET':
                return $this->guzzleAdapter->get($this->getDataGet());
            case 'DELETE':
                return $this->guzzleAdapter->delete();
            case 'FORM':
                return $this->guzzleAdapter->form($this->getDataPost());
            case 'PUT':
                return $this->guzzleAdapter->put($this->getDataPost());
            case 'POST':
            default:
                return $this->guzzleAdapter->post($this->getDataPost());
        }
    }

    /**
     * @return array
     */
    public function getDataPost(): array
    {
        return $this->dataPost;
    }

    /**
     * @param $dataPost
     * @return void
     */
    public function setDataPost($dataPost)
    {
        $this->dataPost = $dataPost;
    }

    /**
     * @return array
     */
    public function getDataGet(): array
    {
        return $this->dataGet;
    }

    /**
     * @param array $dataGet
     */
    public function setDataGet(array $dataGet)
    {
        $this->dataGet = $dataGet;
    }

    /**
     * @return mixed
     */
    public function getEntityFields($entity)
    {
        if($entity) return $entity->getFields();

        return false;
    }

    /**
     * @param array $data
     * @return array
     */
    private function parseFields(array $data): array
    {
        return (new \OzonRocketSDK\Entity\AbstractEntity())->parseFields($data);
    }
}