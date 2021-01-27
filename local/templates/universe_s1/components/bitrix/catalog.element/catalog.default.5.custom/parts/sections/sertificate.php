<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\FileHelper;
use intec\core\helpers\Html;

/**
 * @var array $arVisual
 * @var array $arFields
 */

?>

<div class="catalog-element-documents-item-container">
    <div class="intec-grid intec-grid-wrap intec-grid-a-v-stretch">
        <?php foreach ($arResult["PROPERTIES"]["CERTIFICATES"]["VALUE"] as $arCertificate) { ?>
            <? $arrCertificate = CFile::GetPath($arCertificate); ?>
            <? print_r($arrCertificate); ?>
            <?= Html::beginTag('div', [
                'class' => Html::cssClassFromArray([
                    'catalog-element-documents-item' => true,
                    'intec-grid-item' => [
                        $arVisual['CERTIFICATES']['COLUMNS'] => true,
                        '1200-3' => $arVisual['CERTIFICATES']['COLUMNS'] >= 4,
                        '768-2' => true,
                        '500-1' => true
                    ]
                ], true)
            ]) ?>
                <?= Html::beginTag('a', [
                    'class' => 'catalog-element-documents-item-content',
                    'href' => $arrCertificate['SRC'],
                    'target' => '_blank'
                ]) ?>
                    <div class="catalog-element-documents-item-name">
                        <?= FileHelper::getFileNameWithoutExtension($arrCertificate['ORIGINAL_NAME']) ?>
                    </div>
                    <div class="catalog-element-documents-item-size">
                        <?= CFile::FormatSize($arrCertificate['FILE_SIZE']) ?>
                    </div>
                    <div class="catalog-element-documents-item-extension">
                        <?= FileHelper::getFileExtension($arrCertificate['FILE_NAME']) ?>
                    </div>
                <?= Html::endTag('a') ?>
            <?= Html::endTag('div') ?>
        <?php } ?>
    </div>
</div>
<?php unset($arCertificate) ?>