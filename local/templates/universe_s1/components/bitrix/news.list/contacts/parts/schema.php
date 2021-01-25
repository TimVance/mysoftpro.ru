<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var array $arVisual
 * @var string $sTemplateId
 */

if (empty($arResult['CONTACT']))
    return;

?>
<div itemscope itemtype="http://schema.org/LocalBusiness" style="display:none;">
	

	<?php if (!empty($arResult['CONTACT']['PREVIEW_PICTURE']['SRC'])) { ?>
		<img itemprop="image" src="<?=$arResult['CONTACT']['PREVIEW_PICTURE']['SRC']?>">
	<?php } ?>
	
    <?php if (!empty($arResult['CONTACT']['NAME'])) { ?>
        <span itemprop="name">
            <?= $arResult['CONTACT']['NAME'] ?>
        </span>
    <?php } ?>
	
    <?php if (!empty($arResult['CONTACT']['DATA']['ADDRESS'])) { ?>
        <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="streetAddress">
                <?= $arResult['CONTACT']['DATA']['ADDRESS'] ?>
            </span>
        </div>
    <?php } ?>
	
    <?php if (!empty($arResult['CONTACT']['DATA']['PHONES'])) { ?>
		<?php foreach ($arResult['CONTACT']['DATA']['PHONES'] as $arValue) { ?>
			<span itemprop="telephone"><?= $arValue['DISPLAY'] ?></span>
		<?php } ?>
    <?php } ?>
	
	<?php if (!empty($arResult['CONTACT']['DATA']['EMAIL'])) { ?>
		<?php foreach ($arResult['CONTACT']['DATA']['EMAIL'] as $arValue) { ?>
			<span itemprop="email"><?= $arValue ?></span>
		<?php } ?>
	<?php } ?>
	
    <?php if (!empty($arResult['CONTACT']['DATA']['OPENING_HOURS'])) { ?>
        <time itemprop="openingHours" datetime="<?= $arResult['CONTACT']['DATA']['OPENING_HOURS'] ?>"></time>
    <?php } ?>
</div>