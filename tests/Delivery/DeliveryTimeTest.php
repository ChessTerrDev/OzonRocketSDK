<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;;

class DeliveryTimeTest extends TestCase
{

    public function testDeliveryTime()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $result = $client->deliveryTime(
            new \OzonRocketSDK\Entity\Request\DeliveryTime(
                15,
                19203004525000
            )
        );

        $this->assertIsArray($result);
        $this->assertArrayHasKey('days', $result);
        $this->assertIsInt($result['days']);
    }
}
