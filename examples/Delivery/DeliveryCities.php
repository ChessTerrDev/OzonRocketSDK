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
// Получение списка городов, в которые есть возможность доставлять
$result = $client->deliveryCities();
var_dump($result);




//-----------------------------------------------------------------------------------------
/**
 * Получение расширенного списка городов, в которых принципалу доступны способы доставки.
 * Способ доставки:
 * Courier — доставка курьером,
 * PickPoint — самовывоз,
 * Postamat — постамат.
 */
$result = $client->DeliveryCitiesExtended(['Postamat']);
var_dump($result);