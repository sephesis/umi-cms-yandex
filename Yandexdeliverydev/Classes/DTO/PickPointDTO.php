<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTO;

class PickPointDTO
{
    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var float $longtitude */
    public $longitude;

    /** @var float $latitude */
    public $latitude;

    /** @var string $type */
    public $type;

    /** @var array $schedule */
    public $schedule;

    /** @var string $country */
    public $country;

    /** @var string $locality */
    public $locality;

    /** @var string $street */
    public $street;

    /** @var string $house */
    public $house;

    /** @var string $fullAddress */
    public $fullAddress;

    /** @var boolean $isPostOffice */
    public $isPostOffice;

    /** @var boolean $isYandexBranded */
    public $isYandexBranded;

    /** @var string $paymentMethods */
    public $paymentMethods;
}