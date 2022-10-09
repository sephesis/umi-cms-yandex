<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\Helpers;

class UmiObjectHelper
{
    private static $instance = null;

    public function __construct() 
    {
        self::$instance = \umiObjectsCollection::getInstance();
    }

    public static function get($object = false, $val = false)
    {
        if (!$object) return false;
        if (self::$instance === null) new static();
        if ($val) {
            return self::$instance->getObject($object)->getValue(strtolower($val));
        }
        return self::$instance->getObject($object);
    }
}