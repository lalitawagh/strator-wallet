<div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="wallet" class="form-label sm:w-40"> Wallet <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <select wire:change="changeBaseCurrency($event.target.value)" name="wallet" class="form-control">
                <option value="">Select Wallet</option>
                @foreach ($wallets as $wallet)
                    <option value="{{ $wallet->getKey() }}" @if (session('wallet') == $wallet->getKey()) selected @endif>{{ $wallet->ledger?->name }}</option>
                @endforeach
            </select>
            <span class="block text-theme-6 mt-2"></span>
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="currency" class="form-label sm:w-40"> Currency <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <select wire:change="changeCurrency($event.target.value)" name="currency" id="currency" class="form-control">
                <option value="">Select Currency</option>
                @foreach ($currencies as $currency)
                    <option value="{{ $currency['id'] }}" @if (session('currency') == $currency['id']) selected @endif>{{ $currency['name'] }}</option>
                @endforeach
            </select>
            <span class="block text-theme-6 mt-2"></span>
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="amount" class="form-label sm:w-40"> Amount <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <input wire:model="amount" id="amount" type="text" class="form-control" name="amount">
            <span class="block text-theme-6 mt-2"></span>
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="payment_method" class="form-label sm:w-40"> Payment Method <span class="text-theme-6">*</span></label>
        <div wire:ignore class="sm:w-5/6">
            @php
                $payment_methods = \Kanexy\LedgerFoundation\Http\Enums\PaymentMethod::toArray();
            @endphp
            <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="payment_method">
                <option value="">Select Payment Method</option>
                @foreach ($payment_methods as $payment_method)
                    <option value="{{ $payment_method }}"> {{ trans('ledger-foundation::configuration.'.$payment_method) }} </option>
                @endforeach
            </select>
            <span class="block text-theme-6 mt-2"></span>
        </div>
    </div>
    @if (isset($fee))
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="exchange_fee" class="form-label sm:w-40"> </label>
        <div class="sm:w-5/6">
            Ex Fees : {{ $fee }} + Additional Fees , Ex Rate : @isset($exchange_rate)1 {{ $base_currency}} = {{ number_format((float)$exchange_rate, 2, '.', '') }} {{ $exchange_currency}}@endisset
        </div>
    </div>
    @elseif (session('fee'))
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="exchange_fee" class="form-label sm:w-40"> </label>
        <div class="sm:w-5/6">
            Ex Fees : {{ session('fee') }} + Additional Fees , Ex Rate : 1 {{ session('base_currency') }} = {{ number_format((float)session('exchange_rate'), 2, '.', '') }} {{ session('exchange_currency') }}
        </div>
    </div>
    @endif
</div>
