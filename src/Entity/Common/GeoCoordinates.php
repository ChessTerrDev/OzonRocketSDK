<?php

namespace OzonRocketSDK\Entity\Common;

use OzonRocketSDK\Entity\AbstractEntity;

class GeoCoordinates extends AbstractEntity
{
    /**
     * @var float Долгота.
     */
    protected float $longitude;
    /**
     * @var float Широта.
     */
    protected float $latitude;

    /**
     * @param float $longitude Долгота.
     * @param float $latitude Широта.
     */
    public function __construct(float $longitude, float $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return GeoCoordinates
     */
    public function setLongitude(float $longitude): GeoCoordinates
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return GeoCoordinates
     */
    public function setLatitude(float $latitude): GeoCoordinates
    {
        $this->latitude = $latitude;
        return $this;
    }
}