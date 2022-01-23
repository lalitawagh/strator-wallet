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
    .CardField-input-wrapper {
    position: absolute;
    left: 0;
    right: 0;
    white-space: nowrap;
    /* overflow: hidden; */
    }
    .overlay {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255, 255, 255, 0.8) url("../../dist/images/loader.gif") center no-repeat;
    }

    /* Turn off scrollbar when body element has the loading class */
    body.loading {
        overflow: hidden;
    }

    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay {
        display: block;
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





