<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die() ?>
<?php
/**
 * @var array $aMenuLinks
 */

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"intec.universe:menu.sections", 
	"", 
	array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_ID#",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "40",
		"DEPTH_LEVEL" => "4",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
