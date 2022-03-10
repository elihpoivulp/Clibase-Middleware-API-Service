$(document).ready(function () {
    $('#currency_selection').dropdown({
        onChange: function(text) {
            $('input[name="currency"]').val(text.toLowerCase());
        }
    });
});