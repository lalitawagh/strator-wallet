@extends('ledger-foundation::config-skeleton')

@section('title', 'Edit Ledger')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div
                    class="flex gap-2 sm:gap-0 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
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
                        <a id="EditLedger" href="" class="breadcrumb--active"> Edit Ledger</a>
                    </div>
                </div>
                <div class="p-5">
                    <form action="{{ route('dashboard.wallet.ledger.update', $ledger->getKey()) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-30">Ledger Name <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') border-theme-6 @enderror"
                                        value="{{ old('name', $ledger->name) }}" required>

                                    @error('name')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="code" class="form-label sm:w-30">Code <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="code" name="code" type="text"
                                        class="form-control @error('code') border-theme-6 @enderror"
                                        value="{{ old('code', $ledger->code) }}" required>

                                    @error('code')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="ledger_type" class="form-label sm:w-30">Ledger Type <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    @php
                                        $ledger_types = \Kanexy\LedgerFoundation\Enums\LedgerType::toArray();
                                    @endphp
                                    <select name="ledger_type" id="ledger_type" data-search="true"
                                        class=" w-full @error('ledger_type') border-theme-6 @enderror">
                                        <option value="">Select Ledger Type</option>
                                        @foreach ($ledger_types as $key => $ledger_type)
                                            <option value="{{ $ledger_type }}"
                                                @if (old('ledger_type', $ledger->ledger_type) == $ledger_type) selected @endif>
                                                {{ trans('ledger-foundation::configuration.' . $ledger_type) }}</option>
                                        @endforeach
                                    </select>

                                    @error('ledger_type')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="symbol" class="form-label sm:w-30">Symbol <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="symbol" name="symbol" type="symbol"
                                        class="form-control @error('symbol') border-theme-6 @enderror"
                                        value="{{ old('symbol', $ledger->symbol) }}" required>

                                    @error('symbol')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        @livewire('ledger-config-field-component', ['asset_types' => $asset_types, 'asset_categories' => \Kanexy\LedgerFoundation\Enums\AssetCategory::toArray(), 'commodity_types' => $commodity_types, 'ledger' => $ledger])

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="exchange_from" class="form-label sm:w-30">Exchange From <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    @php
                                        $exchange_from = \Kanexy\LedgerFoundation\Enums\ExchangeFrom::toArray();
                                    @endphp
                                    <select name="exchange_from" id="exchange_from" data-search="true"
                                        class=" w-full @error('exchange_from') border-theme-6 @enderror">
                                        <option value="">Select Exchange From</option>
                                        @foreach ($exchange_from as $key => $exchange_from_val)
                                            <option value="{{ $exchange_from_val }}"
                                                @if (old('exchange_from', $ledger->exchange_from) == $exchange_from_val) selected @endif>
                                                {{ trans('ledger-foundation::configuration.' . $exchange_from_val) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('exchange_from')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="asset_class" class="form-label sm:w-30"> Asset Class <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    <select name="asset_class" id="asset_class" data-search="true"
                                        class=" w-full @error('asset_class') border-theme-6 @enderror">
                                        <option value="">Select Asset Class</option>
                                        @foreach ($asset_classes as $asset_class)
                                            <option value="{{ $asset_class['id'] }}"
                                                @if (old('asset_class', $ledger->asset_class) == $asset_class['id']) selected @endif>
                                                {{ ucfirst($asset_class['name']) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_class')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-30"> Status <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    <select name="status" id="status" data-search="true" class=" w-full">
                                        <option value="">Select Status</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::NEW }}"
                                            @if (old('status', $ledger->status) === \Kanexy\LedgerFoundation\Enums\LedgerStatus::NEW) selected @endif>
                                            {{ trans('ledger-foundation::configuration.new') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE }}"
                                            @if (old('status', $ledger->status) === \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE) selected @endif>
                                            {{ trans('ledger-foundation::configuration.active') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::INACTIVE }}"
                                            @if (old('status', $ledger->status) === \Kanexy\LedgerFoundation\Enums\LedgerStatus::INACTIVE) selected @endif>
                                            {{ trans('ledger-foundation::configuration.inactive') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::HOLD }}"
                                            @if (old('status', $ledger->status) === \Kanexy\LedgerFoundation\Enums\LedgerStatus::HOLD) selected @endif>
                                            {{ trans('ledger-foundation::configuration.hold') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::SUSPENDED }}"
                                            @if (old('suspended', $ledger->status) === \Kanexy\LedgerFoundation\Enums\LedgerStatus::SUSPENDED) selected @endif>
                                            {{ trans('ledger-foundation::configuration.suspended') }}</option>
                                    </select>
                                    @error('status')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="text-right mt-5">
                            <a id="ledgerEditCancel" href="{{ route('dashboard.wallet.ledger.index') }}"
                                class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button id="ledgerEditUpdate" type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Daily Sales -->

        </div>
    </div>
@endsection
