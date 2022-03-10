@extends("ledger-foundation::config-skeleton")

@section("title", "Create Ledger")

@section("config-content")
    <div class="configuration-container">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="breadcrumb--active"> Create Ledger</a>
                    </div>
                </div>
                <div class="p-5">
                    <form action="{{ route('dashboard.wallet.ledger.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-30">Ledger Name <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') border-theme-6 @enderror"
                                        value="{{ old('name') }}" required>

                                    @error('name')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="code" class="form-label sm:w-30">Code <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="code" name="code" type="text"
                                        class="form-control @error('code') border-theme-6 @enderror"
                                        value="{{ old('code') }}" required>

                                    @error('code')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="ledger_type" class="form-label sm:w-30">Ledger Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $ledger_types = \Kanexy\LedgerFoundation\Enums\LedgerType::toArray();
                                    @endphp
                                    <select name="ledger_type" id="ledger_type" data-search="true" class="tail-select w-full @error('ledger_type') border-theme-6 @enderror">
                                        <option value="">Select Ledger Type</option>
                                        @foreach ($ledger_types as $key => $ledger_type)
                                            <option value="{{ $ledger_type }}" @if(old('ledger_type') == $ledger_type) selected @endif>{{ trans('ledger-foundation::configuration.'.$ledger_type) }}</option>
                                        @endforeach
                                    </select>

                                    @error('ledger_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="symbol" class="form-label sm:w-30">Symbol <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="symbol" name="symbol" type="symbol"
                                        class="form-control @error('symbol') border-theme-6 @enderror"
                                        value="{{ old('symbol') }}" required>

                                    @error('symbol')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        @livewire('ledger-config-field-component', ['asset_types' => $asset_types,'asset_categories' => \Kanexy\LedgerFoundation\Enums\AssetCategory::toArray() ,'commodity_types' => $commodity_types, 'ledger' => []])

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_from" class="form-label sm:w-30">Exchange From  <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $exchange_from = \Kanexy\LedgerFoundation\Enums\ExchangeFrom::toArray();
                                    @endphp
                                    <select name="exchange_from" id="exchange_from" data-search="true" class="tail-select w-full @error('exchange_from') border-theme-6 @enderror">
                                        <option value="">Select Exchange From</option>
                                        @foreach ($exchange_from as $key => $exchange_from_val)
                                            <option value="{{ $exchange_from_val }}" @if (old('exchange_from') == $exchange_from_val) selected @endif>{{ trans('ledger-foundation::configuration.'.$exchange_from_val) }}</option>
                                        @endforeach
                                    </select>

                                    @error('exchange_from')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_class" class="form-label sm:w-30"> Asset Class <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="asset_class" id="asset_class" data-search="true" class="tail-select w-full @error('asset_class') border-theme-6 @enderror">
                                        <option value="">Select Asset Class</option>
                                        @foreach ($asset_classes as $asset_class)
                                            <option value="{{ $asset_class['id'] }}" @if (old('asset_class') == $asset_class['id']) selected @endif>{{ ucfirst($asset_class['name']) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_class')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-3 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-30"> Status <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="status" id="status" data-search="true" class="tail-select w-full">
                                        <option value="">Select Status</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::NEW }}" @if (old("status")  === \Kanexy\LedgerFoundation\Enums\LedgerStatus::NEW) checked @endif>{{ trans('ledger-foundation::configuration.new') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE }}" @if (old("status")  === \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE) checked @endif>{{ trans('ledger-foundation::configuration.active') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::INACTIVE }}" @if (old("status")  === \Kanexy\LedgerFoundation\Enums\LedgerStatus::INACTIVE) checked @endif>{{ trans('ledger-foundation::configuration.inactive') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::HOLD }}" @if (old("status")  === \Kanexy\LedgerFoundation\Enums\LedgerStatus::HOLD) checked @endif>{{ trans('ledger-foundation::configuration.hold') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::SUSPENDED }}" @if (old("suspended")  === \Kanexy\LedgerFoundation\Enums\LedgerStatus::SUSPENDED) checked @endif>{{ trans('ledger-foundation::configuration.suspended') }}</option>
                                    </select>
                                    @error('status')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-3 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="deposit_fee" class="form-label sm:w-30">Deposit Fee <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="deposit_fee" name="deposit_fee" type="text"
                                        class="form-control @error('deposit_fee') border-theme-6 @enderror"
                                        value="{{ old('deposit_fee') }}" onKeyPress="return isNumberKey(event);" required>

                                    @error('deposit_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="withdraw_fee" class="form-label sm:w-30">Withdraw Fee <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="withdraw_fee" name="withdraw_fee" type="text"
                                        class="form-control @error('withdraw_fee') border-theme-6 @enderror"
                                        value="{{ old('withdraw_fee') }}" onKeyPress="return isNumberKey(event);" required>

                                    @error('withdraw_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-3 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="payout_fee" class="form-label sm:w-30">Payout Fee <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="payout_fee" name="payout_fee" type="text"
                                        class="form-control @error('payout_fee') border-theme-6 @enderror"
                                        value="{{ old('payout_fee') }}" onKeyPress="return isNumberKey(event);" required>

                                    @error('payout_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <a href="{{ route('dashboard.wallet.ledger.index') }}" class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary w-24">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Daily Sales -->

        </div>
    </div>
@endsection

