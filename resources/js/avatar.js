const $ = require('jquery');


$(document).ready(init);

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

function init() {

      $("#imgInp").change(function(){
          readURL(this);
      });
}
