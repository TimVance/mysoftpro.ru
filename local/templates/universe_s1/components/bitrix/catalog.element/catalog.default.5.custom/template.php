<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\bitrix\Component;
use intec\core\helpers\FileHelper;
use intec\core\helpers\Json;
use intec\core\helpers\Html;

/**
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 */
 

// echo "<pre>".print_r($arResult["DISPLAY_PROPERTIES"], 1)."</pre>";

$this->setFrameMode(true);

Loc::loadMessages(__FILE__);

$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

/**
 * @var array $arData
 */
include(__DIR__.'/parts/data.php');

$arVisual = $arResult['VISUAL'];
$arFields = $arResult['FIELDS'];
$arSvg = [
    'NAVIGATION' => [
        'LEFT' => FileHelper::getFileData(__DIR__.'/svg/gallery.preview.navigation.left.svg'),
        'RIGHT' => FileHelper::getFileData(__DIR__.'/svg/gallery.preview.navigation.right.svg')
    ],
    'SIZES' => FileHelper::getFileData(__DIR__.'/svg/sizes.svg'),
    'DELIVERY_CALCULATION' => FileHelper::getFileData(__DIR__.'/svg/delivery.svg'),
    'BUTTONS' => [
        'COMPARE' => FileHelper::getFileData(__DIR__.'/svg/button.action.compare.svg'),
        'DELAY' => FileHelper::getFileData(__DIR__.'/svg/button.action.delay.svg'),
        'BASKET' => FileHelper::getFileData(__DIR__.'/svg/button.action.basket.svg'),
    ],
    'PRICE' => [
        'DIFFERENCE' => FileHelper::getFileData(__DIR__.'/svg/purchase.price.difference.svg'),
        'CHEAPER' => FileHelper::getFileData(__DIR__.'/svg/purchase.cheaper.svg')
    ],
    'STORE' => [
        'LIST' => FileHelper::getFileData(__DIR__.'/svg/store.section.list.svg'),
        'MAP' => FileHelper::getFileData(__DIR__.'/svg/store.section.map.svg')
    ]
];

$bOffers = !empty($arResult['OFFERS']);
$bSkuDynamic = $bOffers && $arResult['SKU']['VIEW'] === 'dynamic';
$bSkuList = $bOffers && $arResult['SKU']['VIEW'] === 'list';

$bAdditionalColumn = ($arFields['BRAND']['SHOW'] && $arVisual['BRAND']['ADDITIONAL']['SHOW'] && $arVisual['BRAND']['ADDITIONAL']['POSITION'] === 'column') ||
    ($arFields['DOCUMENTS']['SHOW'] && $arVisual['DOCUMENTS']['POSITION'] === 'column') ||
    ($arFields['RECOMMENDED']['SHOW'] && $arVisual['RECOMMENDED']['POSITION'] === 'column') ||
    ($arFields['ASSOCIATED']['SHOW'] && $arVisual['ASSOCIATED']['POSITION'] === 'column');

if (!$bAdditionalColumn) {
    $arVisual['INFORMATION']['BUY']['POSITION'] = 'wide';
    $arVisual['INFORMATION']['PAYMENT']['POSITION'] = 'wide';
    $arVisual['INFORMATION']['SHIPMENT']['POSITION'] = 'wide';
}

$bInformation = ($arVisual['INFORMATION']['BUY']['SHOW'] && $arVisual['INFORMATION']['BUY']['POSITION'] === 'wide') ||
    ($arVisual['INFORMATION']['PAYMENT']['SHOW'] && $arVisual['INFORMATION']['PAYMENT']['POSITION'] === 'wide') ||
    ($arVisual['INFORMATION']['SHIPMENT']['SHOW'] && $arVisual['INFORMATION']['SHIPMENT']['POSITION'] === 'wide');

$bRecalculation = false;

if ($bBase && $arVisual['PRICE']['RECALCULATION'])
    $bRecalculation = true;
