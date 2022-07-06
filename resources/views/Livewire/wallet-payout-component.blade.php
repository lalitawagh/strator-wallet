<div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="wallet" class="form-label sm:w-30"> Payout From <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging" wire:ignore>
                <select wire:change="getWalletBalance($event.target.value)" name="wallet" id="wallet"
                    class="form-control" data-search="true" required>
                    <option value="">Select Payout From</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->getKey() }}" @if (old('wallet',$selected_wallet) == $wallet->getKey()) selected @endif>
                            {{ \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first()?->name }}
                        </option>
                    @endforeach
                </select>
                @error('wallet')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="balance" class="form-label sm:w-30"> Balance </label>
            <div class="sm:w-5/6">
                <input wire:model="balance" id="balance" name="balance" type="text" class="form-control" readonly>
                @error('balance')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div wire:ignore class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="beneficiary" class="form-label sm:w-30"> Beneficiary <span
                    class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging">
                <div class="w-full relative">
                    <select wire:change="changeBeneficiary($event.target.value)" name="beneficiary" id="beneficiary" class="form-control"  data-search="true">
                        @foreach ($beneficiaries as $beneficiary)
                            <option value="{{ $beneficiary->getKey() }}">{{ $beneficiary->getFullName() }}</option>
                        @endforeach
                    </select>
                    <a data-toggle="modal" data-target="#walletbenificary-modal" class="absolute top-0 right-0 plus" style="">
                        <i data-feather="plus-circle" class="w-4 h-4 ml-4"></i>
                    </a>
                </div>
                @error('beneficiary')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="phone" class="form-label sm:w-30"> Mobile</label>
            <div class="sm:w-5/6 tillselect-marging">
                <div class="input-group flex flex-col sm:flex-row">
                    <div id="input-group-phone" class="input-group-text flex form-inline"
                        style="padding: 0 5px;">

                        <span id="countryWithPhoneFlagImg" style="display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    align-self: center;margin-right:10px;">
                            @foreach ($countryWithFlags as $country)
                                @isset($country_code)
                                    @if ($country->id == $country_code)
                                        <img src="{{ $country->flag }}">
                                    @endif
                                @else
                                    @if ($country->id == old('country_code', $user->country_id))
                                        <img src="{{ $country->flag }}">
                                    @endif
                                @endisset
                            @endforeach
                        </span>

                        <select id="countryWithPhone" name="country_code" onchange="getFlagImg(this)" data-search="true"
                            class="tail-select" style="width:30%">
                            @foreach ($countryWithFlags as $country)
                                <option data-source="{{ $country->flag }}" value="{{ $country->id }}"
                                    @isset($country_code) @if ($country->id == $country_code) selected @endif @else @if ($country->id == old('country_code', $user->country_id)) selected @else  @endif @endisset>
                                    {{ $country->name }} ({{ $country->phone }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input wire:model="phone" id="phone" name="phone" value="{{ old('phone') }}" type="number"
                        class="form-control @error('phone') border-theme-6 @enderror"
                        onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);" disabled>

                </div>
                @error('country_code')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror

                @error('phone')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="amount" class="form-label sm:w-30"> Amount to Pay <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <input wire:change="changeAmount($event.target.value)" id="amount" name="amount" type="text" value=" {{ old('amount',$amount) }}" class="form-control"
                    onKeyPress="return isNumberKey(event);" onpaste="return false;" required>
                @error('amount')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="remaining_amount" class="form-label sm:w-30"> Remaining </label>
            <div class="sm:w-5/6">
                <input wire:model="remaining_amount" id="remaining_amount" name="remaining_amount" type="text"
                    class="form-control" placeholder="£ 120.00" readonly>
                @error('remaining_amount')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div wire:ignore class="col-span-12 md:col-span-8 lg:col-span-6  sm:col-span-8 form-inline mt-2">
            <label for="receiver_currency" class="form-label sm:w-30"> Payout To <span
                    class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging">
                <select name="receiver_currency" id="receiver_currency"
                    wire:change="changeCurrency($event.target.value)" class="form-control" data-search="true"
                    required>
                    <option value="">Select Payout To</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->getKey() }}" @if ($selected_currency == $wallet->getKey()) selected @endif>
                            {{ \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first()?->name }}
                        </option>
                    @endforeach
                </select>
                @error('receiver_currency')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8  form-inline mt-2">
            <label for="reference" class="form-label sm:w-30"> Reference <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <input id="reference" name="reference" type="text" class="form-control"
                    value="{{ old('reference') }}" required>
                @error('reference')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2"
            style="align-items: center;">
            <label for="note" class="form-label sm:w-30"> Note </label>
            <div class="sm:w-5/6">
                <input id="note" name="note" type="text" class="form-control" value="{{ old('note') }}">
                @error('note')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="attachment" class="form-label sm:w-30"> Attachment </label>
            <div class="sm:w-5/6">
                <input id="attachment" name="attachment" type="file" class="form-control w-full">
                @error('attachment')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        @if (isset($fee) && is_numeric($amount))
            @php
                $exchange_rate = $exchange_rate ?? number_format((float) $exchange_rate, 2, '.', '');
                $total = ($exchange_rate != 0) ? ($amount - $fee) / $exchange_rate : '';
            @endphp

            <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
                <label for="exchange_fee" class="form-label sm:w-30"> </label>
                <div class="sm:w-5/6">
                    Ex Fees : {{ number_format((float) $fee, 2, '.', '') }}, Ex Rate :
                    @isset($exchange_rate)
                        1 {{ $base_currency }} = {{ number_format((float) $exchange_rate, 2, '.', '') }}
                        {{ $exchange_currency }}
                    @endisset
                    @isset($amount)
                        <p>Debit : {{ number_format((float) $amount, 2, '.', '') }} {{ $exchange_currency }} ,   Credit : {{ number_format((float) $total, 2, '.', '') }} {{ $base_currency }} </p>
                    @endisset
                </div>
            </div>
        @endif
    </div>
</div>
