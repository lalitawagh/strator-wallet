<div>
    @if ($sent_resend_otp == true)
        <h4 class="text-success mt-1">OTP Resend Success</h4>
    @else
        <h3 class="text-success">OTP is sent to your registered mobile number. Please enter.</h3>
    @endif
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="amount" class="form-label sm:w-40"> Mobile <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6 tillselect-marging">
            <div class="input-group flex flex-col sm:flex-row">
                <div id="input-group-phone" wire:ignore class="input-group-text flex form-inline"
                    style="padding: 0 5px;">

                    <span id="countryWithPhoneFlagImg" style="display: flex;
                                justify-content: center;
                                align-items: center;
                                align-self: center;margin-right:10px;">
                        @foreach ($countryWithFlags as $country)
                            @if ($country->id == old('country_code', $user->country_id))
                                <img src="{{ $country->flag }}">
                            @endif
                        @endforeach
                    </span>

                    <select id="countryWithPhone" name="country_code" onchange="getFlagImg(this)" data-search="true" class="tom-select" >
                        @foreach ($countryWithFlags as $country)
                            <option data-source="{{ $country->flag }}" value="{{ $country->id }}"
                                @if ($country->id == old('country_code', $user->country_id)) selected @endif>
                                {{ $country->code }} ({{ $country->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <input id="phone" name="phone" value="{{ old('phone', $user?->phone) }}" type="number"
                    class="form-control @error('phone') border-theme-6 @enderror"
                    onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);" disabled>

            </div>

        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="code" class="form-label sm:w-40"> OTP <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <input id="code" type="text" wire:model="code" class="form-control" name="code"
                value="{{ old('otp') }}" required onKeyPress="return isNumberKey(event);">
            @error('code')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
            <a wire:click="resendOtp({{ $oneTimePassword }})" class="block active-clr mt-2"
                style="cursor: pointer;">Resend OTP </a>
        </div>
    </div>
    <div class="text-right mt-5">
        <button type="button" wire:click="verifyOtp()" class="btn btn-primary w-24">Next</button>
    </div>
</div>
