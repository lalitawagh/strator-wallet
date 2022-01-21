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


                @include('ledger-foundation::wallet.paymentgateway.stripe')
            @endif


    </div>
@endsection





