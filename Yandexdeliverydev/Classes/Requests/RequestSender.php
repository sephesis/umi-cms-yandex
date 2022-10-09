<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\Requests;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\Response;
use UmiCms\Classes\Components\Yandexdeliverydev\DTO\RequestParamsDTO;

class RequestSender
{
    const API_URL = 'https://b2b-authproxy.taxi.yandex.net/api/b2b/platform/';
    const POST_METHOD = 'post';
    const GET_METHOD = 'get';

    private function initHttpClient() 
    {
        return $this->httpClient = new Client(
            self::API_URL
        );
    }

    private function getHttpClient() 
    {
        return $this->initHttpClient();
    }

    public function request(RequestParamsDTO $requestparams)
    {
        switch ($requestparams->method) {
            case 'get':
                $request = $this->getHttpClient()->get(
                    $requestparams->apimethod, $requestparams->headers, $requestparams->params
                 );
                break;
            case 'post':
                $request = $this->getHttpClient()->post(
                   $requestparams->apimethod, $requestparams->headers, $requestparams->params
                );
                break;
        }
        return $this->getResponse($request);
    }

    private function getResponse(Request $request) {
        try {
            $response = $request->send();
        } catch (ClientErrorResponseException $mainException) {
            $response = $request->getResponse();
            $result = $this->getResponseBody($response);
        }
        return $this->getResponseBody($response);
    }

    private function getResponseBody(Response $response) {
        $body = $response->getBody(true);
        return empty($body) ? [] : $response->json();
    }

}