?>
<?= Html::beginTag('div', [
    'id' => $sTemplateId,
    'class' => [
        'ns-bitrix',
        'c-catalog-element',
        'c-catalog-element-catalog-default-5'
    ],
    'data' => [
        'data' => Json::encode($arData, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_APOS, true),
        'properties' => !empty($arResult['SKU_PROPS']) ? Json::encode($arResult['SKU_PROPS'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_APOS, true) : '',
        'available' => $arData['available'] ? 'true' : 'false',
        'main-view' => $arVisual['MAIN_VIEW']
    ]
]) ?>
    <div class="catalog-element-delimiter"></div>
    <?= Html::beginTag('div', [
        'class' => 'catalog-element-body',
        'data' => [
            'role' => 'dynamic',
            'recalculation' => $bRecalculation ? 'true' : 'false'
        ],
		'itemscope' => '',
		'itemtype' => 'http://schema.org/Product'
    ])?>
        <?php if ($arVisual['PANEL']['DESKTOP']['SHOW'] && (!$bOffers || $bSkuDynamic))
            include(__DIR__.'/parts/panel.php');
        ?>
        <?php if ($arVisual['PANEL']['MOBILE']['SHOW'] && (!$bOffers || $bSkuDynamic)) { ?>
            <!--noindex-->
            <?php include(__DIR__.'/parts/panel.mobile.php'); ?>
            <!--/noindex-->
        <?php } ?>
        <div class="intec-content intec-content-visible">
            <div class="intec-content-wrapper">
                <div class="catalog-element-main-container">
                    <?php
                        include(__DIR__ . '/parts/main.container.view.'.$arVisual['MAIN_VIEW'].'.php');
                    ?>
                </div>
                <?php if (!$bSkuList)
                    include(__DIR__.'/parts/sets.php');
                ?>
                <?php 
		            include(__DIR__.'/parts/advantages.php');
		        ?>
            </div>
        </div>

        <div class="intec-content intec-content-visible">
            <div class="intec-content-wrapper">
                <div class="catalog-element-additional-container">
                    <div class="intec-grid intec-grid-wrap intec-grid-i-h-16 intec-grid-1024-wrap">
                        <?= Html::beginTag('div', [
                            'class' => Html::cssClassFromArray([
                                'catalog-element-additional-base-container' => !$bAdditionalColumn,
                                'catalog-element-additional-left-container' => $bAdditionalColumn,
                                'intec-grid-item' => [
                                    '' => !$bAdditionalColumn,
                                    'auto' => $bAdditionalColumn,
                                    '1024-1' => true
                                ]
                            ], true)
                        ]) ?>
                            <?php if ($bSkuList)
                                include(__DIR__.'/parts/offers.list.php');

                            if ($arVisual['SECTIONS']) {
                                include(__DIR__.'/parts/sections.php');



?>
<? /* ==================== edost НАЧАЛО (инициализация модуля) */ ?>
<?
    $delivery_img = $APPLICATION->IncludeComponent('edost:catalogdelivery', '', array(
        'PARAM' => array(
//            'sort' => 'ASC', // 'ASC' - сортировка по возрастанию, 'cpcr:simple|edost:3|1' - сортировка по тарифам (работает только если нет модуля edost.delivery)
//            'show_error' => 'Y', // 'Y' - показывать ошибки
//            'location_id_default' => '1234', // код местоположения по умолчанию
//            'ico_default' => '/bitrix/images/delivery_edost_img/0.gif', // дефолтная иконка тарифа
            'price_value' => 'max', // если у товара несколько цен, тогда брать минимальную 'min' (по умолчанию), максимальную 'max', самую первую 'first'
            'minimize' => '|normal', // минимизация во встроенном блоке: '|normal' - маленькие иконки, '|full' - то же, что и 'normal' + показывать только самые дешевые тарифы каждой группы/службы доставки
//            'economize' => 'Y', // экономный расчет: 'Y' - уменьшение количества запросов, за счет снижения точности - доставка рассчитывается по округленному весу, стоимости и габаритам, '500|1000|N' - расчет по фиксированным параметрам (вес в граммах|стоимость в руб.|отключен учет габаритов)
//            'attract_weight' => '1200|3000|10000', // при экономном расчете притягивать округленный вес к указанным значениям
//            'attract_price' => '1500|3200', // при экономном расчете притягивать округленную цену к указанным значениям (здесь необходимо перечислить суммы от которых действует скидка с доставки)
            'max' => '10', // ограничение количества тарифов для встроенного блока
            'format_ico' => 'Y', // 'Y' - вместо первых попавшихся тарифов, выводить иконки групп (только с модулем edost.delivery)
//            'show_ico' => 'N', // 'N' - не показывать иконки
//            'show_day' => 'N', // 'N' - не показывать срок доставки
//            'show_day_inside' => 'N', // 'N' - не показывать срок доставки во встроенном блоке
//            'ico_size' => '', // размеры иконки тарифа: 'Y|' - ширина авто x высота фиксированная, '|Y' - ширина фиксированная x высота авто
//            'product_module' => 'catalog', // модуль для работы с товаром (по умолчанию 'catalog')
//            'restriction_category' => '8|9|7', // id категорий товаров для которых требуется отдельный кэш при экономном расчете, например, если есть скидки/надбавки на доставку по разделам через правила работы с корзиной (категории товаров из ограничений доставки устанавливать не нужно - они подключаются автоматически)
//            'no_free' => '3|140|142', // id тарифов, для которых не нужно выводить 'Бесплатно!' (или вместо этого массива, можно добавить в описание тарифа текст '[no_free]')
//            'edost_delivery' => 'N', // отключить обработку тарифов через модуль edost.delivery (вывод без шаблона eDost, выбора пунктов выдачи и т.д.)
//            'sale_discount' => 'Y', // учет скидок на доставку из правил работы с корзиной: 'Y' - включено (замедляет расчет, поэтому включать только по необходимости!)
//            'order' => 'edost', // параметры заказа через который будет рассчитываться доставка: 'old' - старый упрощенный заказ, 'edost' - ускоренный расчет только через модуль доставки edost.delivery, 'user_id|person_type|payment' - ид пользователя|тип плательщика|платежная система, '|' - текущий пользователь | остальные параметры заполняются автоматически, '|1|5' - текущий пользователь | тип плательщика '1' | платежная система '5', '||N' - заказ без платежной системы
        ),

//        'NO_DELIVERY_MESSAGE' => '<span style="color: #F00;">Расчет недоступен</span>', // сообщение, которое выводится, когда нет доступных способов доставки
//        "INFO" => "Здесь представлена ориентировочная стоимость доставки - окончательный расчет будет производиться на станице оформления заказа.", // выводится в шапке калькулятора
//        'SHOW_BUTTON' => 'Y', // 'Y' - кнопки 'Пересчитать' и 'Закрыть'

        'SHOW_QTY' => 'Y', // 'Y' - ячейка для ввода количества
        'SHOW_ADD_CART' => 'Y', // 'Y' - галочка 'Учитывать товары в корзине'
//        'IMAGE' => 'delivery_blue.png', // картинка калькулятора: delivery_blue.png, delivery_orange.png, delivery_red.png
        'COLOR' => 'clear_white', // цвет окна: blue, blue_light, green, orange, red, gray, black, white, clear_white, F00, FF00FF
//        'RADIUS' => '8', // скругление углов окна

//        'LOADING' => 'loading_f2.gif', // нестандартная иконка загрузки (в папке bitrix/components/edost/catalogdelivery/images)
//        'LOADING_SMALL' => 'loading_small_f2.gif', // нестандартная иконка загрузки маленькая (в папке bitrix/components/edost/catalogdelivery/images)
//        'SCRIPT' => 'Y', // 'Y' - подключать скрипты (с кэшированием НЕ работает!!!), 'N' - НЕ подключать скрипты, 'A' - подключать через JS при загрузке стрaницы (по умолчанию)

        'CACHE_TYPE' => 'A',
        'CACHE_GROUPS' => 'Y',
//        'CACHE_TIME' => '180',
    ), null, array('HIDE_ICONS' => 'Y'));
?>
<? /* ==================== edost КОНЕЦ */ ?>


<? /* ==================== edost НАЧАЛО (блок расчета) */ ?>
<?
    $product_id = $arResult['ID'];
    if (!empty($arResult['OFFERS']) && is_array($arResult['OFFERS'])) foreach ($arResult['OFFERS'] as $v) { $product_id = $v['ID']; break; }
//    if (!empty($arResult['LINKED_ELEMENTS']) && is_array($arResult['LINKED_ELEMENTS'])) foreach ($arResult['LINKED_ELEMENTS'] as $v) { $product_id = $v['ID']; break; }
    $product_name = str_replace(array('"', "'"), array('&quot;', '&quot;'), $arResult['NAME']);

    // задать собственную цену товара: [цена] или [цена|валюта] (если валюта не указана, расчет производится по валюте магазина)
//    echo '<input id="edost_catalogdelivery_product_price_'.$product_id.'" value="1005|RUB" type="hidden">';
//    foreach ($arResult['PRICES'] as $v) if (!empty($v['DISCOUNT_VALUE'])) { echo '<input id="edost_catalogdelivery_product_price_'.$product_id.'" value="'.$v['DISCOUNT_VALUE'].'|'.$v['CURRENCY'].'" type="hidden">'; break; }

?>
<style> #edost_catalogdelivery_window_head { font-size: 14px !important; } </style>
    <div style="padding: 5px 0 5px 0; margin-top: 20px; border-width: 1px 0 1px 0; border-style: solid; border-color: #E5E5E5;">
        <span id="edost_catalogdelivery_inside_city_head" style="display: none; color: #000;">Доставка в </span> <span id="edost_catalogdelivery_inside_city" style="font-weight: bold; padding: 5px 0px;"></span>
        <div id="edost_catalogdelivery_inside" style="padding: 5px 0px;">
            <div style="text-align: center;"><img style="vertical-align: top;" src="/bitrix/components/edost/catalogdelivery/images/loading.gif" width="64" height="64" border="0"></div>
        </div>
        <div id="edost_catalogdelivery_inside_detailed" style="padding: 0px"></div>
    </div>

<script type="text/javascript">
    edost_RunScript('preview', '<?=$product_id?>', '<?=$product_name?>'); // запуск расчета
</script>
<? /* ==================== edost КОНЕЦ */ ?>
<?




                            } else {
                                if ($arVisual['DESCRIPTION']['DETAIL']['SHOW'])
                                    include(__DIR__.'/parts/description.detail.php');

                                if ($arVisual['PROPERTIES']['DETAIL']['SHOW'])
                                    include(__DIR__.'/parts/properties.detail.php');

                                if (
                                    $arVisual['STORES']['USE'] && $arVisual['STORES']['POSITION'] === 'content' &&
                                    $arResult['SKU']['VIEW'] === 'dynamic'
                                )
                                    include(__DIR__.'/parts/stores.php');

                                if ($arFields['DOCUMENTS']['SHOW'] && $arVisual['DOCUMENTS']['POSITION'] === 'content')
                                    include(__DIR__.'/parts/documents.php');

                                if ($arFields['VIDEO']['SHOW'])
                                    include(__DIR__.'/parts/videos.php');

                                if ($arFields['ARTICLES']['SHOW'])
                                    include(__DIR__.'/parts/articles.php');

                                if ($arResult['REVIEWS']['SHOW'])
                                    include(__DIR__.'/parts/reviews.php');
                            }

                            if (
                                $arFields['BRAND']['SHOW'] && $arVisual['BRAND']['ADDITIONAL']['SHOW'] &&
                                $arVisual['BRAND']['ADDITIONAL']['POSITION'] === 'content'
                            )
                                include(__DIR__.'/parts/brand.additional.php');

                            if ($arFields['RECOMMENDED']['SHOW'] && $arVisual['RECOMMENDED']['POSITION'] === 'content')
                                include(__DIR__.'/parts/products.recommended.php');

                            if ($arFields['ASSOCIATED']['SHOW'] && $arVisual['ASSOCIATED']['POSITION'] === 'content')
                                include(__DIR__.'/parts/products.associated.php');

                            if ($arFields['SERVICES']['SHOW'])
                                include(__DIR__.'/parts/services.php');
                            ?>

                            <?php if (!$arVisual['SECTIONS'] && $bAdditionalColumn) { ?>
                                <?php if ($arVisual['INFORMATION']['BUY']['SHOW'] && $arVisual['INFORMATION']['BUY']['POSITION'] === 'column')
                                    include(__DIR__.'/parts/information.buy.php');

                                if ($arVisual['INFORMATION']['PAYMENT']['SHOW'] && $arVisual['INFORMATION']['PAYMENT']['POSITION'] === 'column')
                                    include(__DIR__.'/parts/information.payment.php');

                                if ($arVisual['INFORMATION']['SHIPMENT']['SHOW'] && $arVisual['INFORMATION']['SHIPMENT']['POSITION'] === 'column')
                                    include(__DIR__.'/parts/information.shipment.php');
                                ?>
                            <?php } ?>

                        <?= Html::endTag('div') ?>
                        <?php if ($bAdditionalColumn) { ?>
                            <div class="catalog-element-additional-right-container intec-grid-item-3 intec-grid-item-1024-1">
                                <?php if (
                                    $arFields['BRAND']['SHOW'] && $arVisual['BRAND']['ADDITIONAL']['SHOW'] &&
                                    $arVisual['BRAND']['ADDITIONAL']['POSITION'] === 'column'
                                )
                                    include(__DIR__.'/parts/brand.additional.php');

                                if ($arFields['DOCUMENTS']['SHOW'] && $arVisual['DOCUMENTS']['POSITION'] === 'column')
                                    include(__DIR__.'/parts/documents.small.php');

                                if ($arFields['RECOMMENDED']['SHOW'] && $arVisual['RECOMMENDED']['POSITION'] === 'column')
                                    include(__DIR__.'/parts/products.recommended.small.php');

                                if ($arFields['ASSOCIATED']['SHOW'] && $arVisual['ASSOCIATED']['POSITION'] === 'column')
                                    include(__DIR__.'/parts/products.associated.small.php');
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <?php if (!$arVisual['SECTIONS'] && $bInformation) { ?>
                    <div class="catalog-element-additional-container">
                        <?php if ($arVisual['INFORMATION']['BUY']['SHOW'] && $arVisual['INFORMATION']['BUY']['POSITION'] === 'wide')
                            include(__DIR__.'/parts/information.buy.php');

                        if ($arVisual['INFORMATION']['PAYMENT']['SHOW'] && $arVisual['INFORMATION']['PAYMENT']['POSITION'] === 'wide')
                            include(__DIR__.'/parts/information.payment.php');

                        if ($arVisual['INFORMATION']['SHIPMENT']['SHOW'] && $arVisual['INFORMATION']['SHIPMENT']['POSITION'] === 'wide')
                            include(__DIR__.'/parts/information.shipment.php');
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?= Html::endTag('div') ?>
    <?php include(__DIR__.'/parts/script.php') ?>
<?= Html::endTag('div') ?>