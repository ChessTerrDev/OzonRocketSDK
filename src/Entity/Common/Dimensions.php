<?php

namespace OzonRocketSDK\Entity\Common;

use  \OzonRocketSDK\Entity\AbstractEntity;

class Dimensions extends AbstractEntity
{
    /**
     * @var int Вес в граммах.
     */
    protected int $weight;

    /**
     * @var int Длина в миллиметрах.
     */
    protected int $length;

    /**
     * @var int Высота в миллиметрах.
     */
    protected int $height;

    /**
     * @var int Ширина в миллиметрах.
     */
    protected int $width;

    /**
     * @param int|null $weight Вес в граммах.
     * @param int|null $length Длина в миллиметрах.
     * @param int|null $height Высота в миллиметрах.
     * @param int|null $width Ширина в миллиметрах.
     */
    public function __construct(?int $weight = null, ?int $length = null, ?int $height = null, ?int $width = null)
    {
        $this->weight = $weight;
        $this->length = $length;
        $this->height = $height;
        $this->width = $width;
    }


    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return Dimensions
     */
    public function setWeight(int $weight): Dimensions
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return Dimensions
     */
    public function setLength(int $length): Dimensions
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Dimensions
     */
    public function setHeight(int $height): Dimensions
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Dimensions
     */
    public function setWidth(int $width): Dimensions
    {
        $this->width = $width;
        return $this;
    }




}