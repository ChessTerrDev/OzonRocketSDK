<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class DeliveryCitiesTest extends TestCase
{

    public function testDeliveryCities()
    {
        $client = (new OzonRocketSDK\Client\Client('TEST'));
        $result = $client->deliveryCities();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertNotEmpty($result['data']);

        $this->assertArrayHasKey('name', $result['data'][0]);
        $this->assertArrayHasKey('type', $result['data'][0]);
        $this->assertArrayHasKey('fiasGuid', $result['data'][0]);
        $this->assertArrayHasKey('deliveryTypes', $result['data'][0]);
        $this->assertArrayHasKey('regionName', $result['data'][0]);
        $this->assertArrayHasKey('regionTypeName', $result['data'][0]);
        $this->assertArrayHasKey('regionFiasGuid', $result['data'][0]);
        $this->assertArrayHasKey('lat', $result['data'][0]);
        $this->assertArrayHasKey('long', $result['data'][0]);
        $this->assertArrayHasKey('isFederalCity', $result['data'][0]);
        $this->assertArrayHasKey('courierDeliveryVariants', $result['data'][0]);
    }

    public function testDeliveryCitiesExtended()
    {
        $client = (new OzonRocketSDK\Client\Client('TEST'));

        $result = $client->DeliveryCitiesExtended(['ExpressCourier']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertNotEmpty($result['data']);
        $this->assertIsString($result['data'][0]);

        $result = $client->DeliveryCitiesExtended(['Courier']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertNotEmpty($result['data']);
        $this->assertIsString($result['data'][0]);

        $result = $client->DeliveryCitiesExtended(['PickPoint']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertNotEmpty($result['data']);
        $this->assertIsString($result['data'][0]);

        $result = $client->DeliveryCitiesExtended(['Postamat']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertNotEmpty($result['data']);
        $this->assertIsString($result['data'][0]);
    }
}
