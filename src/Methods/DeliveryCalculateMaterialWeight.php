<?php

namespace OzonRocketSDK\Methods;

class DeliveryCalculateMaterialWeight extends AbstractMethod
{
    public function __construct($data, $guzzleAdapter)
    {
        parent::__construct(['packages' => $data], $guzzleAdapter);
    }
}