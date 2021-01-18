<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use intec\Core;

global $APPLICATION;

if (!Loader::includeModule('intec.core'))
    return;

if (Loader::includeModule('currency'))
    CJSCore::Init(['currency']);

if (!empty($arResult['DETAIL_PICTURE']))
    $sPicture = $arResult['DETAIL_PICTURE']['SRC'];

if (empty($sPicture) && !empty($arResult['PREVIEW_PICTURE']))
    $sPicture = $arResult['PREVIEW_PICTURE']['SRC'];

if (!empty($sPicture))
    $APPLICATION->SetPageProperty('og:image', Core::$app->request->getHostInfo().$sPicture);

if (!empty($arResult['OG_TITLE']))
    $APPLICATION->SetPageProperty('og:title', $arResult['OG_TITLE']);

if (!empty($arResult['OG_DESCRIPTION']))
    $APPLICATION->SetPageProperty('og:description', $arResult['OG_DESCRIPTION']);

if (!empty($arResult['OG_URL']))
    $APPLICATION->SetPageProperty('og:url', $arResult['OG_URL']);