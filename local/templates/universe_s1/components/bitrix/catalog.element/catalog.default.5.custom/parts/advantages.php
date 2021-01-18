<?php if (!defined('B_PROLOG_INCLUDED') && B_PROLOG_INCLUDED !== true) die();

use intec\core\helpers\Html;

/**
 * @var array $arResult
 * @var array $arVisual
 */


?>
<?if(!empty($arResult['ADVANTAGES'])):?>
<div style="margin-top: 50px;">
	<div class="widget c-advantages c-advantages-template-30" data-theme="light" data-title-position="top" data-name-align="center" data-picture-align="center" data-picture-position="top" data-preview-align="center" style="background: #F8F9FB">
		<div class="intec-content intec-content-visible">
			<div class="intec-content-wrapper">
			<div class="widget-wrapper">
				<div class="widget-content">
					<div class="widget-items-wrap intec-content intec-content-visible">
						<div class="widget-items-wrap-2 intec-content-wrapper">
							<div class="widget-items intec-grid intec-grid-wrap intec-grid-a-h-center">
		
		
		<?foreach($arResult['ADVANTAGES'] as $advantage):?>
		<div class="widget-item intec-grid-item-5 intec-grid-item-370-1 intec-grid-item-768-2 intec-grid-item-900-3 intec-grid-item-1000-4" data-picture-show="true">
			<div class="widget-item-wrapper">
			<div class="widget-item-picture intec-cl-svg intec-image-effect">
				<img src="<?=$advantage["PROPERTY_ICON_SRC"]?>">
			</div>
			<div class="widget-item-name"><?=$advantage["NAME"]?></div>
			<div class="widget-item-description"><?=$advantage["PREVIEW_TEXT"]?></div>
			</div>
		</div>
		<?endforeach?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?endif?>