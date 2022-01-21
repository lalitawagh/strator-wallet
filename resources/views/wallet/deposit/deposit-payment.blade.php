@extends("ledger-foundation::wallet.deposit.skeleton")
@push('styles')
<style type="text/css">
    .panel-title {
    display: inline;
    font-weight: bold;
    }
    .display-table {
        display: table;
    }
    .display-tr {
        display: table-row;
    }
    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 61%;
    }
</style>
@endpush

@section('deposit-content')
    <div class="px-5 sm:px-5 mt-0 pt-0">

            {{-- <div id="horizontal-form" class="p-5"> --}}
            @if ($details['payment_method'] == 'Paypal')
                @include('ledger-foundation::wallet.paymentgateway.paypal')
            @else
                {{-- <form role="form" action="{{ route('dashboard.ledger-foundation.wallet.store-deposit-payment-stripe') }}" method="post" class="require-validation"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ config('services.stripe.stripe_key') }}"
                    id="payment-form">
                    @csrf

                    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                        <label for="horizontal-form-3" class="form-label sm:w-24">Cardholder</label>
                        <div class="sm:w-5/6">
                            <input id="horizontal-form-3" type="text" class="form-control" placeholder="Jack">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                        <label for="horizontal-form-3" class="form-label sm:w-24">Card Number</label>
                        <div class="sm:w-5/6">
                            <input id="horizontal-form-3" name="card-number" type="text" class="form-control card-number" placeholder="3546879542685421">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                        <label for="horizontal-form-2" class="form-label sm:w-24">Expiry Month</label>
                        <div class="sm:w-5/6">
                            <input id="horizontal-form-2" type="text" class="form-control card-expiry-month" placeholder="11">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                        <label for="horizontal-form-2" class="form-label sm:w-24">Expiry Year</label>
                        <div class="sm:w-5/6">
                            <input id="horizontal-form-2" type="text" class="form-control card-expiry-year" placeholder="2202">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                        <label for="horizontal-form-2" class="form-label sm:w-24">CVV</label>
                        <div class="sm:w-5/6">
                            <input id="horizontal-form-2" name="cvv" type="text" class="form-control card-cvc" placeholder="135">
                        </div>
                    </div>

                    <div class="text-right mt-5 form-inline text-right mt-5 float-right">
                        <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Preview</a>
                        <button type="submit"
                            class="btn btn-primary w-24">Submit</button>
                    </div>
                </form> --}}

                @include('ledger-foundation::wallet.paymentgateway.stripe')
            @endif


    </div>
@endsection





