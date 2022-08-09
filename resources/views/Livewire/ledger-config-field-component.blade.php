<div>

    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
            <label for="exchange_type" class="form-label sm:w-30">Exchange Type <span
                    class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging">
                @php
                    $exchange_types = \Kanexy\LedgerFoundation\Enums\ExchangeType::toArray();
                @endphp
                <select name="exchange_type" id="exchange_type" wire:change="changeExchangeType($event.target.value)"
                    data-search="true" class="tail-select w-full @error('exchange_type') border-theme-6 @enderror">
                    <option value="">Select Exchange Type</option>
                    @foreach ($exchange_types as $key => $exchange_type)
                        <option value="{{ $exchange_type }}" @if (old('exchange_type', $selected_exchange_type) == $exchange_type) selected @endif>
                            {{ trans('ledger-foundation::configuration.' . $exchange_type) }}</option>
                    @endforeach
                </select>

                @error('exchange_type')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
            <label for="logo" class="form-label sm:w-30"> Logo </label>
            <div class="sm:w-5/6">
                <input type="file" class="form-control" name="image">
                @isset($ledger?->image)
                    <img class="rounded-md proof-default" style="width:100px;" alt=""
                        src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($ledger->image,now()->addMinutes(5)) }}">
                @endisset

                @error('image')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
            <label for="asset_category" class="form-label sm:w-30">Asset Category <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging">

                <select name="asset_category" wire:change="changeAssetCategory($event.target.value)" id="asset_category"
                    class="w-full @error('asset_category') border-theme-6 @enderror form-control">
                    <option value="">Select Asset Category</option>
                    @foreach ($asset_categories as $key => $asset_category)
                        <option value="{{ $asset_category }}" @if (old('asset_category', $selected_asset_category) == $asset_category) selected @endif>
                            {{ trans('ledger-foundation::configuration.' . $asset_category) }}</option>
                    @endforeach
                </select>

                @error('asset_category')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
            <label for="asset_type" class="form-label sm:w-30"> Asset Type <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging">
                <select name="asset_type" id="asset_type" wire:change="changeAssetType($event.target.value)"
                    class="w-full  @error('asset_type') border-theme-6 @enderror form-control">
                    <option value="">Select Asset Type</option>
                    @foreach ($asset_types as $asset_type)
                        <option value="{{ $asset_type['id'] }}" @if (old('asset_type') == $asset_type['id'] || $selected_asset_type == $asset_type['id']) selected @endif>
                            {{ ucfirst($asset_type['name']) }}</option>
                    @endforeach
                </select>

                @error('asset_type')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    @if (old('asset_category') == \Kanexy\LedgerFoundation\Enums\AssetCategory::COMMODITY || $selected_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::COMMODITY)
        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                <label for="commodity_category" class="form-label sm:w-30"> Commodity Category <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6 tillselect-marging">
                    <select name="commodity_category" id="commodity_category" data-search="true"
                        class="tail-select w-full @error('commodity_category') border-theme-6 @enderror">
                        <option value="">Select Commodity Category</option>
                        @foreach ($commodity_types as $commodity_type)
                            <option value="{{ $commodity_type['id'] }}"
                                @if (old('commodity_category', @$ledger?->commodity_category) == $commodity_type['id']) selected @endif>
                                {{ ucfirst($commodity_type['name']) }}</option>
                        @endforeach
                    </select>

                    @error('commodity_category')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    @endif
</div>
