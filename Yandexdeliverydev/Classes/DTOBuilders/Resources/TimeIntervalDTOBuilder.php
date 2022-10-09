<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\TimeIntervalDTO;

class TimeIntervalDTOBuilder
{
    public function build($offer) {
        if (!is_array($offer)) {
            $offer = explode(';', $offer);
        }
        $timeintervalDTO = new TimeIntervalDTO();
        $timeintervalDTO->unixTo = $offer[1];
        $timeintervalDTO->unixFrom = $offer[0];
        $timeintervalDTO->to = date('d.m.Y H:i', $offer[1]);
        $timeintervalDTO->from = date('d.m.Y H:i', $offer[0]);
        return $timeintervalDTO;
    }


    public function buildList($offers) 
    {
        $formatted = [];
        foreach ($offers['offers'] as $offer) {
            $timeintervalDTO = new TimeIntervalDTO();
            $timeintervalDTO->unixTo = $offer['to'];
            $timeintervalDTO->unixFrom = $offer['from'];
            $timeintervalDTO->to = date('d.m.Y H:i', $offer['to']);
            $timeintervalDTO->from = date('d.m.Y H:i', $offer['from']);
            $formatted[] = $timeintervalDTO;
        }
        return $formatted;
    }
}