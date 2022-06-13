<?php

namespace OzonRocketSDK\Entity\Request;

class DeliveryVariantsByAddressShort extends AbstractRequest
{
    /**
     * @var array
     */
    protected array  $deliveryTypes;

    /**
     * @var string
     */
    protected string  $address;
    /**
     * @var float
     */
    protected float $radius;

    /**
     * @var array with object \OzonRocketSDK\Entity\Common\Package
     */
    protected array $packages;

    /**
     * @var int
     */
    protected int $limit;

    /**
     * @param array $deliveryTypes Способ доставки: ['Courier', 'PickPoint', 'Postamat'] Можно указать один или несколько способов.
     * @param float $radius Радиус в километрах, в пределах которого необходимо искать способы доставки. Рекомендуемое значение — 50.
     * @param int $limit Количество способов для возврата в ответе. Максимум — 10.
     */
    public function __construct(array $deliveryTypes = ['Courier', 'PickPoint', 'Postamat'], float $radius = 50, int $limit = 10)
    {
        $this->deliveryTypes = $deliveryTypes;
        $this->radius = $radius;
        $this->limit = $limit;
    }


    /**
     * @return array
     */
    public function getDeliveryTypes(): array
    {
        return $this->deliveryTypes;
    }

    /**
     * Способ доставки: ['Courier', 'PickPoint', 'Postamat'] Можно указать один или несколько способов.
     * @param array $deliveryTypes
     * @return DeliveryVariantsByAddressShort
     */
    public function setDeliveryTypes(array $deliveryTypes): DeliveryVariantsByAddressShort
    {
        $this->deliveryTypes = $deliveryTypes;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Адрес доставки.
     * Как минимум, нужно указать населённый пункт. Для областных населённых пунктов также указывается область и район.
     * Указывать номер квартиры не нужно.
     * @param string $address
     * @return DeliveryVariantsByAddressShort
     */
    public function setAddress(string $address): DeliveryVariantsByAddressShort
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * Радиус в километрах, в пределах которого необходимо искать способы доставки. Рекомендуемое значение — 50.
     * @param float $radius
     * @return DeliveryVariantsByAddressShort
     */
    public function setRadius(float $radius): DeliveryVariantsByAddressShort
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return array with object \OzonRocketSDK\Entity\Common\Package
     */
    public function getPackages(): array
    {
        return $this->packages;
    }

    /**
     * Данные о грузовом месте (отправлении).
     * @param array $packages with object \OzonRocketSDK\Entity\Common\Package
     * @return DeliveryVariantsByAddressShort
     */
    public function setPackages(array $packages): DeliveryVariantsByAddressShort
    {
        $this->packages = $packages;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return DeliveryVariantsByAddressShort
     */
    public function setLimit(int $limit): DeliveryVariantsByAddressShort
    {
        $this->limit = $limit;
        return $this;
    }
}