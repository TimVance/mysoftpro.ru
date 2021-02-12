(function ($, api) {
	
    $(document).on('ready', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
	
})(jQuery, intec);

$(function () {

    function changeCart() {
        setTimeout(function () {$(".bx-soa-pp-company-checkbox").click()}, 1000);
    }

    $(document).on('click', ".intec-ui-part-increment, .intec-ui-part-decrement, .basket-item-action", changeCart);
    $(document).on('change', '.intec-ui-part-input', changeCart);
});


$(function () {
    let cnt_show_elements = 11;
    let els = $(".catalog-content-left .catalog-menu .menu-wrapper .menu-item:hidden");
    if (els.length) {
        $(".catalog-content-left .catalog-menu .menu-wrapper").append('<span class="show_all_menu_elem">Посмотреть все</span>');
    }

    $(".show_all_menu_elem").click(function () {
        $(this).remove();
        els.slideDown();
    });
});