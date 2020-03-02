const $ = require('jquery');

var form = document.querySelector('#my-sample-form');
var submit = document.querySelector('input[type="submit"]');

var rows = document.querySelectorAll('.form_row.sponsor');

var radioChecks = document.querySelectorAll('.form_row.sponsor input[type="radio"]');

for (let i = 0; i < radioChecks.length; i++) {
    radioChecks[i].addEventListener('change', function() {
        for (let item of rows)
            if (item.classList.contains('checked'))
                item.classList.remove('checked');

        rows[i].classList.add('checked');
    })
}

$.ajax({
    headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/api/braintree-token",
    method: "GET",
    success: function(data) {

        braintree.client.create({
            authorization: data,
        }, function(clientErr, clientInstance) {
            if (clientErr) {
                console.error(clientErr);
                return;
            }

            // This example shows Hosted Fields, but you can also use this
            // client instance to create additional components here, such as
            // PayPal or Data Collector.

            braintree.hostedFields.create({
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '14px'
                    },
                    'input.invalid': {
                        'color': 'red'
                    },
                    'input.valid': {
                        'color': 'green'
                    }
                },
                fields: {
                    number: {
                        selector: '#card-number',
                        // placeholder: '4111 1111 1111 1111'
                    },
                    cvv: {
                        selector: '#cvv',
                        // placeholder: '123'
                    },
                    expirationDate: {
                        selector: '#expiration-date',
                        // placeholder: '10/2019'
                    }
                }
            }, function(hostedFieldsErr, hostedFieldsInstance) {
                if (hostedFieldsErr) {
                    console.error(hostedFieldsErr);
                    return;
                }

                submit.removeAttribute('disabled');

                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    hostedFieldsInstance.tokenize(function(tokenizeErr, payload) {
                        if (tokenizeErr) {
                            console.error(tokenizeErr);
                            return;
                        }

                        // If this was a real integration, this is where you would
                        // send the nonce to your server.
                        //console.log('Got a nonce: ' + payload.nonce);

                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                    });
                }, false);
            });
        });
    }
});
