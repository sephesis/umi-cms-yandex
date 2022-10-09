<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\CustomerDTO;

class CustomerDTOBuilder
{
    private $customer = null;

    public function __construct()
    {
        $this->customer = \customer::get($id);
    }

    public function build(): CustomerDTO
    {
        if ($this->customer === null) return false;
        $customerDTO = new CustomerDTO();
        $customerDTO->id = $this->customer->id;
        $customerDTO->name = $this->customer->getValue('fname');
        $customerDTO->secondname = $this->customer->getValue('father_name');
        $customerDTO->lastname = $this->customer->getValue('lname');
        $customerDTO->email = $this->customer->email ?: $this->customer->getValue('e-mail');
        $customerDTO->phone = $this->customer->phone ?: $this->customer->getValue('phone');
        return $customerDTO;
    }
}