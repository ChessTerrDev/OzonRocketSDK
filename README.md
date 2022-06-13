
![ozon](https://github.com/MirAlexSky/ozon-logistics-api/blob/master/Ozon.png "Ozon")
# Ozon Logistics ([Ozon:rocket:Rocket](https://rocket.ozon.ru/))

```
composer require 
```


### :heavy_check_mark:Возможности библиотеки
- [X] Авторизация и получение токена (тестового или боевого)
- [X] Получение списка пунктов выдачи
- [X] Получение способов доставки (курьер, ПВЗ)
- [X] Получение списка тарифов (Цена доставки до пункта выдачи)
- [X] Создание заказов
- [X] Получение информации по заказам
- [X] Получение наклейки (тикет)
- [X] Трекинг заказов

> Работа с боевым API возможна только при наличии договора с Ozon
<h2>:rocket:Начало работы</h2>




> [Документация Ozon Rocket API (1.0.0)](https://docs.ozon.ru/api/rocket/)


Это с большой commit.
В этом commit завершил работу по 3 большим блокам, guzzleAdapter, авторизация и работа с api блоком доставка. 
=GuzzleAdapter=
Реализовал
