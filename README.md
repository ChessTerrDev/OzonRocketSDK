

# Ozon Logistics ([Ozon:Rocket](https://rocket.ozon.ru/))
> Работа с боевым API возможна только при наличии договора с Ozon


### Список возможностей и содержание SDK:
#### [Начало работы (авторизация)](#начало-работы)
#### [Доставка](#доставка)
- [X] [Получить способы доставки](#получить-способы-доставки)
- [X] [Получить способы доставки по адресу](#получить-способы-доставки-по-адресу)
- [X] [Получить способы доставки по viewport](#получить-способы-доставки-по-viewport)
- [X] [Получить способы доставки по идентификаторам](#получить-способы-доставки-по-идентификаторам)
- [X] [Получить идентификаторы способов доставки](#получить-идентификаторы-способов-доставки)
- [X] [Получить список городов с доступными способами доставки](#получить-список-городов-с-доступными-способами-доставки)
- [X] [Рассчитать стоимости доставки](#рассчитать-стоимости-доставки)
- [X] [Рассчитать объёмный вес](#рассчитать-объёмный-вес)
- [X] [Рассчитать стоимость и срок доставки по адресу](#рассчитать-стоимость-и-срок-доставки-по-адресу)
- [X] [Получить место передачи отправлений DropOff на склад](#получить-место-передачи-отправлений-DropOff-н-склад)
- [X] [Получить информацию о складе возврата](#получить-информацию-о-складе-возврата)
- [X] [Получить информацию о сроках доставки](#получить-информацию-о-сроках-доставки)
- [X] [Получить список складов пикапа](#получить-список-складов-пикапа)
 
#### В разработке:
* Заказы
* Отгрузка
* Трекинг
* Накладные
* Отчёты
* Акты 
* Тарифы
* Этикетки


## Требования
Автор старался сделать наиболее функциональный и универсальный SDK. Необходимы:
PHP 7.4 и выше, расширение "ext-json", и клиент Guzzlehttp.

***
## Установка
Установка осуществляется с помощью менеджера пакетов Composer

```bash
composer require chessterrdev/ozonrocket-sdk
```


***
## Документация

Пригодится справочная информация по [Ozon Rocket API (1.0.0)](https://docs.ozon.ru/api/rocket/)

***
## Руководство к действию

## Начало работы
```php
use OzonRocketSDK\Client\Client;

//Рабочая среда 
$account = 'client_id'; // ID для подключения к рабочей
$secure = 'client_secret'; // Секретный ключ для подключения к рабочей
$timeout; // Необязательный параметр. Настройка клиента задающая общий тайм-аут запроса в секундах. При использовании 0 ждать бесконечно долго. По умолчанию 5.0
$client = (new Client($account, $secure = null, $timeout));

//Тестовая среда
$client = (new Client('TEST'));
```

## Доставка

### Получить способы доставки
##### /v1/delivery/variants
```php
$deliveryVariants = (new \OzonRocketSDK\Entity\Request\DeliveryVariants())
    // Название города. Необязательный параметр. Cписки городов можно получить через:
    // $client->deliveryCities() или
    // $client->DeliveryCitiesExtended(['ExpressCourier','Courier', 'PickPoint', 'Postamat']);
    ->setCityName('Москва')
    // Количество записей на странице.
    ->setPaginationSize(1) 
    // Токен следующей страницы. Необязательный параметр
    ->setPaginationToken('') 
    // Добавить в ответ часы работы пункта выдачи
    ->setPayloadIncludesIncludePostalCode(true)
    // Добавить в ответ почтовый индекс пункта выдач
    ->setPayloadIncludesIncludeWorkingHours(true);

$result = $client->deliveryVariants($deliveryVariants);
```
### Получить способы доставки по адресу
##### /v1/delivery/variants/byaddress
```php
// Информация о грузовом месте (отправлении).
$package = (new \OzonRocketSDK\Entity\Common\Package())
    ->setCount(2) // Количество одинаковых коробок.
    ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000)) // Информация о габаритах. (вес в гр / Длинна в мм / Высота в мм / Ширина в мм)
    ->setPrice(1500) // Общая стоимость содержимого коробки в рублях.
    ->setEstimatedPrice(1500) // Объявленная ценность содержимого коробки.
    ->setIsReturnAccompanyingDocument(true); // Установить Возвращаемый Сопроводительный Документ. Необязательный параметр

$deliveryVariantsByAddress = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByAddress())
    ->setDeliveryType('PickPoint') // Способ доставки: Courier / PickPoint / Postamat
    // Фильтр для способов доставки по признакам. (Возможность принимать платёж наличными, Возможность принимать платёж банковской картой, Возможность принимать платёж) 
    ->setFilter(new \OzonRocketSDK\Entity\Common\Filter(true, true, true))
    // Адрес доставки. Как минимум, нужно указать населённый пункт. Для областных населённых пунктов также указывается область и район.
    ->setAddress('Москва')
    // Радиус действия в километрах. Рекомендуемое значение — 50. Минимальное значение - 1.
    ->setRadius(50)
    // Массив с Информацией о грузовом месте (отправлении).
    ->setPackages([$package, $package]);

$result = $client->deliveryVariantsByAddress($deliveryVariantsByAddress);
```
### Получить способы доставки по viewport
##### /v1/delivery/variants/byviewport
Рекомендуем использовать метод для интегрирования виджета карты на сайт.
```php
// Информация о грузовом месте (отправлении).
$package1 = (new \OzonRocketSDK\Entity\Common\Package())
    ->setCount(2) // Количество одинаковых коробок.
    ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000)) // Информация о габаритах. (вес в гр / Длинна в мм / Высота в мм / Ширина в мм)
    ->setPrice(1500) // Общая стоимость содержимого коробки в рублях.
    ->setEstimatedPrice(1500) // Объявленная ценность содержимого коробки.
    ->setIsReturnAccompanyingDocument(true); // Установить Возвращаемый Сопроводительный Документ. Необязательный параметр

// Так же можно формировать package через конструктор
$package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

// Видимая пользователю область веб-страницы.
$viewport =  new \OzonRocketSDK\Entity\Common\ViewPort(
    // GeoCoordinate - указание Долготы и Широты
    new \OzonRocketSDK\Entity\Common\GeoCoordinates( 37.616440, 55.758924), // Широта и Долгота Правого Верхнего края
    new \OzonRocketSDK\Entity\Common\GeoCoordinates( 36.603577, 54.750915), // Широта и Долгота Левого Нижнего края
    2 // Коэффициент масштабирования
);

$deliveryVariantsByViewport = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByViewport())
    // Способ доставки: PickPoint / Postamat
    ->setDeliveryTypes(['Postamat', 'PickPoint'])
    // Видимая пользователю область веб-страницы
    ->setViewPort($viewport)
    // Информация о грузовом месте (отправлении).
    ->setPackages([$package1, $package2])
    // Фильтр для способов доставки по признакам. (Возможность принимать платёж наличными, Возможность принимать платёж банковской картой, Возможность принимать платёж) 
    ->setFilter(new \OzonRocketSDK\Entity\Common\Filter(true, true, true));

$result = $client->deliveryVariantsByViewport($deliveryVariantsByViewport);
```
### Получить способы доставки по идентификаторам
##### /v1/delivery/variants/byids
Метод для получения списка способов доставки по идентификаторам способов доставки.
```php
// Идентификаторы способов доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants);
$ids = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByIds())->setIds(
    [
        19189848103000,
        1011000000015892
    ]
);
$result = $client->deliveryVariantsByIds($ids);
```
### Получить идентификаторы способов доставки
##### /v1/delivery/variants/byaddress/short
Метод для получения идентификаторов способов доставки по указанному адресу.
```php
// Информация о грузовом месте (отправлении).
$package1 = (new \OzonRocketSDK\Entity\Common\Package())
    ->setCount(2) // Количество одинаковых коробок.
    ->setDimensions(new OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000)) // Информация о габаритах.  (вес в гр / Длинна в мм / Высота в мм / Ширина в мм)
    ->setPrice(1500) // Общая стоимость содержимого коробки в рублях.
    ->setEstimatedPrice(1500) // Объявленная ценность содержимого коробки.
    ->setIsReturnAccompanyingDocument(true); // Установить Возвращаемый Сопроводительный Документ. Необязательный параметр

// Так же можно формировать package через конструктор
$package2 = new \OzonRocketSDK\Entity\Common\Package(2, new \OzonRocketSDK\Entity\Common\Dimensions(1000,1000,1000,1000), 1500, 1500, null);

$deliveryTyp = ['Courier', 'PickPoint', 'Postamat']; // Способ доставки: Courier / PickPoint / Postamat
$radius = 49; // Радиус действия в километрах. Рекомендуемое значение — 50. Минимальное значение - 1.
$limit = 9; // Количество способов для возврата в ответе. Максимум — 10.
$deliveryVariantsByAddressShort = (new \OzonRocketSDK\Entity\Request\DeliveryVariantsByAddressShort($deliveryTyp, $radius, $limit))
    //->setDeliveryType('PickPoint') // Способ доставки: Courier / PickPoint / Postamat
    //->setRadius(50) // Радиус действия в километрах. Рекомендуемое значение — 50. Минимальное значение - 1.
    //->setLimit(10) // Количество способов для возврата в ответе. Максимум — 10.
    ->setAddress('Москва, Большой Власьевский переулок, 12') // Адрес доставки. Как минимум, нужно указать населённый пункт. Для областных населённых пунктов также указывается область и район. Указывать номер квартиры не нужно.
    ->setPackages([$package1, $package2]); // Данные о грузовом месте (отправлении).

$result = $client->deliveryVariantsByAddressShort($deliveryVariantsByAddressShort);
```
### Получить список городов с доступными способами доставки
##### /v1/delivery/cities/extended
```php
// Получение списка городов, в которые есть возможность доставлять
$result = $client->deliveryCities();

/**
 * Получение расширенного списка городов, в которых принципалу доступны способы доставки.
 * Способ доставки:
     * Courier — доставка курьером,
     * PickPoint — самовывоз,
     * Postamat — постамат.
*/
$result = $client->DeliveryCitiesExtended(['ExpressCourier','Courier', 'PickPoint', 'Postamat']);
```
### Рассчитать стоимости доставки
##### /v1/delivery/calculate
```php
$deliveryCalculate = new \OzonRocketSDK\Entity\Request\DeliveryCalculate(
    19189848103000, // Идентификатор способа доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants)
    1500, // Вес отправления в граммах. 
    5056649045000, // Идентификатор места передачи отправления. Значения id можно получить из ответа метода $client->deliveryFromPlaces()
    6000 // Объявленная ценность отправления.
);
$result = $client->deliveryCalculate($deliveryCalculate);
```
### Рассчитать объёмный вес
##### /v1/delivery/calculate/materialWeight
```php
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
```
### Рассчитать стоимость и срок доставки по адресу
##### /v1/delivery/calculate/information
Метод для рассчёта стоимости и срока доставки по адресу с учётом объёмного веса.
```php
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
        "Москва", // Адрес доставки.
        [$package1, $package2, $package3] // Массив информации по отправлениям.
    )
);
```
### Получить место передачи отправлений DropOff на склад
##### /v1/delivery/from_places
```php
$result = $client->deliveryFromPlaces();
```
### Получить информацию о складе возврата
##### /v1/delivery/return_places
```php
$result = $client->deliveryReturnPlaces();
```
### Получить информацию о сроках доставки
##### /v1/delivery/time
```php
$result = $client->deliveryTime(
    new \OzonRocketSDK\Entity\Request\DeliveryTime(
        15, // Идентификатор места передачи отправления. Значения id можно получить из ответа метода $client->deliveryFromPlaces()
        19203004525000 // Идентификатор способа доставки. Значения id можно получить из ответа метода $client->deliveryVariants($deliveryVariants)
    )
);
```
### Получить список складов пикапа
##### /v1/delivery/pickup_places
```php
$result = $client->deliveryPickupPlaces();
```

> [Документация Ozon Rocket API (1.0.0)](https://docs.ozon.ru/api/rocket/)