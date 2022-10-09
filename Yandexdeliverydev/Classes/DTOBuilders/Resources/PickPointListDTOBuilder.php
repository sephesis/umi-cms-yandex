<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\PickPointDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\Formatters\DTOFormatter;

class PickPointListDTOBuilder
{
    public function buildList($pickpoints = []) {
        $dtoPickPoints = [];
        if ($pickpoints == null) { return $dtoPickPoints; }
        foreach ($pickpoints as $key => $pickpoint) {
            $pickpointDTO = new PickPointDTO();
            $pickpointDTO->id = $pickpoint['id'];
            $pickpointDTO->name = $pickpoint['name'];
            $pickpointDTO->longitude = $pickpoint['position']['longitude'];
            $pickpointDTO->latitude = $pickpoint['position']['latitude'];
            $pickpointDTO->type = $pickpoint['type'];
            $pickpointDTO->schedule = $pickpoint['schedule']['restrictions'];
            $pickpointDTO->country = $pickpoint['address']['country'];
            $pickpointDTO->locality = $pickpoint['address']['locality'];
            $pickpointDTO->street = $pickpoint['address']['street'];
            $pickpointDTO->house = $pickpoint['address']['house'];
            $pickpointDTO->fullAddress = $pickpoint['address']['full_address'];
            $pickpointDTO->isPostOffice = $pickpoint['is_post_office'];
            $pickpointDTO->isYandexBranded = $pickpoint['is_yandex_branded'];
            $pickpointDTO->paymentMethods = DTOFormatter::replacePaymentMethods(implode(', ',$pickpoint['payment_methods']));
            $dtoPickPoints[] = $pickpointDTO;
        }
        return $dtoPickPoints;
    }
}