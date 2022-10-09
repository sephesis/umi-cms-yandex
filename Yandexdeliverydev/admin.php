<?php

use UmiCms\Service;
use UmiCms\Classes\Components\Yandexdeliverydev\Config;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\PickupPointsDTOBuilder as RequestPickPoints;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\RequestBuilders\CalculatePricesDTOBuilder;
use UmiCms\Classes\Components\Yandexdeliverydev\Requests\RequestSender;
use UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources\PickPointListDTOBuilder;


class YandexdeliverydevAdmin 
{
    use baseModuleAdmin;
    
    public function config()
    {
        $groupKey = 'common';
		$includePickupPoints = 'boolean:includePickupPoints';
        $apikey = 'string:yandexApiKey';
        $platformStationId = 'string:platformStationId';

		$params = [
			$groupKey => [
				$includePickupPoints => false,
                $apikey => null,
                $platformStationId => null,
			]
		];

		$umiRegistry = Service::Registry();

		if ($this->isSaveMode()) {
			$params = $this->expectParams($params);
			$umiRegistry->set($includePickupPoints, $params[$groupKey][$includePickupPoints]);
            $umiRegistry->set($apikey, $params[$groupKey][$apikey]);
            $umiRegistry->set($platformStationId, $params[$groupKey][$platformStationId]);
			$this->chooseRedirect();
		}

		$params[$groupKey][$includePickupPoints] = $umiRegistry->get($includePickupPoints);
        $params[$groupKey][$apikey] = $umiRegistry->get($apikey);
        $params[$groupKey][$platformStationId] = $umiRegistry->get($platformStationId);

		$this->setConfigResult($params);
    }
}