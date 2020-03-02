const $ = require('jquery');

$(document).ready(init);

function init() {
    $('.close').click(function() {
        console.log('click');
        $('.session').addClass('closed');
    })
}
