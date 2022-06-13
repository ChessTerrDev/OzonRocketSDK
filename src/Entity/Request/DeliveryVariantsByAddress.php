<?php
declare(strict_types=1);

namespace OzonRocketSDK\Entity\Request;


class DeliveryVariantsByAddress extends AbstractRequest
{
    /**
     * Способ доставки: ExpressCourier, Courier — доставка курьером, PickPoint — самовывоз, Postamat — постамат.
     * @var string
     */
    protected string $deliveryType;

    /**
     * @var \OzonRocketSDK\Entity\Common\Filter
     */
    protected \OzonRocketSDK\Entity\Common\Filter $filter;
    /**
     * @var string
     */
    protected string $address;

    /**
     * @var int
     */
    protected int $radius;

    /**
     * @var array = with elements = \OzonRocketSDK\Entity\Common\Package
     */
    protected array  $packages;

    /**
     * @return string
     */
    public function getDeliveryType(): string
    {
        return $this->deliveryType;
    }

    /**
     * Способ доставки: ExpressCourier, Courier — доставка курьером, PickPoint — самовывоз, Postamat — постамат.
     * @param string $deliveryType
     * @return DeliveryVariantsByAddress
     */
    public function setDeliveryType(string $deliveryType): DeliveryVariantsByAddress
    {
        $this->deliveryType = $deliveryType;
        return $this;
    }

    /**
     * @return \OzonRocketSDK\Entity\Common\Filter
     */
    public function getFilter(): \OzonRocketSDK\Entity\Common\Filter
    {
        return $this->filter;
    }

    /**
     * @param \OzonRocketSDK\Entity\Common\Filter $filter
     * @return DeliveryVariantsByAddress
     */
    public function setFilter(\OzonRocketSDK\Entity\Common\Filter $filter): DeliveryVariantsByAddress
    {
        $this->filter = $filter;
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
     * @param string $address
     * @return DeliveryVariantsByAddress
     */
    public function setAddress(string $address): DeliveryVariantsByAddress
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRadius(): int
    {
        return $this->radius;
    }

    /**
     * Радиус действия в километрах. (от 0.05 до 50 километров). Рекомендуемое значение — 50.
     * @param int|null $radius
     * @return DeliveryVariantsByAddress
     */
    public function setRadius(int $radius): DeliveryVariantsByAddress
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * Информация о грузовом месте (отправлении).
     * @return array with elements = \OzonRocketSDK\Entity\Common\Package
     */
    public function getPackages(): array
    {
        return $this->packages;
    }

    /**
     * Информация о грузовом месте (отправлении).
     * @param array $packages with elements = \OzonRocketSDK\Entity\Common\Package
     * @return DeliveryVariantsByAddress
     */
    public function setPackages(array $packages): DeliveryVariantsByAddress
    {
        $this->packages = $packages;
        return $this;
    }
}