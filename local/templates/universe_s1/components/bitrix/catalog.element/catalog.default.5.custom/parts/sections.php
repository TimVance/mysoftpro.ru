<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\Html;

/**
 * @var array $arResult
 * @var array $arVisual
 * @var array arFields
 */

$arSections = [
    'DESCRIPTION' => [
        'ID' => 'description',
        'SHOW' => false,
        'TYPE' => 'print',
        'NAME' => $arVisual['DESCRIPTION']['DETAIL']['NAME'],
        'VALUE' => null
    ],
    'PROPERTIES' => [
        'ID' => 'properties',
        'SHOW' => $arVisual['PROPERTIES']['DETAIL']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['PROPERTIES']['DETAIL']['NAME'],
        'VALUE' => __DIR__.'/sections/properties.php'
    ],

    'CERTIFICATES' => [
        'ID' => 'certificates',
        'SHOW' => $arVisual['INFORMATION']['CERTIFICATES']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['INFORMATION']['CERTIFICATES']['NAME'],
        'VALUE' => __DIR__.'/sections/certificates.php'
    ],
    
    'STORES' => [
        'ID' => 'stores',
        'SHOW' => $arVisual['STORES']['USE'] && $arVisual['STORES']['POSITION'] === 'content' && $arResult['SKU']['VIEW'] === 'dynamic',
        'TYPE' => 'file',
        'NAME' => $arVisual['STORES']['NAME'],
        'VALUE' => __DIR__.'/sections/stores.php'
    ],
    'DOCUMENTS' => [
        'ID' => 'documents',
        'SHOW' => $arFields['DOCUMENTS']['SHOW'] && $arVisual['DOCUMENTS']['POSITION'] === 'content',
        'TYPE' => 'file',
        'NAME' => $arVisual['DOCUMENTS']['NAME'],
        'VALUE' => __DIR__.'/sections/documents.php'
    ],
    'VIDEO' => [
        'ID' => 'video',
        'SHOW' => $arFields['VIDEO']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['VIDEO']['NAME'],
        'VALUE' => __DIR__.'/sections/video.php'
    ],
    'ARTICLES' => [
        'ID' => 'articles',
        'SHOW' => $arFields['ARTICLES']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['ARTICLES']['NAME'],
        'VALUE' => __DIR__.'/sections/articles.php'
    ],
    'REVIEWS' => [
        'ID' => 'reviews',
        'SHOW' => $arResult['REVIEWS']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arResult['REVIEWS']['NAME'],
        'VALUE' => __DIR__.'/sections/reviews.php'
    ],
    'BUY' => [
        'ID' => 'buy',
        'SHOW' => $arVisual['INFORMATION']['BUY']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['INFORMATION']['BUY']['NAME'],
        'VALUE' => __DIR__.'/sections/information.buy.php'
    ],
    'PAYMENT' => [
        'ID' => 'payment',
        'SHOW' => $arVisual['INFORMATION']['PAYMENT']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['INFORMATION']['PAYMENT']['NAME'],
        'VALUE' => __DIR__.'/sections/information.payment.php'
    ],
    'SHIPMENT' => [
        'ID' => 'shipment',
        'SHOW' => $arVisual['INFORMATION']['SHIPMENT']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['INFORMATION']['SHIPMENT']['NAME'],
        'VALUE' => __DIR__.'/sections/information.shipment.php'
    ],

    'HELP' => [
        'ID' => 'help',
        'SHOW' => $arVisual['INFORMATION']['HELP']['SHOW'],
        'TYPE' => 'file',
        'NAME' => $arVisual['INFORMATION']['HELP']['NAME'],
        'VALUE' => __DIR__.'/sections/help.php'
    ],
    'AKCII' => [
        'ID' => 'akcii',
        'SHOW' => "Y",
        'TYPE' => 'file',
        'NAME' => "Акции",
        'VALUE' => __DIR__.'/sections/akcii.php'
    ],
    'SERTIFICATE' => [
        'ID' => 'sertificate',
        'SHOW' => "Y",
        'TYPE' => 'file',
        'NAME' => "Сертификаты",
        'VALUE' => __DIR__.'/sections/sertificate.php'
    ],
];

