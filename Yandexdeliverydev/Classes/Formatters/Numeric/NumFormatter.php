<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\Formatters\Numeric;

class NumFormatter
{
    public function clean($string) {
        if (empty($string)) return '';
        return (float) preg_replace("/[^,.0-9]/", '', $string);
    }
}