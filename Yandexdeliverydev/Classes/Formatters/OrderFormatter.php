<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\Formatters;

class OrderFormatter
{
    public static function formatPhone($phoneNumber)
    {
        if (empty($phoneNumber)) return $phoneNumber;
        if (!preg_match('/^\+[0-9]{11}$/', $phoneNumber)) {
            $phoneNumber = '+' . preg_replace('/\D/', '', $phoneNumber);
        }
        return mb_substr($phoneNumber, 0, 12);
    }

    public function replaceUnvalidatedSymbols($name)
    {
        if (empty($name)) return $name;
        if (!preg_match("/^[\sa-zA-Zа-яА-ЯёЁ0-9'-]+$/u", $name)) {
            return preg_replace('/\W/u', '', $name);
        }
        return mb_substr($name, 0, 50);
    }
}