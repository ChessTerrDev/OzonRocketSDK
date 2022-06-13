<?php

namespace OzonRocketSDK\Exceptions;

use Exception;

class OzonRocketException extends Exception
{
    /**
     * @param $method
     * @param $arErrorRequest
     * @return string
     */
    public static function getErrorMessage($method, $arErrorRequest): string
    {

        if (empty($arErrorRequest)) return 'От API OZON при вызове метода ' . $method . ' пришел пустой ответ';

        $message = $arErrorRequest['errorCode'] . ".\n От API OZON при вызове метода " . $method .
            ' получена ошибка: ' . $arErrorRequest['errorCode'];

        if (isset($arErrorRequest['arguments'])) $message .= ".\n Error Arguments: " .
            implode("&",array_map(function($a) {return implode("~",$a);}, $arErrorRequest['arguments']));

        if (isset($arErrorRequest['extensions'])) $message .= ".\n Extensions: ".
            implode("&",array_map(function($a) {return implode("~",$a);}, $arErrorRequest['extensions']));

        return $message;
    }

}