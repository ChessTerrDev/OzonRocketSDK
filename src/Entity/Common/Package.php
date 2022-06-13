<?php

namespace OzonRocketSDK\Entity\Common;

use  \OzonRocketSDK\Entity\AbstractEntity;

class Package extends AbstractEntity
{
    protected ?int        $count;
    protected ?Dimensions $dimensions;
    protected ?int        $price;
    protected ?int        $estimatedPrice;
    protected ?bool       $isReturnAccompanyingDocument;

    /**
     * @param int|null $count Количество одинаковых коробок.
     * @param \OzonRocketSDK\Entity\Common\Dimensions|null $dimensions Информация о габаритах.
     * @param int|null $price Общая стоимость содержимого коробки в рублях.
     * @param int|null $estimatedPrice Объявленная ценность содержимого коробки.
     * @param bool|null $isReturnAccompanyingDocument Является возвратным сопроводительным документом
     */
    public function __construct(
        ?int $count = null,
        ?Dimensions $dimensions = null,
        ?int $price = null,
        ?int $estimatedPrice = null,
        ?bool $isReturnAccompanyingDocument = null)
    {
        $this->count = $count;
        $this->dimensions = $dimensions;
        $this->price = $price;
        $this->estimatedPrice = $estimatedPrice;
        $this->isReturnAccompanyingDocument = $isReturnAccompanyingDocument;
    }

    /**
     * Количество одинаковых коробок.
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Количество одинаковых коробок.
     * @param int $count
     * @return Package
     */
    public function setCount(int $count): Package
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return \OzonRocketSDK\Entity\Common\Dimensions
     */
    public function getDimensions(): Dimensions
    {
        return $this->dimensions;
    }

    /**
     * Информация о габаритах.
     * @param \OzonRocketSDK\Entity\Common\Dimensions $dimensions
     * @return Package
     */
    public function setDimensions(Dimensions $dimensions): Package
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * Общая стоимость содержимого коробки в рублях.
     * @param int $price
     * @return Package
     */
    public function setPrice(int $price): Package
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getEstimatedPrice(): int
    {
        return $this->estimatedPrice;
    }

    /**
     * Объявленная ценность содержимого коробки.
     * @param int $estimatedPrice
     * @return Package
     */
    public function setEstimatedPrice(int $estimatedPrice): Package
    {
        $this->estimatedPrice = $estimatedPrice;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReturnAccompanyingDocument(): bool
    {
        return $this->isReturnAccompanyingDocument;
    }

    /**
     * Является возвратным сопроводительным документом
     * @param bool $isReturnAccompanyingDocument
     * @return Package
     */
    public function setIsReturnAccompanyingDocument(bool $isReturnAccompanyingDocument): Package
    {
        $this->isReturnAccompanyingDocument = $isReturnAccompanyingDocument;
        return $this;
    }

}