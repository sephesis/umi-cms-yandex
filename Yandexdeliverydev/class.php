<?php

use UmiCms\Service;

class Yandexdeliverydev extends def_module {

		public function __construct() 
        {
			parent::__construct();
			if (Service::Request()->isAdmin()) {
				$this->initTabs()
					 ->includeAdminClasses();
			}
			$this->includeCommonClasses();
		}


		public function initTabs() 
        {
			$configTabs = $this->getConfigTabs();
			if ($configTabs instanceof iAdminModuleTabs) {
				$configTabs->add('config');
			}
			return $this;
		}

		public function includeAdminClasses() 
        {
            foreach (self::getAdminClasses() as $file => $namespace) {
                $this->__loadLib($file);
                $this->__implement($namespace);
            }
			return $this;
		}


        private static function getAdminClasses() 
        {
           $mainnamespace = 'UmiCms\Classes\Components\Yandexdeliverydev';
           return  [
                'admin.php' => 'YandexdeliverydevAdmin',
                'Classes/Config.php' => $mainnamespace,
                'Classes/InputParams.php' => $mainnamespace,
                'Classes/DTO/CustomerDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/DeliveryDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/OrderDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/OrderItemDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/PaymentDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/RequestParamsDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/PickPointDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTO/TimeIntervalDTO.php' => $mainnamespace . '\DTO',
                'Classes/DTOBuilders/DataBuilder.php' => $mainnamespace . '\DTOBuilders',
                'Classes/DTOBuilders/RequestBuilders/CalculatePricesDTOBuilder.php' => $mainnamespace . '\DTOBuilders\RequestBuilders',
                'Classes/DTOBuilders/RequestBuilders/OffersDTOBuilder.php' => $mainnamespace . '\DTOBuilders\RequestBuilders',
                'Classes/DTOBuilders/RequestBuilders/OrderCancelDTOBuilder.php' => $mainnamespace . '\DTOBuilders\RequestBuilders',
                'Classes/DTOBuilders/RequestBuilders/OrderCreateDTOBuilder.php' => $mainnamespace . '\DTOBuilders\RequestBuilders',
                'Classes/DTOBuilders/RequestBuilders/PickupPointsDTOBuilder.php' => $mainnamespace . '\DTOBuilders\RequestBuilders',
                'Classes/DTOBuilders/RequestBuilders/TimeIntervalDTOBuilder.php' => $mainnamespace . '\DTOBuilders\RequestBuilders',
                'Classes/DTOBuilders/Resources/CustomerDTOBuilder.php' => $mainnamespace . '\DTOBuilders\Resources',
                'Classes/DTOBuilders/Resources/DeliveryDTOBuilder.php' => $mainnamespace . '\DTOBuilders\Resources',
                'Classes/DTOBuilders/Resources/OrderDTOBuilder.php' => $mainnamespace . '\DTOBuilders\Resources',
                'Classes/DTOBuilders/Resources/OrderItemDTOBuilder.php' => $mainnamespace . '\DTOBuilders\Resources',
                'Classes/DTOBuilders/Resources/PickPointListDTOBuilder.php' => $mainnamespace . '\DTOBuilders\Resources',
                'Classes/DTOBuilders/Resources/TimeIntervalDTOBuilder.php' => $mainnamespace . '\DTOBuilders\Resources',
                'Classes/Exceptions/YandexDeliveryException.php' => $mainnamespace . '\Exceptions',
                'Classes/Formatters/OrderFormatter.php' => $mainnamespace . '\Formatters',
                'Classes/Formatters/Numeric/NumFormatter.php' => $mainnamespace . '\Formatters\Numeric',
                'Classes/Formatters/DTOFormatter.php' => $mainnamespace . '\Formatters',
                'Classes/Helpers/UmiObjectHelper.php' => $mainnamespace . '\Helpers',
                'Classes/Requests/RequestSender.php' => $mainnamespace . '\Requests',
                'macros.php' => 'YandexdeliverydevMacros'
            ];
        }

		
		public function includeCommonClasses() {
            foreach (self::getAdminClasses() as $file => $namespace) {
                $this->__loadLib($file);
                $this->__implement($namespace);
            }
			return $this;
		}

        private function getCommonClasses()
        {
            return [
                'macros.php' => 'YandexdeliverydevMacros'
            ];
        }
       
}

