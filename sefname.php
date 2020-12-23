<?php
if(empty($_SERVER["DOCUMENT_ROOT"])) $_SERVER["DOCUMENT_ROOT"] = '/home/i/infomy8d/infomy8d.beget.tech/public_html';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$bs = new CIBlockSection;
$el = new CIBlockElement;
$obProduct = new CCatalogProduct();

$ibCatalog = 13;

$arFilter = [
	'IBLOCK_ID' => $ibCatalog,
];

$rsSect = $bs->GetList(["SORT"=>"­­ASC"], $arFilter);
while($arSect = $rsSect->GetNext())
{
	$arSection[$arSect["SECTION_PAGE_URL"]] = $arSect["ID"];
	
	// Антивирус / Лаборатория Касперского / Для бизнеса / Anti-Spam / Для Linux
	$strDir = '';
	$list = CIBlockSection::GetNavChain(false, $arSect["ID"], array("NAME"), true);
	foreach($list as $arSectionPath)
	{
		$strDir .= $arSectionPath['NAME'].' / ';
	}
	$arStrSection[rtrim($strDir, " / ")] = $arSect["ID"];
}

$params = [];

$arFilter = [
	'IBLOCK_ID' => $ibCatalog,
];

$rsElement = $el->GetList(["SORT" => "­­ASC"], $arFilter, false, ["nTopCount" => 5000], [
	"ID", "NAME", "PROPERTY_MEDIA_TYPE", "PROPERTY_BRAND", "DETAIL_PAGE_URL"
]);

echo "<table>";

echo "<tr><th>URL</th></tr>";

while($arElement = $rsElement->GetNext())
{
// 	echo "<pre>".print_r($arElement, 1)."</pre>";die;
	echo "<tr><td><a href='http://mysoftpro.ru/bitrix/admin/cat_product_edit.php?IBLOCK_ID=13&type=catalogs&lang=ru&ID=".$arElement['ID']."&find_section_section=-1&WF=Y' target='_blank'>".$arElement['DETAIL_PAGE_URL']."</a></td></tr>";
}

die("</table>");