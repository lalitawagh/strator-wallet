
@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')

    <div class="px-5 sm:px-20 mt-0 pt-0">
        <div class="flex flex-col pb-5">
            <span class="font-medium text-base">Deposit Money via <strong>Stripe</strong></span>
        </div>
        <div class="flex">
            <div class="mr-auto">Deposit Amount </div>
            <div class="font-medium">$10.00</div>
        </div>
        <div class="flex mt-4">
            <div class="mr-auto">Fee</div>
            <div class="font-medium">1.02</div>
        </div>
        <div class="flex mt-4 pt-4 border-t border-gray-200 dark:border-dark-5">
            <div class="mr-auto font-medium text-base">Total</div>
            <div class="font-medium text-base">$11.02</div>
        </div>

        <div class="text-right mt-5 form-inline text-right mt-5 float-right">
            <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Preview</a>
            <a href="{{ route('dashboard.ledger-foundation.wallet.deposit-payment') }}" class="btn btn-primary w-24">Next</a>
        </div>
    </div>

@endsection
