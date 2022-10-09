<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTO;

class DeliveryDTO
{
    /** @var int $id */
    public $id;

    /** @var string $deliveryAddress */
    public $deliveryAddress;

    /** @var string $deliveryCity */
    public $deliveryCity;

    /** @var string $deliveryHouse */
    public $deliveryHouse;

    /** @var string $deliveryFlat */
    public $deliveryFlat;

    /** @var float $deliveryPrice */
    public $deliveryPrice;

    /** @var string $deliveryFullAddress */
    public $deliveryFullAddress;

    /** @var string $deliverySelectedPointId */
    public $deliverySelectedPointId;

    /** @var array $deliveryCoords */
    public $deliveryCoords;

    /** @var string $deliveryType */
    public $deliveryType;

    /** @var boolean $isSelfPickup */
    public $isSelfPickup;

    /** @var string $comment */
    public $comment;

    /** @var TimeIntervalDTO $timeInterval */
    public $timeInterval;
}