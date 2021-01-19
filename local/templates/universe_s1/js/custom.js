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


