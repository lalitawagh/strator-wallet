
@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
    <form action="{{ route('dashboard.ledger-foundation.wallet.store-deposit-detail') }}" method="POST">
    @csrf
        <div class="px-5 sm:px-5 mt-0 pt-0">
            <div class="flex flex-col pb-5">
                <span class="font-medium text-base">Deposit Money via <strong>{{ $details['payment_method'] }}</strong></span>
            </div>
            <div class="flex">
                <div class="mr-auto">Deposit Amount </div>
                <div class="font-medium">{{ \Cknow\Money\Money::parseByIntlLocalizedDecimal($details['amount'], $details['currency']); }}</div>
            </div>
            <div class="flex mt-4">
                <div class="mr-auto">Fee</div>
                <div class="font-medium">{{ \Cknow\Money\Money::parseByIntlLocalizedDecimal($details['fee'], $details['currency']); }}</div>
            </div>


            <div class="flex mt-4 pt-4 border-t border-gray-200 dark:border-dark-5">
                <div class="mr-auto font-medium text-base">Total</div>
                @php $total = $details['fee'] + $details['amount']; @endphp
                <div class="font-medium text-base">{{ \Cknow\Money\Money::parseByIntlLocalizedDecimal($total, $details['currency']); }}</div>
            </div>
            <div class="flex mt-4">
                <div class="mr-auto"></div>
                <div class="font-medium"> Additional Fees</div>
            </div>

            <div class="text-right mt-5 form-inline text-right mt-5 float-right">
                <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Previous</a>
                <button type="submit" class="btn btn-primary w-24">Next</a>
            </div>
        </div>
    </form>

@endsection
