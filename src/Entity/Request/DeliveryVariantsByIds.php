<?php

namespace OzonRocketSDK\Entity\Request;

use OzonRocketSDK\Entity\AbstractEntity;

class DeliveryVariantsByIds extends AbstractEntity
{
    /**
     * @var int[]
     */
    protected array $ids;

    /**
     * @return int[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @param int[] $ids
     * @return DeliveryVariantsByIds
     */
    public function setIds(array $ids): DeliveryVariantsByIds
    {
        $this->ids = $ids;
        return $this;
    }
}