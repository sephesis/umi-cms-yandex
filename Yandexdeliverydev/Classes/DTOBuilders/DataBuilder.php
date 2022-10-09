<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\OrderDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\DTO\CustomerDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\DTO\DeliveryDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\OrderCreateDTOBuilder;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\OrderCancelDTOBuilder;
use UmiCms\Classes\Components\Yandexdeliverydev\Requests\RequestSender;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\OffersDTOBuilder;


class DataBuilder
{
    private $order;
    private $customer;
    private $orderItems;
    private $delivery;

    //private static $requestId = 'bc7fb196-f875-434b-9a70-67844e4707cd';

    public function __construct(OrderDTO $order, CustomerDTO $customer = null, DeliveryDTO $delivery, array $orderItems) {
        $this->order = $order;
        $this->customer = $customer;
        $this->orderItems = $orderItems;
        $this->delivery = $delivery;
    }

    public function buildData() {
        $result['billing_info'] = $this->getBillingInfo();
        $result['destination'] = $this->getDestinationInfo();
        $result['info'] = $this->getInfo();
        $result['items'] = $this->getItems();
        $result['last_mile_policy'] = $this->delivery->deliveryType === 'custom_location' ? 'time_interval' : 'self_pickup';
        $result['particular_items_refuse'] = false;
        $result['places'] = $this->getPlaces();
        $result['recipient_info'] = $this->getRecipientInfo();
        $result['source'] = $this->getSource();
   
        $orderSender = new OrderCreateDTOBuilder();
        $params = $orderSender->build($result);
        $request = new RequestSender();
        $response = $request->request($params);

        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/response.txt', print_r($response, true));
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/request.txt', print_r($result, true));
       echo '<pre>';
       var_dump($response);
       echo '</pre>';
       die();
        // $cancel = new OrderCancelDTOBuilder();
        // $params = $cancel->build($data = [
        //     'request_id' => 'fef4b1a2-a8da-4372-95c9-5b089eede9cd',
        // ]);
        // $request = new RequestSender();
        // $response = $request->request($params);
        // var_dump($response);
        // die();

        if (sizeof($response) > 0 && !array_key_exists('error', $response)) {
            $offer = $response['offers'][0];
            unset($response);
            $offerId = $offer['offer_id'];
            $data = [
                'offer_id' => $offerId,
            ];
            $offerDTOBuilder = (new OffersDTOBuilder())->build($data);
            $response = $request->request($offerDTOBuilder);
        }
        return $result;
    }

    private function getSource() {
        return [
            'platform_station' => [
                'platform_id' => '30baf1f5-9afb-4375-866e-c2ae29ebf1bd',
            ]
        ];
    }

    private function getRecipientInfo() 
    {
        return [
            'email' => $this->customer->email,
            'first_name' => $this->customer->name,
            'last_name' => $this->customer->lastname,
            'partonymic' => $this->customer->secondname,
            'phone' => $this->customer->phone,
        ];
    }



    private function getPlaces() 
    {
        $places = [];
        foreach ($this->orderItems as $item) {
            $place['barcode'] = $item->article;
            $place['physical_dims']['dx'] = $item->length;
            $place['physical_dims']['dy'] = $item->height;
            $place['physical_dims']['dz'] = $item->width;
            $place['physical_dims']['predefined_volume'] = $item->volume;
            $place['physical_dims']['weight_gross'] = $item->weight;
            $places[] = $place;
        }
        return $places;
    }

    private function getItems() 
    {
        $items = [];
        foreach ($this->orderItems as $item) {
            $preparedItem['article'] =  $item->article; //важное
            $preparedItem['billing_details']['assessed_unit_price'] = $item->price;
            $preparedItem['billing_details']['unit_price'] = $item->price;
            $preparedItem['count'] = $item->quantity;
            $preparedItem['name'] = $item->name;
            $preparedItem['physical_dims']['dx'] = $item->length;
            $preparedItem['physical_dims']['dy'] = $item->height;
            $preparedItem['physical_dims']['dz'] = $item->width;
            $preparedItem['physical_dims']['predefined_volume'] = $item->volume;
            $preparedItem['place_barcode'] = $item->article; //важное
            $items[] = $preparedItem;
        }
        return $items;
    }

    private function getInfo() 
    {
        return [
            'comment' => '',
            'operator_request_id' => (string) $this->order->id,
        ];
    }

    private function getDestinationInfo() 
    {
        $location = [];
        $intervalUTCFormat = !$this->delivery->isSelfPickup ? "Y-m-d H:i:s" : "Y-m-d";
        if (!$this->delivery->isSelfPickup) {
            $location = [
                "custom_location" => [
                    'details'=> [
                        'comment' => $this->delivery->comment,
                        'full_address' => $this->delivery->deliveryFullAddress,
                        'room' => $this->delivery->deliveryFlat,
                    ],
                ]
            ];
        }else{
            $location['platform_station'] = [
                'platform_id' => $this->delivery->deliverySelectedPointId,
            ];
        }
        $deliveryData = [
            "type" => $this->delivery->deliveryType,
            "interval" => [
                "from" => (int) $this->delivery->timeInterval->unixFrom,
                "to" => (int) $this->delivery->timeInterval->unixTo,
            ],
            "interval_utc" => [
                "from" => (string) date($intervalUTCFormat, trim($this->delivery->timeInterval->unixFrom)),
                "to" => (string) date($intervalUTCFormat, trim($this->delivery->timeInterval->unixTo)),
            ],
        ];

        return array_merge($deliveryData, $location);
    }

    private function getBillingInfo() 
    {
        return [
                'delivery_cost' => (int) $this->delivery->deliveryPrice * 100,
                'payment_method' => 'cash_on_receipt',
                ];
    }
}