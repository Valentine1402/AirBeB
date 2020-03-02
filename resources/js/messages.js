const axios = require('axios');

const messages = document.querySelectorAll('.message-preview');
messages.forEach(function(message){
  let read = message.querySelector('.read');
  let toRead = message.querySelector('.toRead');

  read.addEventListener('click', function(){
    if(message.classList.contains('read')){

    }
  })

  toRead.addEventListener('click', function(){
    if(message.classList.contains('read')){
      
    }
  })

})


function setMessage(message){
  const _this = this;
    axios.get('/api/set-message-status', {
            params: {
              message: message
            }
        })
        .then(function(response) {
            console.log(response);
        })
        .catch(function(error) {
            console.log(error);
        })



}
