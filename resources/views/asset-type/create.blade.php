@extends("ledger-foundation::config-skeleton")

@section("title", "Create Asset Type")

@section("config-content")
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="intro-y box">
            <div class="box">
                <div class="flex items-center py-2 px-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Create Asset Type
                    </h2>
                </div>

                <div class="p-5">
                    <form action="{{ route('dashboard.ledger-foundation.asset-type.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_category" class="form-label sm:w-30">Asset Category <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php $asset_categories = \Kanexy\LedgerFoundation\Http\Enums\AssetCategory::toArray(); @endphp
                                    <select name="asset_category" id="asset_category"  data-search="true" class="tail-select w-full @error('asset_category') border-theme-6 @enderror">
                                        @foreach($asset_categories as $key => $asset_category)
                                            <option value="{{ $asset_category }}" @if(old('asset_category') == $asset_category) selected @endif>{{ ucwords(str_replace('_', ' ', $asset_category)) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_category')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-28">Name <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') border-theme-6 @enderror"
                                        value="{{ old('name') }}" required>

                                    @error('name')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="logo" class="form-label sm:w-30"> Image </label>
                                <div class="sm:w-5/6">
                                    <input type="file" class="form-control" name="image">

                                    @error('image')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="logo" class="form-label sm:w-28"> Status </label>
                                <div class="sm:w-5/6">
                                    <input id="status" name="status" type="checkbox" class="form-check-switch" @if(old("status")  === 'active') checked @endif>

                                    @error('status')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <a href="#" class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary w-24">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
