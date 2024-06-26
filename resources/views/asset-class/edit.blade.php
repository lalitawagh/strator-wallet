@extends('ledger-foundation::config-skeleton')

@section('title', 'Edit Asset Class')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div
                    class="gap-2 sm:gap-0 flex flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="breadcrumb mr-auto hidden sm:flex">
                        <a id="Wallet" href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px"
                            height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a id="Configuration" href="" class="">Configuration</a><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a id="EditAsset" href="" class="breadcrumb--active"> Edit Asset Class</a>
                    </div>
                </div>
                <div class="p-5">
                    <form action="{{ route('dashboard.wallet.asset-class.update', $asset_class['id']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-30">Name <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') border-theme-6 @enderror"
                                        value="{{ old('name', $asset_class['name']) }}" required>

                                    @error('name')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="logo" class="form-label sm:w-30"> Image </label>
                                <div class="sm:w-5/6">
                                    <input type="file" class="form-control" name="image">
                                    @isset($asset_class['image'])
                                        <img class="rounded-md proof-default pt-2" style="width:100px;" alt=""
                                            src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($asset_class['image'], now()->addMinutes(5)) }}">
                                    @endisset

                                    @error('image')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-30"> Status</label>
                                <div class="sm:w-5/6 form-check form-switch">
                                    <input id="status" name="status" type="checkbox" class="form-check-input"
                                        @if ($asset_class['status'] == \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) checked @endif>

                                    @error('status')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <a id="assetClassEditCancel" href="{{ route('dashboard.wallet.asset-class.index') }}"
                                class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button id="assetClassUpdate" type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Daily Sales -->

        </div>
    </div>
@endsection
