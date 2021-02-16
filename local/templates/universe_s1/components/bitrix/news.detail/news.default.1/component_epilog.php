<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use intec\Core;

if (!empty($arResult['DETAIL_PICTURE']))
    $sPicture = $arResult['DETAIL_PICTURE']['SRC'];

if (empty($sPicture) && !empty($arResult['PREVIEW_PICTURE']))
    $sPicture = $arResult['PREVIEW_PICTURE']['SRC'];

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
elseif (!empty($sPicture))
{
    $APPLICATION->SetPageProperty('og:image', Core::$app->request->getHostInfo().$sPicture);
}

if(!empty($arResult["OG"]["SITE_NAME"]))
{
	$APPLICATION->SetPageProperty("og:site_name", $arResult["OG"]["SITE_NAME"]);
}
