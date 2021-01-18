<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use intec\core\helpers\FileHelper;

global $APPLICATION;
global $USER;
global $directory;
global $properties;
global $template;
global $part;

if (empty($template))
    return;

?>
        <?php include($directory.'/parts/'.$part.'/footer.php'); ?>
        <?php if (FileHelper::isFile($directory.'/parts/custom/body.end.php')) include($directory.'/parts/custom/body.end.php') ?>
        <?php $APPLICATION->IncludeFile('/include/body_end_counter.php'); ?>

        <div class="overflow"></div>
        <div class="form-order-section">
            <div class="popup-window-titlebar"><span class="access-title-bar-order">Заказать товар</span></div>
            <div class="close"></div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:form",
                ".default",
                Array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_TIME" => "3600",
                    "CACHE_TYPE" => "A",
                    "CHAIN_ITEM_LINK" => "",
                    "CHAIN_ITEM_TEXT" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "EDIT_ADDITIONAL" => "N",
                    "EDIT_STATUS" => "Y",
                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                    "NOT_SHOW_FILTER" => array(0=>"",1=>"",),
                    "NOT_SHOW_TABLE" => array(0=>"",1=>"",),
                    "RESULT_ID" => $_REQUEST[RESULT_ID],
                    "SEF_MODE" => "N",
                    "SHOW_ADDITIONAL" => "N",
                    "SHOW_ANSWER_VALUE" => "N",
                    "SHOW_EDIT_PAGE" => "Y",
                    "SHOW_LIST_PAGE" => "Y",
                    "SHOW_STATUS" => "Y",
                    "SHOW_VIEW_PAGE" => "Y",
                    "START_PAGE" => "new",
                    "SUCCESS_URL" => "",
                    "USE_EXTENDED_ERRORS" => "Y",
                    "VARIABLE_ALIASES" => array("action"=>"action",),
                    "WEB_FORM_ID" => "3"
                )
            );?>
        </div>
        <script>
            $(function (){
                $(".catalog-section-item-purchase-button").click(function () {
                    let name = $(this).closest('.catalog-section-items').find('.catalog-section-item-name').text();
                    $(".form-order-section, .overflow").fadeIn();
                    $(".form-order-section input[name='form_text_7']").val(name);
                });
                $(".form-order-section .close, .overflow").click(function () {
                    $(".form-order-section, .overflow").fadeOut();
                });
            });
        </script>
        <style>
            .form-order-section {
                display: none;
                padding: 25px 35px 30px;
                min-width: 320px;
                background-color: #fff;
                position: fixed;
                z-index: 1111;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%,-50%);
                -moz-transform: translate(-50%,-50%);
                -ms-transform: translate(-50%,-50%);
                -o-transform: translate(-50%,-50%);
                transform: translate(-50%,-50%);
                max-width: 450px;
                width: 90%;
            }
            .overflow {
                display: none;
                background: #333;
                opacity: .5;
                cursor: pointer;
                width: 100%;
                height: 100%;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 1000;
            }
            .access-title-bar-order {
                font-size: 24px;
                font-weight: bold;
            }
            .form-order-section .close {
                position: relative;
                top: -30px;
            }
            .form-order-section .close:after {
                display: block;
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-transform: translate3d(-50%, -50%, 0);
                transform: translate3d(-50%, -50%, 0);
                width: 20px;
                height: 20px;
                background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTcuNzg3IDFMNSAzLjc4NyAyLjIxMyAxIDEgMi4yMTMgMy43ODcgNSAxIDcuNzg3IDIuMjEzIDkgNSA2LjIxMyA3Ljc4NyA5IDkgNy43ODcgNi4yMTMgNSA5IDIuMjEzIiBmaWxsPSIjOTk5IiBmaWxsLXJ1bGU9ImV2ZW5vZGQiLz48L3N2Zz4=);
                background-repeat: no-repeat;
                background-size: cover;
                content: "";
            }
        </style>
		        
		<link rel="stylesheet" href="/local/templates/universe_s1/css/custom.css">
    </body>
</html>
<?php if (FileHelper::isFile($directory.'/parts/custom/end.php')) include($directory.'/parts/custom/end.php') ?>