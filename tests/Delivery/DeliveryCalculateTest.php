<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class DeliveryCalculateTest extends TestCase
{

    public function testDeliveryCalculate()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $deliveryCalculate = new \OzonRocketSDK\Entity\Request\DeliveryCalculate(
            19189848103000, // Идентификатор способа доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants)
            1500, // Вес отправления в граммах.
            5056649045000, // Идентификатор места передачи отправления. Значения id можно получить из ответа метода $client->deliveryFromPlaces()
            6000 // Объявленная ценность отправления.
        );
        $result = $client->deliveryCalculate($deliveryCalculate);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('amount', $result);
        $this->assertNotEmpty($result['amount']);
        $this->assertIsFloat($result['amount']);
    }

    public function testDeliveryCalculateInformation()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));

        $package1 = (new \OzonRocketSDK\Entity\Common\Package())
            ->setCount(2)
            ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000))
            ->setPrice(1500)
            ->setEstimatedPrice(1500)
            ->setIsReturnAccompanyingDocument(true);

        $package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);
        $package3 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

        $result = $client->deliveryCalculateMaterialWeight([$package1, $package2, $package3, $package1, $package2, $package3]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('volumeWeight', $result);
        $this->assertNotEmpty($result['volumeWeight']);
        $this->assertIsFloat($result['volumeWeight']);
    }

    public function testDeliveryCalculateMaterialWeight()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));

        $package1 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);
        $package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);
        $package3 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

        $result = $client->deliveryCalculateInformation(
            new \OzonRocketSDK\Entity\Request\DeliveryCalculateInformation(
                15,
                "Ессентуки",
                [$package1, $package2, $package3]
            )
        );

        $this->assertIsArray($result);
        $this->assertArrayHasKey('deliveryInfos', $result);
        $this->assertIsArray($result['deliveryInfos']);
    }
}
