@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-5 mt-0 pt-0">

    <form action="{{ route('dashboard.ledger-foundation.wallet.store-deposit-initial') }}" method="POST">
        @csrf
        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
            <label for="wallet" class="form-label sm:w-40"> Wallet <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <select name="wallet" id="wallet" class="tail-select">
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->getKey() }}">{{ $wallet->ledger->name }}</option>
                    @endforeach
                </select>
                <span class="block text-theme-6 mt-2"></span>
            </div>
        </div>
        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
            <label for="currency" class="form-label sm:w-40"> Currency <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <select name="currency" id="currency" class="tail-select">
                    @foreach ($currencies as $currencies)
                        <option value="{{ $currencies->name }}">{{ $currencies->name }}</option>
                    @endforeach
                </select>
                <span class="block text-theme-6 mt-2"></span>
            </div>
        </div>
        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
            <label for="amount" class="form-label sm:w-40"> Amount <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <input id="amount" type="text" class="form-control" name="amount">
                <span class="block text-theme-6 mt-2"></span>
            </div>
        </div>
        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
            <label for="payment_method" class="form-label sm:w-40"> Payment Method <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="payment_method">
                    <option>Paypal</option>
                    <option>Stripe</option>
                    <option>Bank</option>
                </select>
                <span class="block text-theme-6 mt-2"></span>
            </div>
        </div>

        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary w-24">Next</button>
        </div>
    </form>

</div>
@endsection
