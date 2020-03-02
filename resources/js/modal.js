const $ = require('jquery');


$(document).ready(init);

function init() {
    let path = window.location.pathname;
    console.log(path);
    if (path !== '/login' && path !== '/register') {
        console.log('script attivo');
        $('#register').click(function() {
            $('.modal-register').addClass('open');
            $('body').css('overflow-y', 'hidden');
        });

        $('#login').click(function() {
            $('.modal-login').addClass('open');
            $('body').css('overflow-y', 'hidden');
        });

        $('#not-registered').click(function(){
          $('.modal-login').removeClass('open');
          $('.modal-register').addClass('open');
        })

        $('.modal-login-close').click(function() {
            $('.modal-login').removeClass('open');
            $('body').css('overflow-y', 'auto');
        });

        $('.modal-register-close').click(function() {
            $('.modal-register').removeClass('open');
            $('body').css('overflow-y', 'auto');
        });
    }

    if($('.delete-modal').length){
      console.log('ok');
      $('#delete-btn').click(function(){
        $('.delete-modal').addClass('open');
        $('body').css('overflow-y', 'hidden');
      });

      $('#annulla-delete').click(function(){
        $('.delete-modal').removeClass('open');
        $('body').css('overflow-y', 'auto');
      });
    }
}
