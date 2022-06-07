<?php

namespace OzonRocketSDK;


class Constants
{
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