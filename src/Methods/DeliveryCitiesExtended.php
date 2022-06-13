<?php

namespace OzonRocketSDK\Methods;

class DeliveryCitiesExtended extends AbstractMethod
{
    public function __construct(array $data, $guzzleAdapter)
    {
        parent::__construct(['deliveryTypes' => $data], $guzzleAdapter);
    }
}