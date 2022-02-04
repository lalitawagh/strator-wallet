<div>
    <div class="grid grid-cols-12 md:gap-10 mt-0">
        <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2">
            <label for="wallet" class="form-label sm:w-30"> Wallet <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <select wire:change="getWalletBalance($event.target.value)" name="wallet" id="wallet" class="form-control"  data-search="true" required>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->getKey() }}" >{{ \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first()?->name }}</option>
                    @endforeach
                </select>
                @error('wallet')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2">
            <label for="balance" class="form-label sm:w-30"> Balance </label>
            <div class="sm:w-5/6">
                <input wire:model="balance" id="balance" name="balance" type="text" class="form-control" placeholder="£ 1,320.00" readonly >
                @error('balance')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-10 mt-0">
        <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2 relative">
            <label for="beneficiary" class="form-label sm:w-30"> Beneficiary <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <select name="beneficiary" id="beneficiary" class="form-control"  data-search="true">
                    @foreach ($beneficiaries as $beneficiary)
                        <option value="{{ $beneficiary->getKey() }}">{{ $beneficiary->getFullName() }}</option>
                    @endforeach
                </select>
                @error('beneficiary')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
            <a data-toggle="modal" data-target="#walletbenificary-modal"
                class="absolute top-0 right-0 plus"
                style="cursor: pointer;right: -18px;top: 0;margin-top: 20px;">
                <i data-feather="plus-circle" class="w-4 h-4 ml-4"></i>
            </a>
        </div>
        <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2">
            <label for="phone" class="form-label sm:w-30"> Mobile </label>
            <div class="sm:w-5/6">
                <div class="input-group flex flex-col sm:flex-row">
                    <div id="input-group-phone" class="input-group-text flex form-inline"
                        style="padding: 0 5px;">

                        <span id="countryWithPhoneFlagImg" style="display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    align-self: center;margin-right:10px;">
                            @foreach ($countryWithFlags as $country)
                                @if ($country->id == old('country_code', $defaultCountry->id))
                                    <img src="{{ $country->flag }}">
                                @endif
                            @endforeach
                        </span>

                        <select id="countryWithPhone" name="country_code"
                            onchange="getFlagImg(this)" data-search="true"
                            class="tail-select" style="width:30%">
                            @foreach ($countryWithFlags as $country)
                                <option data-source="{{ $country->flag }}"
                                    value="{{ $country->id }}" @if ($country->id == old('country_code', $defaultCountry->id)) selected @endif>
                                    {{ $country->name }} ({{ $country->phone }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input id="phone" name="phone" value="{{ old('phone',$user?->phone) }}"
                        type="number"
                        class="form-control @error('phone') border-theme-6 @enderror"
                        onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);">

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
    <div class="grid grid-cols-12 md:gap-10 mt-0">
        <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2">
            <label for="amount" class="form-label sm:w-30"> Amount to Pay <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <input wire:model="amount" id="amount" name="amount" type="text" class="form-control" required>
                @error('amount')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2">
            <label for="remaining_amount" class="form-label sm:w-30"> Remaining </label>
            <div class="sm:w-5/6">
                <input wire:model="remaining_amount" id="remaining_amount" name="remaining_amount" type="text" class="form-control"  placeholder="£ 120.00" readonly>
                @error('remaining_amount')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>