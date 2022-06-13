<?php

namespace OzonRocketSDK\Entity\Common;

use OzonRocketSDK\Entity\AbstractEntity;

class ViewPort extends AbstractEntity
{
    protected \OzonRocketSDK\Entity\Common\GeoCoordinates $rightTop;
    protected \OzonRocketSDK\Entity\Common\GeoCoordinates $leftBottom;
    protected int $zoom;


    /**
     * @param \OzonRocketSDK\Entity\Common\GeoCoordinates $rightTop Долгота и Широта
     * @param \OzonRocketSDK\Entity\Common\GeoCoordinates $leftBottom Долгота и Широта
     * @param int $zoom Коэффициент масштабирования
     */
    public function __construct(GeoCoordinates $rightTop, GeoCoordinates $leftBottom, int $zoom)
    {
        $this->rightTop = $rightTop;
        $this->leftBottom = $leftBottom;
    }

    /**
     * @return \OzonRocketSDK\Entity\Common\GeoCoordinates
     */
    public function getRightTop(): GeoCoordinates
    {
        return $this->rightTop;
    }

    /**
     * @param \OzonRocketSDK\Entity\Common\GeoCoordinates $rightTop
     * @return ViewPort
     */
    public function setRightTop(GeoCoordinates $rightTop): ViewPort
    {
        $this->rightTop = $rightTop;
        return $this;
    }

    /**
     * @return \OzonRocketSDK\Entity\Common\GeoCoordinates
     */
    public function getLeftBottom(): GeoCoordinates
    {
        return $this->leftBottom;
    }

    /**
     * @param \OzonRocketSDK\Entity\Common\GeoCoordinates $leftBottom
     * @return ViewPort
     */
    public function setLeftBottom(GeoCoordinates $leftBottom): ViewPort
    {
        $this->leftBottom = $leftBottom;
        return $this;
    }

    /**
     * @return int
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }

    /**
     * @param int $zoom
     * @return ViewPort
     */
    public function setZoom(int $zoom): ViewPort
    {
        $this->zoom = $zoom;
        return $this;
    }
}