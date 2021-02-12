<?php

    include_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/init.php";
    
    // Проверка остатков
    Bitrix\Main\EventManager::getInstance()->addEventHandler(
        'sale',
        'OnSaleOrderSaved',
        'saleOrderBeforeSaved'
    );

    function saleOrderBeforeSaved(Bitrix\Main\Event $event)
    {
        $order = $event->getParameter("ENTITY");
        $basket = $order->getBasket();
        $basketItems = $basket->getBasketItems();
        $ids = [];
        foreach ($basket as $basketItem) {
            $ids[] = $basketItem->getProductId();
        }


        // Достаем остатки
        CModule::IncludeModule("catalog");
        $amount_info = [];
        foreach ($ids as $id) {
            $rsStore = CCatalogStoreProduct::GetList(
                array(),
                array('PRODUCT_ID' => $ids),
                false,
                false,
                array('AMOUNT', 'PRODUCT_ID')
            );
            if ($arStore = $rsStore->Fetch()) {
                $amount_info[] = $arStore;
            }
        }

        // Сохраняем id заканчивающихся товаров
        $info_no_amount = [];
        $ids_no_amount = [];
        foreach ($amount_info as $item) {
            if ($item["AMOUNT"] < 2) {
                $info_no_amount[$item["PRODUCT_ID"]] = $item["AMOUNT"];
                $ids_no_amount[] = $item["PRODUCT_ID"];
            }
        }

        // Достаем информацию о товарах
        if (!empty($ids_no_amount)) {
            $goods     = [];
            $res_goods = CIBlockElement::GetList(
                array(),
                array(
                    "IBLOCK_ID" => 13,
                    "ID"        => $ids_no_amount
                ),
                false,
                false,
                array("ID", "IBLOCK_ID", "NAME")
            );
            while ($ar_fields = $res_goods->GetNext()) {
                $goods[$ar_fields["ID"]]["NAME"] = $ar_fields["NAME"];
                $goods[$ar_fields["ID"]]["CNT"] = $info_no_amount[$ar_fields["ID"]];
            }


            if (!empty($goods)) {

                $message = '';
                foreach ($goods as $product) {
                    $message .= $product["NAME"].': '.$product["CNT"].' шт. \n';
                }

                $arEventFields = array(
                    "INFO" => $message
                );

                CEvent::Send("SELECT_AMOUNT", 's1', $arEventFields);
            }
        }
    }