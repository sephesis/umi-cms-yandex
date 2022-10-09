<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\DeliveryDTO;
use UmiCms\Classes\Components\YandexDeliverydev\Formatters\Numeric\NumFormatter;

class DeliveryDTOBuilder
{
    private $delivery = null;
    private $timeInterval;
    private $deliverySelectedPointId;
    private $deliveryName;
    private $deliveryType;
    private $deliveryCost;
    private $deliveryFullAddress;
    private $comment;

    public function __construct(string $timeInterval, array $deliveryFullAddress, string $deliverySelectedPointId = '', string $deliveryName, string $deliveryType, string $deliveryCost, $id = 0, $comment = '')
    {
        $this->deliverySelectedPointId = $deliverySelectedPointId;
        $this->timeInterval = $timeInterval;
        $this->deliveryName = $deliveryName;
        $this->deliveryType = $deliveryType;
        $this->comment = $comment;
        $this->deliveryCost = $deliveryCost;
        $this->deliveryFullAddress = $deliveryFullAddress;
        if ((int) $id > 0) {
            $this->delivery = \delivery::get($id);
        }
    }

    public function build()
    {
        //if ($this->delivery === null) return false;
        $timeIntervalDTO = new TimeIntervalDTOBuilder();
        $deliveryDTO = new DeliveryDTO();
        $deliveryDTO->id = $this->delivery->id;
        $deliveryDTO->deliveryAddress = $this->deliveryFullAddress['address'];
        $deliveryDTO->deliveryFullAddress = $this->deliveryFullAddress['full_address'];
        $deliveryDTO->deliveryCity = $this->deliveryFullAddress['city'];
        $deliveryDTO->deliveryFlat = $this->deliveryFullAddress['flat'];
        $deliveryDTO->deliveryPrice = NumFormatter::clean($this->deliveryCost);
        $deliveryDTO->deliverySelectedPointId = $this->deliverySelectedPointId;
        //$deliveryDTO->deliveryCoords = explode(',', $this->deliveryTariff);
        $deliveryDTO->comment = $this->comment;
        $deliveryDTO->deliveryType = $this->deliveryType;
        $deliveryDTO->isSelfPickup = $this->deliveryType == 'custom_location' ? false : true;
        $deliveryDTO->timeInterval = $timeIntervalDTO->build($this->timeInterval);
        return $deliveryDTO;
    }
}