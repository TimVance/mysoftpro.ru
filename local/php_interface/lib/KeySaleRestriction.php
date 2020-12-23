<?php


class KeySaleRestriction extends Bitrix\Sale\Delivery\Restrictions\Base
{

    public static $catalog_block_id = 13;

    public static function getClassTitle()
    {
        return 'Продажа контента';
    }

    public static function getClassDescription()
    {
        return 'Ограничение для модуля "Продажа контента"';
    }

    protected static function extractParams(Bitrix\Sale\Shipment $shipment)
    {
        $item_ids = [];
        foreach ($shipment->getShipmentItemCollection() as $shipmentItem) {
            $basketItem = $shipmentItem->getBasketItem();
            $item_ids[] = $basketItem->getProductId();
        }
        return KeySaleRestriction::getItemsProperty($item_ids);
    }

    protected static function getItemsProperty($ids) {
        if (!empty($ids)) {
            $res = CIBlockElement::GetList(
                [],
                [
                    "IBLOCK_ID" => 13,
                    "ID" => $ids,
                    "!PROPERTY_SALE_CONTENT" => 64
                ],
                false,
                false,
                ["ID", "NAME", "PROPERTY_SALE_CONTENT"]
            );
            $items = [];
            while($item = $res->Fetch()) {
                $items[] = $item;
            }
            return $items;
        }
        return array();
    }

    public static function getParamsStructure($deliveryId = 0)
    {
        return array();
    }

    public static function check($shipmentParams, array $restrictionParams, $deliveryId = 0)
    {
        if (!empty($shipmentParams)) return true;
        else return false;
    }
}