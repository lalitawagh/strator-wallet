@extends('ledger-foundation::layouts.master')

@section('content')
<div class="grid grid-cols-12 gap-6 mb-3">
    <div class="sm:col-span-3"></div>
    <div class="col-span-12 md:col-span-8 xl:col-span-6 sm:col-span-8">
        <div class="box">
            <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Payment Details
                </h2>
            </div>
            <div class="p-10">
                <div class="px-5 sm:px-5 mt-0 pt-0">
                    <form role="form" action="{{ route('dashboard.wallet.stellar-payment-details') }}" method="POST" class="require-validation" data-token-on-file="false"
                    data-stripe-publishable-key="{{ config('services.stripe.stripe_key') }}" id="payment-form">
                        @csrf
                        
                        <div class="overlay dark:bg-darkmode-400 dark:border-darkmode-400"></div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">Total Amount</label>
                            <div class="sm:w-5/6">
                                <div class="font-medium text-base pt-2">
                                    {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($stellarPayoutDetails['amount'], $stellarPayoutDetails['wallet']) }}
                                </div>
                            </div>
                        </div>
                  
                        <input type="hidden" name="amount" id="amount" value="{{ $stellarPayoutDetails['amount'] }}">
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">Card Holder</label>
                            <div class="sm:w-5/6">
                                <input id="name_on_card" type="text" name="name" class="form-control" placeholder="Card Holder">
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">Card Number</label>
                            <div class="sm:w-5/6">
                                <input id="name_on_card" type="text" name="card_number" class="form-control" placeholder="Card Number">
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">Expiary Year</label>
                            <div class="sm:w-5/6">
                                <input id="name_on_card" type="text" name="year" class="form-control" placeholder="Expiary Year ">
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">Expiary Month</label>
                            <div class="sm:w-5/6">
                                <input id="name_on_card" type="text" name="month" class="form-control" placeholder="Expiary Month">
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">CVC</label>
                            <div class="sm:w-5/6">
                                <input id="name_on_card" type="text" name="cvc" class="form-control" placeholder="CVC">
                            </div>
                        </div>
                        {{-- <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-5 card required">
                            <label for="horizontal-form-3" class="form-label sm:w-24">Card Details</label>
                            <div class="sm:w-5/6">
                                <div id="card-element" style="padding-top: 10px;"></div>
                            </div>
                        </div> --}}
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-5 card required">
                            <label for="horizontal-form-3" class="form-label sm:w-24"></label>
                            <div id="card-errors" class="sm:w-5/6" role="alert" style="color:red;"></div>
                        </div>

                        <div class="text-right form-inline text-right float-right">
                            <a id="StripePrevious"
                                href="{{ route('dashboard.wallet.deposit-overview', ['workspace_id' => \Kanexy\PartnerFoundation\Core\Helper::activeWorkspaceId()]) }}"
                                class="btn btn-secondary w-20 inline-block mr-2">Previous</a>
                            <button id="StripeSubmit" type="submit" class="btn btn-primary w-24">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $url = window.location.pathname.split('/');
    if ($url[3] == 'stellar-payment-method') {
        $('#color-scheme-content').addClass('dark');
    }
</script>
@endpush
{{-- <script src="https://js.stripe.com/v3/"></script>

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

                if(event.error.message == '')
                {
                    alert(card);
                }
            });
            // Handle form submission
        

           
        })();
    </script>
@endpush --}}