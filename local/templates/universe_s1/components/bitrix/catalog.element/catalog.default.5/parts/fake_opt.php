<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\Html;

/**
 * @var array $arResult
 * @var array $arVisual
 */

?>

<div class="catalog-element-purchase-block catalog-element-price-range-container">
<div class="catalog-element-price-range">
	
<?foreach($arResult['FAKE_OPT'] as $arItem):?>
    <div class="catalog-element-price-range-item">
        <div class="intec-grid intec-grid-a-v-end intec-grid-i-2 intec-grid-350-wrap">
            <div class="intec-grid-item-auto intec-grid-item-350-1">
                <div class="catalog-element-price-range-item-quantity">
                    <span><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span>
                </div>
            </div>
            <div class="catalog-element-price-range-item-delimiter-container intec-grid-item">
                <div class="catalog-element-price-range-item-delimiter"></div>
            </div>
            <div class="intec-grid-item-auto intec-grid-item-350-1">
                <div class="catalog-element-price-range-item-price">
                    <span><?=$arItem["CATALOG_PRICE_1"]?> руб.</span>
                </div>
            </div>
        </div>
    </div>
<?endforeach?>


</div>
</div>