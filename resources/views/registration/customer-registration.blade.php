@if ($isBankingUser == false && request()->input("type") != "standard")
<div class="form-inline mb-2">
    <label for="phone" class="form-label sm:w-30">Mobile Number <span
            class="text-theme-6">*</span></label>
    <div class="sm:w-3/5 tillselect-marging">
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
                    class="tail-select" autocomplete="off">
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
<div class="form-inline mb-2">
    <label for="password" class="form-label sm:w-30">Select PIN <span
            class="text-theme-6">*</span></label>
    <div class="sm:w-3/5">
        <input id="password" name="password" value="{{ old('password') }}"
            type="password" placeholder="Enter 6-digit PIN"
            class="form-control  @error('password') border-theme-6 @enderror"
            onKeyPress="if(this.value.length==6) return false;return onlyNumberKey(event);">

        @error('password')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-inline mb-2">
    <label for="password_confirmation" class="form-label sm:w-30">Re-enter PIN <span
            class="text-theme-6">*</span></label>
    <div class="sm:w-3/5">
        <input id="password_confirmation" name="password_confirmation"
            value="{{ old('password_confirmation') }}" type="password"
            class="form-control  @error('password_confirmation') border-theme-6 @enderror"
            placeholder="Re-enter 6-digit PIN"
            onKeyPress="if(this.value.length==6) return false;return onlyNumberKey(event);">

        @error('password_confirmation')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
        @enderror
    </div>
</div>
@endif

@if ($isBankingUser != 0 && $defaultCountry->code != 'UK')
<div class="form-inline mb-2">
    <label for="nationality" class="form-label sm:w-30">Nationality <span
            class="text-theme-6">*</span></label>
    <div class="sm:w-3/5 tillselect-marging">
        <select id="nationality" name="nationality" data-search="true"
            class="w-full @error('nationality') border-theme-6 @enderror">
            @foreach ($nationalities as $key => $nationality)
                <option value="{{ $nationality }}" @if ($nationality == old('nationality', $defaultCountry->code == $key ? $nationality : '')) selected  @endif>
                    {{ ucfirst($nationality) }}
                </option>
            @endforeach
        </select>
        @error('nationality')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-inline mb-2">
    <label for="country_id" class="form-label sm:w-30">Residence <span
            class="text-theme-6">*</span></label>

    <div class="sm:w-3/5 tillselect-marging">
        <select id="country_id" name="country_id" data-search="true"
            class="w-full @error('country_id') border-theme-6 @enderror">
            @foreach ($countries as $key => $value)
                <option value="{{ $key }}" @if ($key == old('country_id', $defaultCountry->id)) selected @elseif($key == old('country_id', $user?->country_id)) selected @endif>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @error('country_id')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
        @enderror
    </div>
</div>
@elseif ($isBankingUser != 0 && $defaultCountry->code == 'UK')
<input type="hidden" name="country_id" value="{{ $defaultCountry->id }}">
@endif
