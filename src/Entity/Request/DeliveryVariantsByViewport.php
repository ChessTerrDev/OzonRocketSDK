<?php

namespace OzonRocketSDK\Entity\Request;


class DeliveryVariantsByViewport extends AbstractRequest
{
    /**
     * Способ доставки: PickPoint — самовывоз, Postamat — постамат.
     * @var array
     */
    protected array $deliveryTypes;

    /**
     * @var \OzonRocketSDK\Entity\Common\ViewPort
     */
    protected \OzonRocketSDK\Entity\Common\ViewPort $viewPort;

    /**
     * @var array = with elements = \OzonRocketSDK\Entity\Common\Package
     */
    protected array  $packages;

    /**
     * @var \OzonRocketSDK\Entity\Common\Filter
     */
    protected \OzonRocketSDK\Entity\Common\Filter $filter;

    /**
     * @return array
     */
    public function getDeliveryTypes(): array
    {
        return $this->deliveryTypes;
    }

    /**
     * Способ доставки: PickPoint — самовывоз, Postamat — постамат.
     * @param array $deliveryTypes = ['PickPoint', 'Postamat']
     * @return DeliveryVariantsByViewport
     */
    public function setDeliveryTypes(array $deliveryTypes): DeliveryVariantsByViewport
    {
        $this->deliveryTypes = $deliveryTypes;
        return $this;
    }

    /**
     * @return \OzonRocketSDK\Entity\Common\ViewPort
     */
    public function getViewPort(): \OzonRocketSDK\Entity\Common\ViewPort
    {
        return $this->viewPort;
    }

    /**
     * @param \OzonRocketSDK\Entity\Common\ViewPort $viewPort
     * @return DeliveryVariantsByViewport
     */
    public function setViewPort(\OzonRocketSDK\Entity\Common\ViewPort $viewPort): DeliveryVariantsByViewport
    {
        $this->viewPort = $viewPort;
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
     * @return DeliveryVariantsByViewport
     */
    public function setFilter(\OzonRocketSDK\Entity\Common\Filter $filter): DeliveryVariantsByViewport
    {
        $this->filter = $filter;
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
     * @return DeliveryVariantsByViewport
     */
    public function setPackages(array $packages): DeliveryVariantsByViewport
    {
        $this->packages = $packages;
        return $this;
    }
}