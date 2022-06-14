<?php
declare(strict_types=1);

namespace OzonRocketSDK\Client;

use Exception;
use OzonRocketSDK\Methods\{
    DeliveryCities,
    TokenGenerate,
    TariffList,
    DeliveryCitiesExtended,
    DeliveryVariants,
    DeliveryVariantsByAddress,
    DeliveryVariantsByViewport,
    DeliveryVariantsByIds,
    DeliveryVariantsByAddressShort,
    DeliveryCalculate,
    DeliveryCalculateMaterialWeight,
    DeliveryCalculateInformation,
    DeliveryFromPlaces,
    DeliveryReturnPlaces,
    DeliveryTime,
    DeliveryPickupPlaces

};
use OzonRocketSDK\Adapter\GuzzleAdapter;
use GuzzleHttp\Client as GuzzleClient;
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

    protected GuzzleAdapter $guzzleAdapter;


    /**
     * @param string $account - Логин Account в сервисе Интеграции
     * @param string|null $secure - Пароль Secure password в сервисе Интеграции
     * @param float|null $timeout - Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго (поведение по умолчанию)
     * @throws GuzzleException
     */
    public function __construct(string $account, ?string $secure = null, ?float $timeout = 5.0)
    {
        // Инициализируем карту URI API
        $this->map = new Map();
        if ($account == 'TEST') $this->map = new Map('TEST');

        $this->guzzleAdapter = new GuzzleAdapter($timeout);

        // Авторизуемся / получаем Token
        $this->tokenGenerate($account, $secure);
        if (empty($this->token))
            throw new InvalidArgumentException('Не передан API-токен!');

        // Ставим токен в gizzle
        $this->guzzleAdapter->setToken($this->token);
    }


    /**
     * @param string $method имя метода в api
     * @throws Exception
     */
    private function configureRequest(string $method): void
    {
        if($ar = $this->map->getMap($method, true))
        {
            $this->guzzleAdapter->setUrl($ar['URL']);
            $this->guzzleAdapter->setRequestType($ar['REQUEST_TYPE']);
            $this->guzzleAdapter->setMethod($method);
        }
        else
            throw new \Exception('Запрошенный метод "'.$method.'" не найден в карте модуля!');
    }


    /**
     * @param $account
     * @param $secure
     * @return void
     * @throws Exception
     */
    public function tokenGenerate($account, $secure): void
    {
        $this->configureRequest(__FUNCTION__);
        $tokenGenerate = new TokenGenerate($account, $secure, $this->guzzleAdapter);
        $this->token = $tokenGenerate->getToken();
    }

    /*--------------------------------------------------------------------------------------------------------------*/
    /*-----------------Deliveries-----------------------------------------------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------------*/
    /**
     * @param \OzonRocketSDK\Entity\Request\DeliveryVariants $data
     * @return mixed|void
     * @throws \Exception
     */
    public function deliveryVariants(\OzonRocketSDK\Entity\Request\DeliveryVariants $data)
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryVariants($data, $this->guzzleAdapter))->request();
    }


    /**
     * Получить способы доставки по адресу
     * @param \OzonRocketSDK\Entity\Request\DeliveryVariantsByAddress $data
     * @return mixed|void
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deliveryVariantsByAddress(\OzonRocketSDK\Entity\Request\DeliveryVariantsByAddress $data)
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryVariantsByAddress($data, $this->guzzleAdapter))->request();
    }

    /**
     * Получить способы доставки по viewport
     * Рекомендуем использовать метод для интегрирования виджета карты на сайт.
     * @param \OzonRocketSDK\Entity\Request\DeliveryVariantsByViewport $data
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryVariantsByViewport(\OzonRocketSDK\Entity\Request\DeliveryVariantsByViewport $data)
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryVariantsByViewport($data, $this->guzzleAdapter))->request();
    }

    /**
     * Получить способы доставки по идентификаторам
     * Метод для получения списка способов доставки по идентификаторам способов доставки.
     * @param \OzonRocketSDK\Entity\Request\DeliveryVariantsByIds | array $data = Идентификаторы способов доставки.
     * Значение id из ответа deliveryVariants()
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryVariantsByIds($data)
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryVariantsByIds($data, $this->guzzleAdapter))->request();
    }

    /**
     * @param \OzonRocketSDK\Entity\Request\DeliveryVariantsByAddressShort $data
     * @return false|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryVariantsByAddressShort(\OzonRocketSDK\Entity\Request\DeliveryVariantsByAddressShort $data)
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryVariantsByAddressShort($data, $this->guzzleAdapter))->request();
    }

    /**
     * Получение списка городов, в которые есть возможность доставлять
     * @return array
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deliveryCities(): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryCities($this->guzzleAdapter))->request();
    }

    /**
     * Получение расширенного списка городов, в которых принципалу доступны способы доставки.
     * @param $deliveryTypes = Способы доставки:
         * ExpressCourier - Express доставка курьером;
         * Courier — доставка курьером;
         * PickPoint — самовывоз;
         * Postamat — постамат.
     * @return array
     * @throws \Exception
     */
    public function deliveryCitiesExtended(array $deliveryTypes): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryCitiesExtended($deliveryTypes, $this->guzzleAdapter))->request();
    }

    /**
     * Рассчитать стоимости доставки
     * @param \OzonRocketSDK\Entity\Request\DeliveryCalculate $deliveryCalculate
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryCalculate(\OzonRocketSDK\Entity\Request\DeliveryCalculate $deliveryCalculate): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryCalculate($deliveryCalculate, $this->guzzleAdapter))->request();
    }

    /**
     * Рассчитать объёмный вес
     * @param array $packages [\OzonRocketSDK\Entity\Common\Package]
     * @return array = 'volumeWeight' => float 200000
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryCalculateMaterialWeight(array $packages): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryCalculateMaterialWeight($packages, $this->guzzleAdapter))->request();
    }

    /**
     * Рассчитать стоимость и срок доставки по адресу
     * @param \OzonRocketSDK\Entity\Request\DeliveryCalculateInformation $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryCalculateInformation(\OzonRocketSDK\Entity\Request\DeliveryCalculateInformation $data): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryCalculateInformation($data, $this->guzzleAdapter))->request();
    }

    /**
     * Получить место передачи отправлений DropOff на склад
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryFromPlaces(): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryFromPlaces($this->guzzleAdapter))->request();
    }

    /**
     * Получить информацию о складе возврата
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryReturnPlaces(): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryReturnPlaces($this->guzzleAdapter))->request();
    }

    /**
     * Получить информацию о сроках доставки
     * @param \OzonRocketSDK\Entity\Request\DeliveryTime $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function deliveryTime(\OzonRocketSDK\Entity\Request\DeliveryTime $data): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryTime($data, $this->guzzleAdapter))->request();
    }

    /**
     * Получить список складов пикапа
     * @return array
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deliveryPickupPlaces(): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new DeliveryPickupPlaces($this->guzzleAdapter))->request();
    }















    /**
     * Метод возвращает полный список всех тарифов в системе OZON
     * @return array
     * @throws \Exception
     */
    public function tariffList(): array
    {
        $this->configureRequest(__FUNCTION__);
        return (new TariffList($this->guzzleAdapter))->request();
    }






}