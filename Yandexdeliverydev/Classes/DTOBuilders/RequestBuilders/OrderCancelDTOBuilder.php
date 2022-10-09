<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\RequestParamsDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\Requests\RequestSender;

class OrderCancelDTOBuilder
{
    public function build($data): RequestParamsDTO
    {   
        $requestParams = new RequestParamsDTO();
        $requestParams->apimethod = 'request/cancel';
        $requestParams->method = RequestSender::POST_METHOD;
        $requestParams->headers = [
            'Authorization' => 'Bearer y0_AgAAAAAdXsvCAAVM1QAAAADO5qgScodhQKNwQ-6yHgWXs4LC0iuik2I',
            'Content-Type'  => 'application/json',
        ];
        $requestParams->params = json_encode($data);
        return $requestParams;
    }
}