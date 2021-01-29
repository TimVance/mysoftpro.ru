<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\FileHelper;
use intec\core\helpers\Html;

/**
 * @var array $arVisual
 * @var array $arFields
 */

?>

<div class="catalog-element-documents-item-container">
    <div class="intec-grid intec-grid-wrap intec-grid-a-v-stretch sertificates-list">
        <?php foreach ($arResult["PROPERTIES"]["CERTIFICATE_IMG"]["VALUE"] as $arCertificate) { ?>
            <? $arrCertificate = CFile::GetFileArray($arCertificate); ?>
            <?= Html::beginTag('div', [
                'style' => 'margin: 10px',
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
                    'target' => '_blank',
                    'data-src' => $arrCertificate['SRC'],
                    'data-preview-src' => $arrCertificate['SRC'],
                    'style' => 'background-size: contain; height: 320px; background-image: url("'.$arrCertificate['SRC'].'")'
                ]) ?>
                <?= Html::endTag('a') ?>
            <?= Html::endTag('div') ?>
        <?php } ?>
    </div>
</div>
<?php unset($arCertificate) ?>
<?php if (!empty($arResult["PROPERTIES"]["CERTIFICATE_IMG"]["VALUE"])): ?>
    <script>
        $(document).ready(function () {
            $('.sertificates-list').lightGallery({
                selector: '.catalog-element-documents-item-content',
                exThumbImage: 'data-preview-src',
                autoplay: false,
                share: false
            });
        });
    </script>
<?php endif; ?>
