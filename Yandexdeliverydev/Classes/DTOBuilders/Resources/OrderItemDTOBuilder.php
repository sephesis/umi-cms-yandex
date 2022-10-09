<?php

namespace UmiCms\Classes\Components\Yandexdeliverydev\DTOBuilders\Resources;

use UmiCms\Classes\Components\Yandexdeliverydev\DTO\OrderItemDTO;
use UmiCms\Classes\Components\Yandexdeliverydev\Helpers\UmiObjectHelper;

class OrderItemDTOBuilder
{
    public function buildList($items): array 
    {   
        $dtoItems = [];
        foreach ($items as $item) {
            $element = $item->getItemElement();
            $article = '';
            if ($element instanceof \umiHierarchyElement) {
                $article = $element->getValue('isbn');
            }
            $dtoItem = new OrderItemDTO();
            $dtoItem->id = $item->id;
            $dtoItem->name = $item->getName();
            $dtoItem->price = $item->getActualPrice();
            $dtoItem->length = $item->getLength();
            $dtoItem->width = $item->getWidth();
            $dtoItem->height = $item->getHeight();
            $dtoItem->length = $item->getLength();
            $dtoItem->volume = $dtoItem->width * $dtoItem->height * $dtoItem->length;
            $dtoItem->weight = $item->getWeight();
            $dtoItem->quantity = $item->getAmount();
            $dtoItem->article = $article;
            $dtoItems[] = $dtoItem;
        }
        return $dtoItems;
    }
}