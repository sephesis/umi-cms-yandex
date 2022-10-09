<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev;

class InputParams
{
    public static function getTimeIntervals() 
    {
        return getRequest('deliveryTariff');
    }

    public function getComment() 
    {
        return getRequest('');
    }

    public function getCity() 
    {
        return getRequest('yandexCourierCity');
    }

    public function getStreet() 
    {
        return getRequest('yandexCourierAddr');
    }

    public function getHouse() {
        return getRequest('yandexCourierHouse');
    }

    public function getFlat() {
        return getRequest('yandexDeliveryFlat');
    }

    public static function getFullAddress()
    {
        return getRequest('deliveryTariffAddress');
    }

    public static function getPointId() 
    {
        return getRequest('deliveryTariffPoint');
    }

    public static function getName()
    {
        return getRequest('deliveryTariffName');
    }

    public static function getDeliveryPrice() 
    {
        return getRequest('deliveryTariffCost');
    }

    public static function getDeliveryType() 
    {
        return getRequest('deliveryTariffType');
    }
}