if ($arVisual['DESCRIPTION']['DETAIL']['SHOW']) {
    if (empty($arSections['DESCRIPTION']['NAME']))
        $arSections['DESCRIPTION']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_ADDITIONAL_DESCRIPTION');

    if (!empty($arResult['DETAIL_TEXT']))
        $arSections['DESCRIPTION']['VALUE'] = &$arResult['DETAIL_TEXT'];
    else if ($arVisual['DESCRIPTION']['FROM_PREVIEW'] && !empty($arResult['PREVIEW_TEXT']))
        $arSections['DESCRIPTION']['VALUE'] = &$arResult['PREVIEW_TEXT'];

    if (!empty($arSections['DESCRIPTION']['VALUE']))
        $arSections['DESCRIPTION']['SHOW'] = true;
}

if ($arSections['PROPERTIES']['SHOW']) {
    if (empty($arSections['PROPERTIES']['NAME']))
        $arSections['PROPERTIES']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_PROPERTIES_DETAIL_NAME_DEFAULT');
}

if ($arSections['STORES']['SHOW']) {
    if (empty($arSections['STORES']['NAME']))
        $arSections['STORES']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_STORES_NAME_DEFAULT');
}

if ($arSections['DOCUMENTS']['SHOW']) {
    if (empty($arSections['DOCUMENTS']['NAME']))
        $arSections['DOCUMENTS']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_DOCUMENTS_NAME_DEFAULT');
}

if ($arSections['VIDEO']['SHOW']) {
    if (empty($arSections['VIDEO']['NAME']))
        $arSections['VIDEO']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_VIDEO_NAME_DEFAULT');
}

if ($arSections['ARTICLES']['SHOW']) {
    if (empty($arSections['ARTICLES']['NAME']))
        $arSections['ARTICLES']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_ARTICLES_NAME_DEFAULT');
}

if ($arSections['REVIEWS']['SHOW']) {
    if (empty($arSections['REVIEWS']['NAME']))
        $arSections['REVIEWS']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_REVIEWS_NAME_DEFAULT');
}

if ($arSections['BUY']['SHOW']) {
    if (empty($arSections['BUY']['NAME']))
        $arSections['BUY']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_ADDITIONAL_BUY');
}

if ($arSections['PAYMENT']['SHOW']) {
    if (empty($arSections['PAYMENT']['NAME']))
        $arSections['PAYMENT']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_ADDITIONAL_PAYMENT');
}

if ($arSections['SHIPMENT']['SHOW']) {
    if (empty($arSections['SHIPMENT']['NAME']))
        $arSections['SHIPMENT']['NAME'] = Loc::getMessage('C_CATALOG_ELEMENT_DEFAULT_5_TEMPLATE_ADDITIONAL_SHIPMENT');
}

?>
<div class="catalog-element-sections-container catalog-element-additional-block" data-role="section">
    <div class="catalog-element-sections">
        <?= Html::beginTag('div', [
            'class' => [
                'catalog-element-sections-tabs'
            ],
            'data' => [
                'role' => 'section.tabs',
                'sticky' => 'nulled'
            ]
        ]) ?>
            <div class="scrollbar-outer" data-role="scroll">
                <?php $bFirst = true ?>
                <?php foreach ($arSections as $arSection) {

                    if (!$arSection['SHOW'])
                        continue;

                ?>
                    <?= Html::tag('div', $arSection['NAME'], [
                        'class' => Html::cssClassFromArray([
                            'catalog-element-sections-tab' => true,
                            'intec-cl-background' => $bFirst,
                            'intec-cl-background-light-hover' => $bFirst
                        ], true),
                        'data' => [
                            'role' => 'section.tabs.item',
                            'id' => $arSection['ID'],
                            'active' => $bFirst ? 'true' : 'false'
                        ]
                    ]) ?>
                    <?php if ($bFirst) $bFirst = false ?>
                <?php } ?>
            </div>
        <?= Html::endTag('div') ?>
        <div class="catalog-element-sections-content" data-role="section.content">
            <?php $bFirst = true ?>
            <?php foreach ($arSections as $arSection) {

                if (!$arSection['SHOW'])
                    continue;

            ?>
                <?= Html::beginTag('div', [
                    'class' => 'catalog-element-sections-content-item',
                    'data' => [
                        'role' => 'section.content.item',
                        'id' => $arSection['ID'],
                        'active' => $bFirst ? 'true' : 'false'
                    ]
                ]) ?>
                    <?php if ($arSection['TYPE'] === 'print') { ?>
                        <div class="catalog-element-sections-content-text">
                            <?= $arSection['VALUE'] ?>
                        </div>
                    <?php } else if ($arSection['TYPE'] === 'file')
                        include($arSection['VALUE']);
                    ?>
                <?= Html::endTag('div') ?>
                <?php if ($bFirst) $bFirst = false ?>
            <?php } ?>
        </div>
    </div>
</div>