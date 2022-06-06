Метод возвращает полный список всех тарифов в системе OZON
---
```php
$client = new OzonRocketSDK\Client($account, $secure);
//$client->setMemory(..., ...);
$arrayTariffList = $client->getTariffList();

foreach ($arrayTariffList as $tariff) {
    $tariff-> ... 
}
```

Возвращает Идентификатор тарифа. (int)

```$tariff->getId();```

Возвращает Наименование тарифа. (string)

```$tariff->getTariffName();```

Возвращает Наименование тарифной зоны. (string)

```$tariff->getTariffZoneName();```
Возвращает Идентификатор способа доставки. (string)

```$tariff->getDeliveryVariantId();```

Возвращает Наименование способа доставки. (string)

```$tariff->getDeliveryVariantName();```

Возвращает Тип способа доставки (string):
- К — курьерская доставка,
- С — самовывоз,
- П — постамат.

```$tariff->getDeliveryVariantType();```

Возвращает Идентификатор типа тарифа. (string)

```$tariff->getTariffRateTypeId();```

Возвращает Наименование типа тарифа. (int)

```$tariff->getTariffRateTypeName();```

Возвращает Идентификатор склада места передачи отправлений. (string)

```$tariff->getPlaceId();```

Возвращает Наименование склада места передачи отправлений. (int)

```$tariff->getPlaceName();```

Возвращает Базовый тариф. (float)

```$tariff->getBaseAmount();```

Возвращает Лимит базового тарифа в граммах. (int)

```$tariff->getLimit();```

Возвращает Доплата за превышение лимита. Шаг — 1000 грамм. (float)

```$tariff->getOverdraftAmount();```
