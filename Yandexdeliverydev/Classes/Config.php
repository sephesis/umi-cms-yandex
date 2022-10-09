<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev;

class Config
{
    const API_METHODS = [
        'calculate' => 'pricing-calculator',
        'create' => 'offers/create',
        'cancel' => 'request/cancel',
        'intervals' => 'offers/info',
        'pickPoints' => 'pickup-points/list',
    ];
    const TEST_PLATFORM_STATION = '7c4054cd-d768-4062-8f8d-d0c9b3c8c4e8';
    
    public static function getApiMethod(string $code) 
    {
        if (array_key_exists($code, self::API_METHODS))
        return self::API_METHODS[$code];
    }
}