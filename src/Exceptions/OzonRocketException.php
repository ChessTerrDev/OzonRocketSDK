<?php

namespace OzonRocketSDK;

use OzonRocketSDK\Constants;

class Exception extends \Exception
{
    public static function getTranslation($code, $message)
    {
        if (array_key_exists($code, Constants::ERRORS)) {
            return Constants::ERRORS[$code].'. '.$message;
        }

        return $message;
    }
}