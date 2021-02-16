<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Localization\Loc;
use intec\core\helpers\Html;
use intec\core\helpers\JavaScript;
use intec\core\bitrix\Component;
use intec\core\helpers\ArrayHelper;
use intec\Core;

/**
 * @var CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arResult
 * @var array $arParams
 */

$this->setFrameMode(true);
$sTemplateId = Html::getUniqueId(null, Component::getUniqueId($this));

$arVisual = $arResult['VISUAL'];
$arLazyLoad = $arResult['LAZYLOAD'];

if ($arVisual['PRODUCTS']['SHOW']) {
    include(__DIR__.'/parts/products.php');
    include(__DIR__.'/parts/filter.php');
}

if ($arVisual['SECTIONS']['SHOW'])
    include(__DIR__.'/parts/sections.php');

$oRequest = Core::$app->request;
$bIsAjax = false;

if ($oRequest->getIsAjax()) {
    $bIsAjax = $oRequest->get('brands');
    $bIsAjax = ArrayHelper::getValue($bIsAjax, 'ajax') === 'Y';
}

$sPicture = null;

if (!empty($arResult['DETAIL_PICTURE'])) {
    $sPicture = $arResult['DETAIL_PICTURE'];
} else if (!empty($arResult['PREVIEW_PICTURE'])) {
    $sPicture = $arResult['PREVIEW_PICTURE'];
}

$sPicture = CFile::ResizeImageGet($sPicture, array(
    'width' => 400,
    'height' => 200
), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);

if (!empty($sPicture)) {
    $sPicture = $sPicture['src'];
} else {
    $sPicture = SITE_TEMPLATE_PATH.'/images/picture.missing.png';
}

?>

<?php if ($arFilter['SHOW'] && $arFilter['TYPE'] === 'vertical') { ?>
    <?php $this->SetViewTarget('news_detail_brands_filter') ?>
        <div class="news-filter filter-vertical">
            <!--noindex-->
            <?php $APPLICATION->IncludeComponent(
                'bitrix:catalog.smart.filter',
                $arFilter['TEMPLATE'],
                $arFilter['PARAMETERS'],
                $component
            ) ?>
            <!--/noindex-->
        </div>
    <?php $this->EndViewTarget(); ?>
<?php } ?>

<?= Html::beginTag('div', [
    'id' => $sTemplateId,
    'class' => [
        'ns-bitrix',
        'c-news-detail',
        'c-news-detail-brands-detail-1'
    ]
]) ?>
    <div class="news-detail-information intec-grid intec-grid-a-v-start">
        <?php if (!empty($arResult['PREVIEW_TEXT'])) { ?>
            <div class="news-detail-preview-text intec-grid-item">
                <?= $arResult['PREVIEW_TEXT'] ?>
            </div>
        <?php } ?>
        <div class="news-detail-image intec-grid-item-5">
            <div class="news-detail-image-wrapper intec-image">
                <div class="news-detail-image-wrapper-2">
                    <div class="intec-aligner"></div>
                    <?= Html::img($arLazyLoad['USE'] ? $arLazyLoad['STUB'] : $sPicture, [
                        'alt' => $arResult['NAME'],
                        'title' => $arResult['NAME'],
                        'loading' => 'lazy',
                        'data' => [
                            'lazyload-use' => $arLazyLoad['USE'] ? 'true' : 'false',
                            'original' => $arLazyLoad['USE'] ? $sPicture : null
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($arResult['DETAIL_TEXT'])) { ?>
        <div class="news-detail-description">
            <?= $arResult['DETAIL_TEXT'] ?>
        </div>
    <?php } ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "certificates",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "DESKTOP_TEMPLATE" => "settings",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("",""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "28",
            "IBLOCK_TYPE" => "content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
            "INCLUDE_SUBSECTIONS" => "Y",
            "LAZYLOAD_USE" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("",""),
            "SETTINGS_USE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    );?>
    <?php if ($arVisual['SECTIONS']['SHOW']) { ?>
        <div class="news-detail-sections">
            <?php if ($arVisual['SECTIONS']['HEADER']['SHOW']) { ?>
                <div class="news-detail-sections-header">
                    <?= $arVisual['SECTIONS']['HEADER']['VALUE'] ?>
                </div>
            <?php } ?>
            <?php $APPLICATION->IncludeComponent(
                'bitrix:catalog.section.list',
                $arSections['TEMPLATE'],
                $arSections['PARAMETERS'],
                $component
            ) ?>
        </div>
    <?php } ?>
    <?php if ($arVisual['PRODUCTS']['SHOW']) { ?>
        <?php if ($arFilter['SHOW'] && $arFilter['TYPE'] === 'horizontal') { ?>
            <div class="news-detail-filter filter-horizontal">
                <!--noindex-->
                <?php $APPLICATION->IncludeComponent(
                    'bitrix:catalog.smart.filter',
                    $arFilter['TEMPLATE'],
                    $arFilter['PARAMETERS'],
                    $component
                ) ?>
                <!--/noindex-->
            </div>
        <?php } ?>
        <div class="news-detail-products" data-role="content">
            <?php if ($arVisual['PRODUCTS']['HEADER']['SHOW']) { ?>
                <div class="news-detail-products-header">
                    <?= $arVisual['PRODUCTS']['HEADER']['VALUE'] ?>
                </div>
            <?php } ?>
            <?php if ($bIsAjax) $APPLICATION->RestartBuffer() ?>
            <?php $APPLICATION->IncludeComponent(
                'bitrix:catalog.section',
                $arProducts['TEMPLATE'],
                $arProducts['PARAMETERS'],
                $component
            ) ?>
            <?php if ($bIsAjax) exit() ?>
        </div>
    <?php } ?>
    <?php if ($arVisual['LINK']['SHOW']) { ?>
        <div class="news-detail-return">
            <a class="news-detail-return-wrapper intec-cl-text-hover" href="<?= $arResult['LIST_PAGE_URL'] ?>">
                <i class="far fa-chevron-left"></i>
                <?= $arVisual['LINK']['VALUE'] ?>
            </a>
        </div>
    <?php } ?>
<?php if ($arFilter['SHOW'] && $arFilter['AJAX']) { ?>
    <script type="text/javascript">
        (function () {
            var root = $(<?= JavaScript::toObject('#'.$sTemplateId) ?>);
            var filter = $('[data-role="filter"]', root);
            var content = $('[data-role="content"]', root);

            filter.state = false;
            filter.button = $('[data-role="filter.button"]', root);
            filter.button.on('click', function () {
                if (filter.state) {
                    filter.hide();
                } else {
                    filter.show();
                }

                filter.state = !filter.state;
            });

            content.refresh = function (url) {
                if (url == null)
                    url = null;

                $.ajax({
                    'url': url,
                    'data': {
                        'brands': {
                            'ajax': 'Y'
                        }
                    },
                    'cache': false,
                    'success': function (response) {
                        content.html(response);
                        universe.basket.update();
                    }
                });
            };

            if (smartFilter && smartFilter.on)
                smartFilter.on('refresh', function (event, url) {
                    if (window.history.enabled || window.history.pushState != null) {
                        window.history.pushState(null, document.title, url);
                    } else {
                        window.location.href = url;
                    }

                    content.refresh(url);
                });
        })();
    </script>
<?php } ?>
<?= Html::endTag('div') ?>
