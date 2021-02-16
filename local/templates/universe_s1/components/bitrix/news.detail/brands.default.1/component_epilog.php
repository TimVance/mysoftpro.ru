<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

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