<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTO;

class OrderDTO
{
    /** @var int $id */
    public $id;

    /** @var float $totalPrice */
    public $totalPrice;

    /** @var array $items */
    public $items;

    /** @var float $weight */
    public $weight;

    /** @var float $width */
    public $width;

    /** @var float $height */
    public $height;

    /** @var float $length */
    public $length;

    /** @var int $customerId */
    public $customerId;

    /** @var float $volume */
    public $volume;

    /** @var int $paymentId */
    public $paymentId;

    /** @var int $deliveryId */
    public $deliveryId;

    /** @var string $comment */
    public $comment;

    /** @var boolean $isPrepaid */
    public $isPrepaid;
}