<form role="form" action="" method="" class="require-validation" data-token-on-file="false"
    data-stripe-publishable-key="{{ config('services.stripe.stripe_key') }}" id="payment-form">
    @csrf
    @php
        $subtotal = @$details['fee'] + @$details['amount'];
        $total = \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($subtotal, $details['currency'])->formatByDecimal();
    @endphp
    <div class="overlay dark:bg-darkmode-400 dark:border-darkmode-400"></div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Total Amount</label>
        <div class="sm:w-5/6">
            <div class="font-medium text-base pt-2">
                @if ($details['asset_category'] == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
                    {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($subtotal, $details['currency']) }}
                @else
                    Coin {{ $total }}
                @endif
            </div>
        </div>
    </div>
    <input type="hidden" name="amount" id="amount" value="{{ $total }}">
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Card Holder</label>
        <div class="sm:w-5/6">
            <input id="name_on_card" type="text" name="name" class="form-control">
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-5 card required">
        <label for="horizontal-form-3" class="form-label sm:w-24">Card Details</label>
        <div class="sm:w-5/6">
            <div id="card-element" style="padding-top: 10px;"></div>
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-5 card required">
        <label for="horizontal-form-3" class="form-label sm:w-24"></label>
        <div id="card-errors" class="sm:w-5/6" role="alert" style="color:red;"></div>
    </div>

    <div class="text-right mt-5 form-inline text-right mt-5 float-right">
        <a href="{{ route('dashboard.wallet.deposit-overview', ['workspace_id' => \Kanexy\PartnerFoundation\Core\Helper::activeWorkspaceId()]) }}"
            class="btn btn-secondary w-20 inline-block mr-2">Previous</a>
        <button type="submit" class="btn btn-primary w-24">Submit</button>
    </div>
</form>

<script src="https://js.stripe.com/v3/"></script>

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on({
            ajaxStart: function() {
                $("body").addClass("loading");
            },
            ajaxStop: function() {
                $("body").removeClass("loading");
            }
        });

        (function() {
            // Create a Stripe client
            var stripe = Stripe("{{ config('services.stripe.stripe_key') }}");
            // Create an instance of Elements
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            var style = {
                base: {
                    color: '#8c99a9',
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
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                var options = {
                    name: document.getElementById('name_on_card').value,
                }
                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                let csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                $.ajax({
                    type: 'post',
                    url: "{{ route('dashboard.wallet.stripe-payment', ['workspace_id' => $details['workspace_id']]) }}",
                    data: $('form').serialize(),
                    success: function(response) {
                        $.ajax({
                            type: 'post',
                            url: "{{ route('dashboard.wallet.deposit-stripe-payment', ['workspace_id' => $details['workspace_id']]) }}",
                            data: response,
                            success: function(data) {
                                window.location.href =
                                    "{{ route('dashboard.wallet.deposit-final-detail', ['workspace_id' => $details['workspace_id']]) }}";
                            },
                            error: function(data) {
                                $('#card-errors').html('Someting went wrong');
                            },
                        });

                    },
                    error: function(data) {
                        $('#card-errors').html('Someting went wrong');
                    },
                });
            }
        })();
    </script>
@endpush
