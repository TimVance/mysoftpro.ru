<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/**
 * @global $APPLICATION
 */

$APPLICATION->SetTitle("Интернет-магазин лицензионного софта в Москве - Mysoftpro");


$APPLICATION->SetPageProperty("description", "Вы попали на главную страницу интернет-магазина по продаже лицензионного софта. Оставляйте заявку через сайт на нужный вам софт или звоните по телефону +7 (495) 775-77-13.");
$APPLICATION->SetPageProperty('canonical', 'https://'.SITE_SERVER_NAME);

$APPLICATION->SetPageProperty('og:image', '');
$APPLICATION->SetPageProperty('og:title', 'Интернет-магазин лицензионного софта в Москве - Mysoftpro');
$APPLICATION->SetPageProperty('og:description', 'Описание. Интернет-магазин лицензионного софта в Москве - Mysoftpro');
$APPLICATION->SetPageProperty('og:site_name', 'MySoftPro');

?>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php") ?>
