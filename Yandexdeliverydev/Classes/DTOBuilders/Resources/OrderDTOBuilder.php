<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\OrderDTO;

class OrderDTOBuilder
{
    private $order;

    public function __construct(\order $order)
    {
        $this->order = $order;
    }

    public function build(): OrderDTO 
    {
        if ($this->order == null) return false;
        $orderDTO = new OrderDTO();
        $orderDTO->id = $this->order->getId();
        $orderDTO->weight = $this->order->getTotalWeight();
        $orderDTO->height = $this->order->getTotalHeight();
        $orderDTO->length = $this->order->getTotalLength();
        $orderDTO->totalPrice = $this->order->getActualPrice();
        $orderDTO->width = $this->order->getTotalWidth();
        $orderDTO->volume = $orderDTO->width * $orderDTO->height * $orderDTO->length;
        $orderDTO->paymentId = $this->order->getPaymentId();
        $orderDTO->deliveryId = $this->order->getDeliveryId();
        $orderDTO->items = $this->order->getItems();
        $orderDTO->customerId = $this->order->getCustomerId();
        $orderDTO->comment = $this->order->getValue('comment') ?: '';
        $orderDTO->isPrepaid = false;
        return $orderDTO;
    }
}