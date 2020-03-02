const $ = require('jquery');

$(document).ready(init);

function init() {
    $('.btn').on('click', function() {

        return validation();
    })
}

function validation() {
    var isValid = true;

    $('input[data-required]').each(function() {

        if ($(this).val() == '') {
            isValid = false;
            $(this).closest('.form_row').next().removeClass('hidden');
        }
    });

    if ($('#lon').val() == 0 || $('#lat').val() == 0) {
        isValid = false;
        $('.alert-danger.address').removeClass('hidden');
    }
    console.log(isValid);
    if (!isValid) {
        return false;
    }

}
