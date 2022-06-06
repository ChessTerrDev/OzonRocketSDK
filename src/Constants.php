<?php

namespace OzonRocketSDK;


class Constants
{
    /**
     * Адрес сервиса интеграции (рабочая среда)
     * @var string
     */
    public const API_URL = 'https://xapi.ozon.ru/principal-integration-api';

    /**
     * Адрес тестовой среды интеграции
     * @var string
     */
    public const API_URL_TEST = 'https://api-stg.ozonru.me/principal-integration-api';


    /**
     * Адрес получения токена для рабочей среды
     * @var string
     */
    public const API_TOKEN_URL = 'https://xapi.ozon.ru/principal-auth-api/connect/token';

    /**
     * Адрес получения токена для тестовой среды
     * @var string
     */
    public const API_TOKEN_TEST_URL = 'https://api-stg.ozonru.me/principal-auth-api/connect/token';

    /**
     * Ключи для подключения к тестовой среде
     * @var string
     */
    public const TEST_CLIENT_ID = 'ApiTest_11111111-1111-1111-1111-111111111111';
    public const TEST_CLIENT_SECRET = 'SRYksX3PBPUYj73A6cNqbQYRSaYNpjSodIMeWoSCQ8U=';


    /**
     * Параметр типа аутентификации.
     * @var string
     */
    public const GRANT_TYPE = 'client_credentials';

    /** Ключи авторизации используемые в теле запроса */
    public const AUTH_KEY_TYPE = 'grant_type';
    public const AUTH_KEY_CLIENT_ID = 'client_id';
    public const AUTH_KEY_SECRET = 'client_secret';


    /**
     * Ошибка авторизации.
     * @var string
     */
    public const AUTH_FAIL = 'Аутентификация не удалась, пожалуйста, проверьте переданные логин и пароль';

    /**
     * Загрузить отправления
     * @var string
     */
    public const  ORDER_URL_URL = '/v1/order';

    /**
     * Отменить заказы
     * @var string
     */
    public const ORDER_STATUS_CANCEL_URL = '/v1/order/status/canceled';

    /**
     * Причины отмены заказа
     * @var string
     */
    public const ORDER_CANCELLATION_REASON_URL = '/1/order/cancellationReasons';


    /**
     * Получить способы доставки
     * @var string
     */
    public const _URL = '/v1/delivery/variants';

    /**
     * Получить способы доставки по адресу
     * @var string
     */
    public const DELIV_VAR_ADDR_URL = '/v1/delivery/variants/byaddress';

    /**
     * Получить способы доставки по viewport
     * @var string
     */
    public const DELIV_VAR_VP_URL = '/v1/delivery/variants/byviewport';

    /**
     * Получить способы доставки по идентификаторам
     * @var string
     */
    public const DELIV_VAR_ID_URL = '/v1/delivery/variants/byids';

    /**
     * Получить идентификаторы способов доставки
     * @var string
     */
    public const DELIV_VAR_ADDR_SHORT_URL = '/v1/delivery/variants/byaddress/short';

    /**
     * Получить список городов с доступными способами доставки
     * @var string
     */
    public const DELIV_CITIES_EXT_URL = '/v1/delivery/cities/extended';

    /**
     * Рассчитать стоимости доставки
     * @var string
     */
    public const DELIV_CALC_URL = '/v1/delivery/calculate';

    /**
     * Рассчитать объёмный вес
     * @var string
     */
    public const DELIV_CALC_WEIGHT_URL = '/v1/delivery/calculate/materialWeight';

    /**
     * Рассчитать стоимость и срок доставки по адресу
     * @var string
     */
    public const DELIV_CALC_INFO_URL = '/v1/delivery/calculate/information';

    /**
     * Получить место передачи отправлений DropOff на склад
     * @var string
     */
    public const DELIV_FROM_PLACES_URL = '/v1/delivery/from_places';

    /**
     * Получить информацию о складе возврата
     * @var string
     */
    public const DELIV_RET_PLACES_URL = '/v1/delivery/return_places';

    /**
     * Получить информацию о сроках доставки
     * @var string
     */
    public const DELIV_TIME_URL = '/v1/delivery/time';

    /**
     * Получить список складов пикапа
     * @var string
     */
    public const DELIV_PICKUP_PLACES_URL = '/v1/delivery/pickup_places';

    /**
     * Создать заявку на отгрузку на складе Ozon (DropOff)
     * @var string
     */
    public const SHIPMENT_REQ_URL = '/v1/shipmentRequest';

    /**
     * Получить акты и транспортные накладные
     * @var string
     */
    public const SHIPMENT_REQ_DOC_URL = '/v1/shipmentRequest/documents';

    /**
     * Отменить заявку на отгрузку
     * @var string
     */
    public const SHIPMENT_REQ_CANCEL_URL = '/v1/shipmentRequest/cancellation';

    /**
     * Создать заявку на отгрузку со склада принципала (PickUp)
     * @var string
     */
    public const SHIP_REQ_PICKAP_URL = '/v1/shipmentRequest/pickup';

    /**
     * Трекинг по номеру отправления
     * @var string
     */
    public const TRACKING_POST_NUM_URL = '/v1/tracking/bypostingnumber';

    /**
     * Трекинг по штрихкоду отправления
     * @var string
     */
    public const TRACKING_BARCODE_URL = '/v1/tracking/bybarcode';

    /**
     * Трекинг по списку номеров отправлений или штрихкодов
     * @var string
     */
    public const TRACKING_LIST_URL = '/v1/tracking/list';

    /**
     * Трекинг по номеру заказа
     * @var string
     */
    public const TRACKING_ORDER_NUM_URL = '/v1/tracking/byordernumber';

    /**
     * Получить печатную форму документа
     * @var string
     */
    public const DOC_URL = '/v1/document';

    /**
     * Получить список расходных документов
     * @var string
     */
    public const DOC_RETURN_URL = '/v1/document/return_documents';

    /**
     * Получить список отчётов
     * @var string
     */
    public const REPORT_LIST_URL = '/v1/report/list';

    /**
     * Получить отчёт в бинарном виде
     * @var string
     */
    public const REPORT_BIN_URL = '/v1/report/binary';

    /**
     * Получить список документов типа «Акт расхождения»
     * @var string
     */
    public const MISMATCHACT_URL = '/v1/mismatchact';


    /**
     * Получить список тарифов
     * @var string
     */
    public const TARIFF_LIST_URL = '/v1/tariff/list';

    /**
     * Получить этикетку отправления
     * @var string
     */
    public const TICKET_URL = '/v1/ticket';




    /**
     * Статусы EventID
     * @var array
     */
    public const EVENTS_LIST = [
        'Registered' => 'Заказ зарегистрирован',
        'Sent' => 'Отправлен',
        'Delivering' => 'Доставляется',
        'ArrivedToCity' => 'Прибыло в ваш город',
        'ReadyForPickup' => 'Готов к выдаче',
        'DeliveringToClient' => 'Выехал к клиенту',
        'Delivered' => 'Доставлен',
        'PartialDelivered' => 'Доставлен частично',
        'Canceled' => 'Отменен',
        'NotInDemand' => 'Не востребован',
        'Problem' => 'Проблема',
        'Returning' => 'Едет обратно',
        'ReturnReadyForSender' => 'Готов к выдаче отправителю',
        'ReturnedToSender' => 'Передан отправителю'
    ];
}