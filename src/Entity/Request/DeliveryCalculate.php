<?php

namespace OzonRocketSDK\Entity\Request;

class DeliveryCalculate extends AbstractRequest
{
    /**
     * @var int
     */
    protected int $deliveryVariantId;

    /**
     * @var float
     */
    protected float $weight;

    /**
     * @var int
     */
    protected int $fromPlaceId;

    /**
     * @var float
     */
    protected float $estimatedPrice;

    /**
     * @param int $deliveryVariantId Идентификатор способа доставки. Значение id из ответа deliveryVariants()
     * @param float $weight Вес отправления в граммах.
     * @param int $fromPlaceId Идентификатор места передачи отправления.
     * Значение id из ответа deliveryFromPlaces(). Соответствует значению одного из складов передачи Ozon.
     * @param float $estimatedPrice Объявленная ценность отправления.
     */
    public function __construct(int $deliveryVariantId, float $weight, int $fromPlaceId, float $estimatedPrice)
    {
        $this->deliveryVariantId = $deliveryVariantId;
        $this->weight = $weight;
        $this->fromPlaceId = $fromPlaceId;
        $this->estimatedPrice = $estimatedPrice;
    }


    /**
     * @return int
     */
    public function getDeliveryVariantId(): int
    {
        return $this->deliveryVariantId;
    }

    /**
     * @param int $deliveryVariantId
     * @return DeliveryCalculate
     */
    public function setDeliveryVariantId(int $deliveryVariantId): DeliveryCalculate
    {
        $this->deliveryVariantId = $deliveryVariantId;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return DeliveryCalculate
     */
    public function setWeight(float $weight): DeliveryCalculate
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getFromPlaceId(): int
    {
        return $this->fromPlaceId;
    }

    /**
     * @param int $fromPlaceId
     * @return DeliveryCalculate
     */
    public function setFromPlaceId(int $fromPlaceId): DeliveryCalculate
    {
        $this->fromPlaceId = $fromPlaceId;
        return $this;
    }

    /**
     * @return float
     */
    public function getEstimatedPrice(): float
    {
        return $this->estimatedPrice;
    }

    /**
     * @param float $estimatedPrice
     * @return DeliveryCalculate
     */
    public function setEstimatedPrice(float $estimatedPrice): DeliveryCalculate
    {
        $this->estimatedPrice = $estimatedPrice;
        return $this;
    }

}