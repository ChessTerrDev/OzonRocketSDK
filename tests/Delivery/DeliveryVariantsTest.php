<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class DeliveryVariantsTest extends TestCase
{

    public function testDeliveryVariantsByViewport()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));

        $package1 = (new \OzonRocketSDK\Entity\Common\Package())
            ->setCount(2)
            ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000))
            ->setPrice(1500)
            ->setEstimatedPrice(1500)
            ->setIsReturnAccompanyingDocument(true);
        $package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

        $viewport =  new \OzonRocketSDK\Entity\Common\ViewPort(
            new \OzonRocketSDK\Entity\Common\GeoCoordinates( 37.616440, 55.758924),
            new \OzonRocketSDK\Entity\Common\GeoCoordinates( 36.603577, 54.750915),
            2
        );

        $deliveryVariantsByViewport = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByViewport())
            ->setDeliveryTypes(['Postamat', 'PickPoint'])
            ->setViewPort($viewport)
            ->setPackages([$package1, $package2])
            ->setFilter(new \OzonRocketSDK\Entity\Common\Filter(true, true, true));

        $result = $client->deliveryVariantsByViewport($deliveryVariantsByViewport);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertNotEmpty($result['data']);
    }

    public function testDeliveryVariantsByAddress()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));

        $package = (new \OzonRocketSDK\Entity\Common\Package())
            ->setCount(2)
            ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000))
            ->setPrice(1500)
            ->setEstimatedPrice(1500)
            ->setIsReturnAccompanyingDocument(true);
        $package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

        $deliveryVariantsByAddress = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByAddress())
            ->setDeliveryType('PickPoint')
            ->setFilter(new \OzonRocketSDK\Entity\Common\Filter(true, true, true))
            ->setAddress('Москва')
            ->setRadius(50)
            ->setPackages([$package, $package2]);

        $result = $client->deliveryVariantsByAddress($deliveryVariantsByAddress);

        $this->assertArrayHasKey('id', $result['data'][0]);
        $this->assertArrayHasKey('objectTypeId', $result['data'][0]);
        $this->assertArrayHasKey('objectTypeName', $result['data'][0]);
        $this->assertArrayHasKey('name', $result['data'][0]);
        $this->assertArrayHasKey('address', $result['data'][0]);
        $this->assertArrayHasKey('region', $result['data'][0]);
        $this->assertArrayHasKey('settlement', $result['data'][0]);
        $this->assertArrayHasKey('streets', $result['data'][0]);
        $this->assertArrayHasKey('placement', $result['data'][0]);
        $this->assertArrayHasKey('enabled', $result['data'][0]);
        $this->assertArrayHasKey('cityId', $result['data'][0]);
        $this->assertArrayHasKey('fiasGuid', $result['data'][0]);
        $this->assertArrayHasKey('fiasGuidControl', $result['data'][0]);
        $this->assertArrayHasKey('addressElementId', $result['data'][0]);
        $this->assertArrayHasKey('fittingShoesAvailable', $result['data'][0]);
        $this->assertArrayHasKey('fittingClothesAvailable', $result['data'][0]);
        $this->assertArrayHasKey('cardPaymentAvailable', $result['data'][0]);
        $this->assertArrayHasKey('howToGet', $result['data'][0]);
        $this->assertArrayHasKey('phone', $result['data'][0]);
        $this->assertArrayHasKey('contractorId', $result['data'][0]);
        $this->assertArrayHasKey('stateName', $result['data'][0]);
        $this->assertArrayHasKey('maxWeight', $result['data'][0]);
        $this->assertArrayHasKey('maxWeightTotal', $result['data'][0]);
        $this->assertArrayHasKey('maxPrice', $result['data'][0]);
        $this->assertArrayHasKey('restrictionWidth', $result['data'][0]);
        $this->assertArrayHasKey('restrictionLength', $result['data'][0]);
        $this->assertArrayHasKey('restrictionHeight', $result['data'][0]);
        $this->assertArrayHasKey('lat', $result['data'][0]);
        $this->assertArrayHasKey('long', $result['data'][0]);
        $this->assertArrayHasKey('returnAvailable', $result['data'][0]);
        $this->assertArrayHasKey('partialGiveOutAvailable', $result['data'][0]);
        $this->assertArrayHasKey('dangerousAvailable', $result['data'][0]);
        $this->assertArrayHasKey('isCashForbidden', $result['data'][0]);
        $this->assertArrayHasKey('code', $result['data'][0]);
        $this->assertArrayHasKey('wifiAvailable', $result['data'][0]);
        $this->assertArrayHasKey('legalEntityNotAvailable', $result['data'][0]);
        $this->assertArrayHasKey('isRestrictionAccess', $result['data'][0]);
        $this->assertArrayHasKey('utcOffsetStr', $result['data'][0]);
        $this->assertArrayHasKey('isPartialPrepaymentForbidden', $result['data'][0]);
        $this->assertArrayHasKey('isGeozoneAvailable', $result['data'][0]);
        $this->assertArrayHasKey('postalCode', $result['data'][0]);
        $this->assertArrayHasKey('workingHours', $result['data'][0]);
        $this->assertArrayHasKey('services', $result['data'][0]);
    }

    public function testDeliveryVariantsByIds()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $deliveryVariants = (new \OzonRocketSDK\Entity\Request\DeliveryVariants())
            ->setCityName('Москва')
            ->setPayloadIncludesIncludePostalCode(true)
            ->setPayloadIncludesIncludeWorkingHours(true);

        $resultDeliveryVariants = $client->deliveryVariants($deliveryVariants);

        $ids = array_map(function($val){
            return $val['id'];
        }, $resultDeliveryVariants['data']);

        $DeliveryVariantsByIds = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByIds())->setIds($ids);
        $resultDeliveryVariantsByIds = $client->deliveryVariantsByIds($DeliveryVariantsByIds);


        $this->assertSame(count($resultDeliveryVariants['data']), count($resultDeliveryVariantsByIds['data']));
    }

    public function testDeliveryVariantsByAddressShort()
    {
        $client = (new \OzonRocketSDK\Client\Client('TEST'));
        $package1 = (new \OzonRocketSDK\Entity\Common\Package())
            ->setCount(2)
            ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000))
            ->setPrice(1500)
            ->setEstimatedPrice(1500)
            ->setIsReturnAccompanyingDocument(true);
        $package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

        $deliveryTyp = ['Courier', 'PickPoint', 'Postamat'];
        $radius = 49;
        $limit = 9;
        $deliveryVariantsByAddressShort = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByAddressShort($deliveryTyp, $radius, $limit))
            ->setAddress('Москва, Большой Власьевский переулок, 12')
            ->setPackages([$package1, $package2]);

        $result = $client->deliveryVariantsByAddressShort($deliveryVariantsByAddressShort);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('deliveryVariantIds', $result);
        $this->assertNotEmpty($result['deliveryVariantIds']);
    }

    public function testDeliveryVariants()
    {
        //Тестовая среда
        $client = (new \OzonRocketSDK\Client\Client('TEST'));

        $deliveryVariants = (new \OzonRocketSDK\Entity\Request\DeliveryVariants())
            ->setCityName('Москва')
            //->setPaginationSize(1)
            //->setPaginationToken('')
            ->setPayloadIncludesIncludePostalCode(true)
            ->setPayloadIncludesIncludeWorkingHours(true);

        $result = $client->deliveryVariants($deliveryVariants);


        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey(0, $result['data']);

        $this->assertArrayHasKey('id', $result['data'][0]);
        $this->assertArrayHasKey('objectTypeId', $result['data'][0]);
        $this->assertArrayHasKey('objectTypeName', $result['data'][0]);
        $this->assertArrayHasKey('name', $result['data'][0]);
        $this->assertArrayHasKey('description', $result['data'][0]);
        $this->assertArrayHasKey('address', $result['data'][0]);
        $this->assertArrayHasKey('region', $result['data'][0]);
        $this->assertArrayHasKey('settlement', $result['data'][0]);
        $this->assertArrayHasKey('streets', $result['data'][0]);
        $this->assertArrayHasKey('placement', $result['data'][0]);
        $this->assertArrayHasKey('enabled', $result['data'][0]);
        $this->assertArrayHasKey('cityId', $result['data'][0]);
        $this->assertArrayHasKey('fiasGuid', $result['data'][0]);
        $this->assertArrayHasKey('fiasGuidControl', $result['data'][0]);
        $this->assertArrayHasKey('addressElementId', $result['data'][0]);
        $this->assertArrayHasKey('fittingShoesAvailable', $result['data'][0]);
        $this->assertArrayHasKey('fittingClothesAvailable', $result['data'][0]);
        $this->assertArrayHasKey('cardPaymentAvailable', $result['data'][0]);
        $this->assertArrayHasKey('contractorId', $result['data'][0]);
        $this->assertArrayHasKey('stateName', $result['data'][0]);
        $this->assertArrayHasKey('maxWeight', $result['data'][0]);
        $this->assertArrayHasKey('maxWeightTotal', $result['data'][0]);
        $this->assertArrayHasKey('restrictionWidth', $result['data'][0]);
        $this->assertArrayHasKey('restrictionLength', $result['data'][0]);
        $this->assertArrayHasKey('restrictionHeight', $result['data'][0]);
        $this->assertArrayHasKey('lat', $result['data'][0]);
        $this->assertArrayHasKey('long', $result['data'][0]);
        $this->assertArrayHasKey('returnAvailable', $result['data'][0]);
        $this->assertArrayHasKey('partialGiveOutAvailable', $result['data'][0]);
        $this->assertArrayHasKey('dangerousAvailable', $result['data'][0]);
        $this->assertArrayHasKey('isCashForbidden', $result['data'][0]);
        $this->assertArrayHasKey('code', $result['data'][0]);
        $this->assertArrayHasKey('wifiAvailable', $result['data'][0]);
        $this->assertArrayHasKey('legalEntityNotAvailable', $result['data'][0]);
        $this->assertArrayHasKey('isRestrictionAccess', $result['data'][0]);
        $this->assertArrayHasKey('utcOffsetStr', $result['data'][0]);
        $this->assertArrayHasKey('isPartialPrepaymentForbidden', $result['data'][0]);
        $this->assertArrayHasKey('isGeozoneAvailable', $result['data'][0]);
        $this->assertArrayHasKey('postalCode', $result['data'][0]);
    }





    public function testDeliveryVariantsException()
    {
        $this->expectExceptionMessage('ValidationError');

        $client = (new \OzonRocketSDK\Client\Client('TEST'));

        $deliveryVariants = (new \OzonRocketSDK\Entity\Request\DeliveryVariants())
            //->setCityName('')
            ->setPaginationSize(1)
            ->setPaginationToken('')
            ->setPayloadIncludesIncludePostalCode(true)
            ->setPayloadIncludesIncludeWorkingHours(true);

        $client->deliveryVariants($deliveryVariants);
    }
}
