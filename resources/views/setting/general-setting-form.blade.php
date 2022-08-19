<div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
    <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-2">
        <label for="wallet_default_country" class="form-label sm:w-52">Wallet Default Country</label>
        <div class="sm:w-5/6 tillselect-marging">
            <select id="wallet_default_country" name="wallet_default_country" data-search="true"
                class="tom-select w-full @error('wallet_default_country') border-theme-6 @enderror">
                @foreach ($countries as $country)
                    <option value="{{ $country->getKey() }}" @if ($country->getKey() == old('wallet_default_country', @$settings['wallet_default_country'])) selected @endif>
                        {{ $country->name }}</option>
                @endforeach
            </select>

            @error('wallet_default_country')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
