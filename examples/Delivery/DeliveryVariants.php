<?php

require_once '../../vendor/autoload.php';

use OzonRocketSDK\Client\Client;

//-----------------------------------------------------------------------------------------
if (!session_id()) session_start();

//Тестовая среда
$account = 'TEST'; // ID для подключения к рабочей
$secure = null; // Секретный ключ для подключения к рабочей
//$timeout; // Необязательный параметр. Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго. По умолчанию 5.0
$client = (new Client($account, $secure /*, $timeout*/ ));

//-----------------------------------------------------------------------------------------
// Получить способы доставки

$deliveryVariants = (new \OzonRocketSDK\Entity\Request\DeliveryVariants())
    ->setCityName('Москва')
    //->setPaginationSize(1)
    //->setPaginationToken('')
    ->setPayloadIncludesIncludePostalCode(true)
    ->setPayloadIncludesIncludeWorkingHours(true);

$resultDeliveryVariants = $client->deliveryVariants($deliveryVariants);
//var_dump($resultDeliveryVariants);


//-----------------------------------------------------------------------------------------
// Получить способы доставки по адресу
// Информация о грузовом месте (отправлении).
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

$resultDeliveryVariantsByAddress = $client->deliveryVariantsByAddress($deliveryVariantsByAddress);
//var_dump($resultDeliveryVariantsByAddress);


//-----------------------------------------------------------------------------------------
// Идентификаторы способов доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants);
$ids = array_map(function($val){
    return $val['id'];
}, $resultDeliveryVariants['data']);
$DeliveryVariantsByIds = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByIds())->setIds($ids);
$resultDeliveryVariantsByIds = $client->deliveryVariantsByIds($DeliveryVariantsByIds);
//var_dump($resultDeliveryVariantsByIds);


//-----------------------------------------------------------------------------------------
// Информация о грузовом месте (отправлении).
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

$resultDeliveryVariantsByAddressShort = $client->deliveryVariantsByAddressShort($deliveryVariantsByAddressShort);
//var_dump($resultDeliveryVariantsByAddressShort);


//-----------------------------------------------------------------------------------------
//Получить способы доставки по viewport
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

$resultDeliveryVariantsByViewport = $client->deliveryVariantsByViewport($deliveryVariantsByViewport);
var_dump($resultDeliveryVariantsByViewport);