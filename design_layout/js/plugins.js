//Input default text

$.fn.hint = function (focusClass) {
    $(this).each(function () {
        var input = $(this);
        var str = input.val();
        input.focusin(function () {
            if ($.trim(input.val()) == str) {
                input.val("").addClass(focusClass);
            }
        });
        input.focusout(function () {
            if ($.trim(input.val()) == "") {
                input.removeClass(focusClass).val(str);
            }
        });
    });
}
