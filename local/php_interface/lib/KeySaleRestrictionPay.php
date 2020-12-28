<?php

use Bitrix\Sale\Services\Base;
use Bitrix\Sale\Internals\Entity;
use Bitrix\Sale\Payment;
use Bitrix\Sale;


class KeySaleRestrictionPay extends Base\Restriction
{
    public static function getClassTitle()
    {
        return 'Продажа контента (скрываем)';
    }

    public static function getClassDescription()
    {
        return 'Скрывает платежные системы, когда в корзине только электронный товар';
    }


    public static function check($params, array $restrictionParams, $serviceId = 0)
    {
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $ids = [];
        foreach ($basket as $item) {
            $ids[] = $item->getProductId();
        }
        return KeySaleRestrictionPay::getItemsProperty($ids);
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
                return true;
            }
            return false;
        }
        return false;
    }


    protected static function extractParams(Entity $entity)
    {
        return [];
    }


    public static function getParamsStructure($entityId = 0)
    {

        $arCase = array(
            "Y" => "Скрывать платежные системы",
        );

        return array(
            "AVAIL_SCORE" => array(
                "TYPE"     => "ENUM",
                'MULTIPLE' => 'N',
                "LABEL"    => "Скрывает платежные системы, когда в корзине только электронный товар",
                "OPTIONS"  => $arCase,
            )
        );
    }
}