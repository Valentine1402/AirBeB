const $ = require('jquery');


$(document).ready(init);

function init() {
  $('.toggle-dropdown').click(function (){
    $('.toggle-dropdown').toggleClass('hide');
    $('.dropdown-content').toggleClass('hide');
  });
}
