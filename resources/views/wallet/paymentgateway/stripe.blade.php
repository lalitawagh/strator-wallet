<form role="form" action="{{ route('dashboard.ledger-foundation.wallet.store-deposit-payment-stripe') }}" method="post" class="require-validation" data-token-on-file="false"
    data-stripe-publishable-key="{{ config('services.stripe.stripe_key') }}" id="payment-form">
    @csrf
    @php $total = $details['fee'] + $details['amount']; @endphp
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Total Amount</label>
        <div class="sm:w-5/6">
            <div class="font-medium text-base">{{ \Cknow\Money\Money::parseByIntlLocalizedDecimal($total, $details['currency']); }}</div>
        </div>
    </div>
    <input type="hidden" name="amount" id="amount" value="{{ $total }}">
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Cardholder</label>
        <div class="sm:w-5/6">
            <input id="name_on_card" type="text" name="name" class="form-control"
                placeholder="Jack">
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 card required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Card Number</label>
        <div class="sm:w-5/6">
            <div id="card-element"></div>
            {{-- <input id="horizontal-form-3" name="card-number" type="text" class="form-control card-number"
                placeholder="3546879542685421"> --}}
        </div>

    </div>
     <div id="card-errors" role="alert"></div>
    {{-- <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 card required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Card Number</label>
        <div class="sm:w-5/6">
            <input id="horizontal-form-3" name="card-number" type="text" class="form-control card-number"
                placeholder="3546879542685421">
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 expiration required">
        <label for="horizontal-form-2" class="form-label sm:w-24">Expiry Month</label>
        <div class="sm:w-5/6">
            <input id="horizontal-form-2" type="text" class="form-control card-expiry-month"
                placeholder="11">
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 expiration required">
        <label for="horizontal-form-2" class="form-label sm:w-24">Expiry Year</label>
        <div class="sm:w-5/6">
            <input id="horizontal-form-2" type="text" class="form-control card-expiry-year"
                placeholder="2202">
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 cvc required">
        <label for="horizontal-form-2" class="form-label sm:w-24">CVV</label>
        <div class="sm:w-5/6">
            <input id="horizontal-form-2" name="cvv" type="text" class="form-control card-cvc"
                placeholder="135">
        </div>
    </div>
    <div class='col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required'>
        <label for="horizontal-form-2" class="form-label sm:w-24"></label>
        <div class='col-md-12 error form-group hidden'>
            <div class='alert-danger error-msg' style="border-radius: 0.375rem;padding: 1rem 1.25rem;position: relative;">
                Please correct the errors and try
                again.</div>
        </div>
    </div> --}}

    <div class="text-right mt-5 form-inline text-right mt-5 float-right">
        <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Preview</a>
        <button type="submit" class="btn btn-primary w-24">Submit</button>
    </div>
</form>

{{-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}
<script src="https://js.stripe.com/v3/"></script>
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
                $errorMessage.addClass('hidden');

                $('.border-theme-6').removeClass('border-theme-6');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {

                        $input.addClass('border-theme-6');
                        $errorMessage.removeClass('hidden');
                        e.preventDefault();
                    }
                });

                if (!$form.data('token-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hidden')
                        .find('.error-msg')
                        .text(response.error.message);
                    $('.error').find('.error-msg').html(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
    {{-- <script>
        (function(){
            // Create a Stripe client
            var stripe = Stripe('pk_test_51BTUDGJAJfZb9HEBwDg86TN1KNprHjkfipXmEDMb0gSCassK5T3ZfxsAbcgKVmAIXF7oZ6ItlZZbXO6idTHE67IM007EwQ4uN3');
            // Create an instance of Elements
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
              base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Raleway", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
              },
              invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
              }
            };
            // Create an instance of the card Element
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });
            // Add an instance of the card Element into the `card-element` <div>
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });
            // Handle form submission
            var form = document.getElementById('payment-form');
            var $form = $(".require-validation");
            form.addEventListener('submit', function(event) {
            //   event.preventDefault();
            //   var options = {
            //     name: document.getElementById('name_on_card').value,
            //   }
            //   stripe.createToken(card).then(function(result) {
            //     if (result.error) {
            //       // Inform the user if there was an error
            //       var errorElement = document.getElementById('card-errors');
            //       errorElement.textContent = result.error.message;
            //     } else {
            //       // Send the token to your server
            //       stripeTokenHandler(result.token);
            //     }
            //   });if (!$form.data('token-on-file')) {
                event.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken(card, stripeResponseHandler);

            });
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hidden')
                        .find('.error-msg')
                        .text(response.error.message);
                    $('.error').find('.error-msg').html(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
            // function stripeTokenHandler(token) {
            //   // Insert the token ID into the form so it gets submitted to the server
            //   var form = document.getElementById('payment-form');
            //   var hiddenInput = document.createElement('input');
            //   hiddenInput.setAttribute('type', 'hidden');
            //   hiddenInput.setAttribute('name', 'stripeToken');
            //   hiddenInput.setAttribute('value', token.id);
            //   form.appendChild(hiddenInput);
            //   // Submit the form
            //   form.submit();
            // }
        })();
    </script> --}}
@endpush
