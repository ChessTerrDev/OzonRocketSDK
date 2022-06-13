<?php

namespace OzonRocketSDK\Entity\Request;

class DeliveryTime extends AbstractRequest
{
    /**
     * @var int
     */
    protected $fromPlaceId;
    /**
     * @var int
     */
    protected $deliveryVariantId;

    /**
     * @param int $fromPlaceId = Идентификатор места передачи отправления.  Значение id из ответа /delivery/from_places.
     * @param int $deliveryVariantId = Идентификатор способа доставки. Значение id из ответа /delivery/variants.
     */
    public function __construct(int $fromPlaceId, int $deliveryVariantId)
    {
        $this->fromPlaceId = $fromPlaceId;
        $this->deliveryVariantId = $deliveryVariantId;
    }

    /**
     * @return int
     */
    public function getFromPlaceId(): int
    {
        return $this->fromPlaceId;
    }

    /**
     * @return int
     */
    public function getDeliveryVariantId(): int
    {
        return $this->deliveryVariantId;
    }
}