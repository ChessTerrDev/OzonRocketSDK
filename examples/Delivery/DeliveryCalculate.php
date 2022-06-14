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



//--------------------------------------------------------------------------
$deliveryCalculate = new \OzonRocketSDK\Entity\Request\DeliveryCalculate(
    19189848103000, // Идентификатор способа доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants)
    1500, // Вес отправления в граммах.
    5056649045000, // Идентификатор места передачи отправления. Значения id можно получить из ответа метода $client->deliveryFromPlaces()
    6000 // Объявленная ценность отправления.
);
$result = $client->deliveryCalculate($deliveryCalculate);
//var_dump($result);



//--------------------------------------------------------------------------
// Информация о грузовом месте (отправлении).
$package1 = (new \OzonRocketSDK\Entity\Common\Package())
    ->setCount(2) // Количество одинаковых коробок.
    ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000)) // Информация о габаритах. (вес в гр / Длинна в мм / Высота в мм / Ширина в мм)
    ->setPrice(1500) // Общая стоимость содержимого коробки в рублях.
    ->setEstimatedPrice(1500) // Объявленная ценность содержимого коробки.
    ->setIsReturnAccompanyingDocument(true); // Установить Возвращаемый Сопроводительный Документ. Необязательный параметр

// Так же можно формировать package через конструктор
$package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);
$package3 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

$result = $client->deliveryCalculateMaterialWeight([$package1, $package2, $package3, $package1, $package2, $package3]);
//var_dump($result);


//-----------------------------------------------------------------------------------------
// Информация о грузовом месте (отправлении).
$package1 = (new \OzonRocketSDK\Entity\Common\Package())
    ->setCount(2) // Количество одинаковых коробок.
    ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000)) // Информация о габаритах. (вес в гр / Длинна в мм / Высота в мм / Ширина в мм)
    ->setPrice(1500) // Общая стоимость содержимого коробки в рублях.
    ->setEstimatedPrice(1500) // Объявленная ценность содержимого коробки.
    ->setIsReturnAccompanyingDocument(true); // Установить Возвращаемый Сопроводительный Документ. Необязательный параметр

// Так же можно формировать package через конструктор
$package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);
$package3 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

$result = $client->deliveryCalculateInformation(
    new \OzonRocketSDK\Entity\Request\DeliveryCalculateInformation(
        15, // Идентификатор места отправления. Значения id можно получить из ответа метода $client->deliveryFromPlaces()
        "Ессентуки", // Адрес доставки.
        [$package1, $package2, $package3] // Массив информации по отправлениям.
    )
);
var_dump($result);