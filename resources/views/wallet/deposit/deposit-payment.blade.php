@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
    <div class="px-5 sm:px-5 mt-0 pt-0">
        @if ($details['payment_method'] == \Kanexy\LedgerFoundation\Enums\PaymentMethod::STRIPE)
            @include('ledger-foundation::wallet.paymentgateway.stripe')
        @else
            @include('ledger-foundation::wallet.paymentgateway.manual')
        @endif
    </div>
@endsection


