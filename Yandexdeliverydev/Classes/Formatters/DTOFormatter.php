<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\Formatters;

class DTOFormatter
{
    public static function replacePaymentMethods($string) {
        if ($string == '') { return $string; }
        $arRussianMethods = ['Оплаченные заказы', 'Картой при получении', 'Наличными при получении'];
        $arEnglishMethods = ['already_paid', 'card_on_receipt', 'cash_on_receipt'];
        return str_replace($arEnglishMethods, $arRussianMethods, $string);
    }
}