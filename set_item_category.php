<?php
	
if(empty($_SERVER["DOCUMENT_ROOT"])) $_SERVER["DOCUMENT_ROOT"] = '/home/i/infomy8d/infomy8d.beget.tech/public_html';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$bs = new CIBlockSection;
$el = new CIBlockElement;

$ibCatalog = 13;

$arFilter = [
	'IBLOCK_ID' => $ibCatalog,
	'>=TIMESTAMP_X' => '2020-10-07 00:00:00',
];

$rsElement = $el->GetList(["SORT"=>"­­ASC"], $arFilter);

while($arElement = $rsElement->GetNext())
{
	$arSectionSort = [];
	
	$dbGroups = CIBlockElement::GetElementGroups($arElement['ID'], true);
	
	while($arGroup = $dbGroups->GetNext())
	{
		$arSectionSort[$arGroup["ID"]] = $arGroup["DEPTH_LEVEL"];
	}
	
	asort($arSectionSort);
	$last = array_slice($arSectionSort, -1, 1, true);
	
	$el->Update($arElement['ID'], ['IBLOCK_SECTION_ID' => key($last)]);
}