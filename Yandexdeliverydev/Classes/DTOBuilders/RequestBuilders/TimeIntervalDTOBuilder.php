<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\RequestParamsDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\Requests\RequestSender;

class TimeIntervalDTOBuilder
{
    public function build(array $data = []): RequestParamsDTO
    {   
        $requestParams = new RequestParamsDTO();
        $requestParams->apimethod = 'offers/info';
        $requestParams->method = RequestSender::GET_METHOD;
        $requestParams->headers = [
            'Authorization' => 'Bearer y0_AgAAAAAdXsvCAAVM1QAAAADO5qgScodhQKNwQ-6yHgWXs4LC0iuik2I',
            'Content-Type'  => 'application/json',
            'platform' => 'umi',
        ];
        $requestParams->params = $data;
        return $requestParams;
    }
}