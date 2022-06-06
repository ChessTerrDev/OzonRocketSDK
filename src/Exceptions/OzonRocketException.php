<?php

namespace OzonRocketSDK;

use Exception;
use OzonRocketSDK\Constants;

class OzonRocketException extends Exception
{
    public static function getTranslation($code, $message)
    {
        /*if (array_key_exists($code, Constants::ERRORS)) {
            return Constants::ERRORS[$code].'. '.$message;
        }*/

        return $message;
    }
}