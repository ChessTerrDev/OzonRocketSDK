<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
// Получить информацию о сроках доставки

$result = $client->deliveryTime(
    new \OzonRocketSDK\Entity\Request\DeliveryTime(
        15, // Идентификатор места передачи отправления. Значения id можно получить из ответа метода $client->deliveryFromPlaces()
        19203004525000 // Идентификатор способа доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants)
    )
);
var_dump($result);