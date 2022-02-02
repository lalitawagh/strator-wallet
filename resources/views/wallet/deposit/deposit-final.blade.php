@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-20 mt-0 pt-0">
    <div class="p-5 text-center">
        <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
        @if (isset($details['stripe_fee']))
            @php
            $total = $details['amount'] + $details['fee'];
            $total_fee = $details['fee'] + $details['stripe_fee'];
            $finalTotal = $details['amount'] - $details['stripe_fee'];
            @endphp
            <div class="text-3xl mt-5">Success!</div>
            <div class="text-gray-600 mt-2">Deposit Completed Successfully</div>
            <div class=" mt-3 font-medium text-base">Transaction Amount: {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($total, $details['currency']); }}</div>

            <div class=" mt-3 font-medium text-base">Fee: {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($details['fee'], $details['currency']); }} + {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($details['stripe_fee'], $details['currency']); }}(Stripe Fee) = {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($total_fee, $details['currency']); }}</div>

            <div class=" mt-3 font-medium text-base">Deposit Amount: {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($finalTotal, $details['currency']); }}</div>
        @else
            @php
            $total = $details['amount'] + $details['fee'];
            @endphp
            <div class="mt-3 font-medium text-base">Transaction Amount: {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($total, $details['currency']) }}</div>
            <div class="mt-3 font-medium text-base">Fee: {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($details['fee'], $details['currency']); }}</div>

            <div class="mt-3 font-medium text-base">Deposit Amount: {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($details['amount'], $details['currency']); }}</div>
        @endif
    </div>
    <div class="px-5 pb-8 text-center mt-3">
        <a href="@isset($details['stripe_receipt_url']){{ $details['stripe_receipt_url'] }}@endisset" target="_blank" class="btn btn-secondary w-24 mr-2 mb-2">Print</button>
        <a href="{{ route('dashboard.ledger-foundation.wallet.deposit-money',['workspace_id' => $details['workspace_id']]) }}"  class="btn btn-primary">Deposit Money Again</a>
    </div>
</div>
@endsection
