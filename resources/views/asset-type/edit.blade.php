@extends("ledger-foundation::config-skeleton")

@section("title", "Edit Asset Type")

@section("config-content")
    <div class="configuration-container">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="breadcrumb--active">Edit Asset Type</a>
                    </div>
                </div>
                <div class="p-5">
                    <form action="{{ route('dashboard.wallet.asset-type.update',$asset_type['id']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_category" class="form-label sm:w-30">Asset Category <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $asset_categories = \Kanexy\LedgerFoundation\Enums\AssetCategory::toArray();
                                    @endphp
                                    <select name="asset_category" id="asset_category" data-search="true" class="tail-select w-full @error('asset_category') border-theme-6 @enderror">
                                        @foreach ($asset_categories as $key => $asset_category)
                                            <option value="{{ $asset_category }}" @if (old('asset_category',$asset_type['asset_category']) == $asset_category) selected @endif>{{ trans('ledger-foundation::configuration.'.$asset_category) }}</option>
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
                                        value="{{ old('name',$asset_type['name']) }}" required>

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
                                    <img class="rounded-md proof-default" style="width:100px;" alt="" src="@isset($asset_type_list['image']){{ \Illuminate\Support\Facades\Storage::disk('azure')->url($asset_type['image']) }}@endisset">
                                    @error('image')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-28"> Active</label>
                                <div class="sm:w-5/6">
                                    <input id="status" name="status" type="checkbox" class="form-check-switch" @if (old("status",$asset_type['status'])  === \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) checked @endif>

                                    @error('status')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <a href="{{ route('dashboard.ledger-foundation.asset-type.index') }}" class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Daily Sales -->

        </div>
    </div>
@endsection
