<?php

use UmiCms\Service;

use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\PickupPointsDTOBuilder as RequestPickPoints;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\CalculatePricesDTOBuilder;
use UmiCms\Classes\Components\Yandexdeliverydev\Requests\RequestSender;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources\PickPointListDTOBuilder;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\TimeIntervalDTOBuilder;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources\TimeIntervalDTOBuilder as ResourceDTO;

class YandexdeliverydevMacros
{
    public function getPickupPointsList() 
    {
        $dtoBuilder = new RequestPickPoints();
        $data = [
            'available_for_dropoff' => false,
            'type' => 'pickup_point',
            'payment_method' => 'card_on_receipt',
        ];
        $params = $dtoBuilder->build($data);
        $request = new RequestSender();
        $points = $request->request($params)['points'];
        $pickpointList = new PickPointListDTOBuilder();
        if (count($pickpointList) > 0) {
            echo json_encode($pickpointList->buildList($points));
        }else{
            echo json_encode([]);
        }
        die();
    }

    public function getTimeIntervalList()
    {
        $filter = [];

        $data = [
            'query' => [ 
                'station_id' => '30baf1f5-9afb-4375-866e-c2ae29ebf1bd',
                'send_unix' => true,
                'last_mile_policy' => 'time_interval',
            ]
        ];
        if (!empty($_POST['full_address'])) {
            $data['query']['full_address'] = $_POST['full_address'];
        }

        if (!empty($_POST['self_pickup_id'])) {
            $data['query']['self_pickup_id'] = $_POST['self_pickup_id'];
        }

        $timeIntervalsParams = (new TimeIntervalDTOBuilder())->build($data);
       
        $request = new RequestSender();
        $offers = $request->request($timeIntervalsParams);
        $resource = new ResourceDTO();
        $result = $resource->buildList($offers);
      //  if (!array_key_exists('error_details', $offers) && (int)$offers['code'] !== 400) {
            $result = [
                'success' => true,
                'offers' => $result,
            ];

            file_put_contents($_SERVER['DOCUMENT_ROOT'] .'/offers.txt', print_r($offers, true));
       // }else{
       //     $result = [
       //         'success' => false,
       //         'error' => $offers['message'],
       //     ];
       // }
        echo json_encode($result);
        die();
    }

    public function calculateDelivery()
    {
        $data = [
            'source' => [
                'platform_station_id' => '30baf1f5-9afb-4375-866e-c2ae29ebf1bd',
            ],
            'tariff' => $_POST['tariff'],
            'total_weight' => (float)$_POST['weight'] * 1000,
        ];

        if (isset($_POST['address']) && !empty($_POST['address'])) {
            $data['destination']['address'] = $_POST['address'];
        }

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $data['destination']['platform_station_id'] = $_POST['id'];
        }
        
        $params = (new CalculatePricesDTOBuilder())->build($data);
        $request = new RequestSender();
        $prices = $request->request($params);
        if (array_key_exists('pricing_total', $prices) && !$prices['error']) {
            $prices['pricing_total'] = str_replace('RUB', 'руб.', $prices['pricing_total']);
            $result= [
                'success' => true,
                'data' => $prices,
            ];
        }else{
            $result = [
                'success' => false,
                'data' => $prices,
            ];
        }
        echo json_encode($result);
        exit();
    }
}