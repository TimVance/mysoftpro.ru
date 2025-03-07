<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die() ?>
<?php

use Bitrix\Main\Context;
use Bitrix\Main\Loader;

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

global $APPLICATION;

if (Loader::includeModule('currency'))
    CJSCore::Init(['currency']);

//	lazy load and big data json answers
$request = Context::getCurrent()->getRequest();

if ($request->isAjaxRequest() && ($request->get('action') === 'showMore' || $request->get('action') === 'deferredLoad')) {
    $content = ob_get_contents();

    ob_end_clean();

    list(, $itemsContainer) = explode('<!-- items-container -->', $content);
    list(, $paginationContainer) = explode('<!-- pagination-container -->', $content);

    if ($arParams['AJAX_MODE'] === 'Y')
        $component->prepareLinks($paginationContainer);

    $component::sendJsonAnswer([
        'items' => $itemsContainer,
        'pagination' => $paginationContainer
    ]);
}

if(!empty($arResult["OG"]["TITLE"]))
{
	$APPLICATION->SetPageProperty('og:title', $arResult["OG"]["TITLE"]);
}

if(!empty($arResult["OG"]["DESCRIPTION"]))
{
	$APPLICATION->SetPageProperty("og:description", $arResult["OG"]["DESCRIPTION"]);
}

if(!empty($arResult["OG"]["IMAGE"]))
{
	$APPLICATION->SetPageProperty("og:image", $arResult["OG"]["IMAGE"]);
}

if(!empty($arResult["OG"]["SITE_NAME"]))
{
	$APPLICATION->SetPageProperty("og:site_name", $arResult["OG"]["SITE_NAME"]);
}