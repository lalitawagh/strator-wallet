<div>
    <div class="grid grid-cols-12 md:gap-10 mt-0">
        <div class="col-span-12 md:col-span-6 form-inline mt-2">
            <label for="asset_category" class="form-label sm:w-28">Asset Category <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                @php $asset_categories = \Kanexy\LedgerFoundation\Http\Enums\AssetCategory::toArray(); @endphp
                <select name="asset_category" wire:change="changeAssetCategory($event.target.value)" id="asset_category" data-search="true" class="tail-select w-full @error('asset_category') border-theme-6 @enderror form-control">
                    @foreach($asset_categories as $key => $asset_category)
                        <option value="{{ $asset_category }}" @if(old('asset_category') == $key) selected @endif>{{ ucwords(str_replace('_', ' ', $asset_category)) }}</option>
                    @endforeach
                </select>

                @error('asset_category')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 form-inline mt-2">
            <label for="asset_type" class="form-label sm:w-28"> Asset Type <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <select name="asset_type" id="asset_type" data-search="true" class="tail-select w-full  @error('asset_type') border-theme-6 @enderror form-control">
                    @foreach ($asset_types as $asset_type)
                        <option value="{{ $asset_type['id'] }}" @if(old('asset_type') == $asset_type['id']) selected @endif>{{ ucfirst($asset_type['name']) }}</option>
                    @endforeach
                </select>

                @error('asset_type')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
