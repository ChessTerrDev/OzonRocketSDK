<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class DeliveryPlacesTest extends TestCase
{

    public function testDeliveryPickupPlaces()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $result = $client->deliveryFromPlaces();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('places', $result);
        $this->assertNotEmpty($result['places']);
        $this->assertIsArray($result['places'][0]);

        $this->assertArrayHasKey('id', $result['places'][0]);
        $this->assertArrayHasKey('name', $result['places'][0]);
        $this->assertArrayHasKey('city', $result['places'][0]);
        $this->assertArrayHasKey('address', $result['places'][0]);
        $this->assertArrayHasKey('utcOffset', $result['places'][0]);
        $this->assertArrayHasKey('isBulky', $result['places'][0]);
    }

    public function testDeliveryReturnPlaces()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $result = $client->deliveryReturnPlaces();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('places', $result);
        $this->assertNotEmpty($result['places']);
        $this->assertIsArray($result['places'][0]);

        $this->assertArrayHasKey('id', $result['places'][0]);
        $this->assertArrayHasKey('name', $result['places'][0]);
        $this->assertArrayHasKey('city', $result['places'][0]);
        $this->assertArrayHasKey('address', $result['places'][0]);
        $this->assertArrayHasKey('utcOffset', $result['places'][0]);
    }

    public function testDeliveryFromPlaces()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $result = $client->deliveryPickupPlaces();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('places', $result);
        $this->assertNotEmpty($result['places']);
        $this->assertIsArray($result['places'][0]);

        $this->assertArrayHasKey('id', $result['places'][0]);
        $this->assertArrayHasKey('name', $result['places'][0]);
        $this->assertArrayHasKey('city', $result['places'][0]);
        $this->assertArrayHasKey('address', $result['places'][0]);
        $this->assertArrayHasKey('storage', $result['places'][0]);
    }
}
