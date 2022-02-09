<div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="wallet" class="form-label sm:w-40"> Wallet <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6" wire:ignore>
            <select wire:change="changeBaseCurrency($event.target.value)" name="wallet" class="form-control">
                <option value="">Select Wallet</option>
                @foreach ($wallets as $wallet)
                    <option value="{{ $wallet->getKey() }}" @if ($selected_wallet == $wallet->getKey()) selected @endif>{{ $wallet->ledger?->name }}</option>
                @endforeach
            </select>
            @error('wallet')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="amount" class="form-label sm:w-40"> Amount <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required onKeyPress="return isNumberKey(event);">
            @error('amount')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="currency" class="form-label sm:w-40">Paying Currency <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6" wire:ignore>
            <select wire:change="changeCurrency($event.target.value)" name="currency" id="currency" class="form-control">
                <option value="">Select Currency</option>
                @foreach ($currencies as $currency)
                    <option value="{{ $currency['id'] }}" @if (session('currency') == $currency['id']) selected @endif>{{ $currency['name'] }}</option>
                @endforeach
            </select>
            @error('currencydata')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>

    @if($this->exchange_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="payment_method" class="form-label sm:w-40"> Payment Method <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            @php
                $payment_methods = \Kanexy\LedgerFoundation\Enums\PaymentMethod::toArray();
            @endphp
            <select class="form-control" name="payment_method" id="payment_method" required>
                <option value="">Select Payment Method</option>
                @foreach ($payment_methods as $payment_method)
                    <option value="{{ $payment_method }}" @if(old('payment_method') == $payment_method) selected @endif> {{ trans('ledger-foundation::configuration.'.$payment_method) }} </option>
                @endforeach
            </select>
            @error('payment_method')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @endif
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="reference" class="form-label sm:w-40"> Reference <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <input id="reference" type="text" class="form-control" name="reference" required>
            @error('reference')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
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
