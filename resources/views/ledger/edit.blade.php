@extends("ledger-foundation::config-skeleton")

@section("title", "Edit Ledger")

@section("config-content")
    <div class="configuration-container">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="breadcrumb--active"> Edit Ledger</a>
                    </div>
                </div>
                <div class="p-5">
                    <form action="{{ route('dashboard.wallet.ledger.update',$ledger->getKey()) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-28">Ledger Name <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') border-theme-6 @enderror"
                                        value="{{ old('name',$ledger->name) }}" required>

                                    @error('name')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="code" class="form-label sm:w-28">Code <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="code" name="code" type="text"
                                        class="form-control @error('code') border-theme-6 @enderror"
                                        value="{{ old('code',$ledger->code) }}" required>

                                    @error('code')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="ledger_type" class="form-label sm:w-28">Ledger Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $ledger_types = \Kanexy\LedgerFoundation\Enums\LedgerType::toArray();
                                    @endphp
                                    <select name="ledger_type" id="ledger_type" data-search="true" class="tail-select w-full @error('ledger_type') border-theme-6 @enderror">
                                        @foreach ($ledger_types as $key => $ledger_type)
                                            <option value="{{ $ledger_type }}" @if (old("ledger_type",$ledger->ledger_type) ==  $ledger_type) selected @endif>{{ trans('ledger-foundation::configuration.'.$ledger_type) }}</option>
                                        @endforeach
                                    </select>
                                    @error('ledger_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="symbol" class="form-label sm:w-28">Symbol</label>
                                <div class="sm:w-5/6">
                                    <input id="symbol" name="symbol" type="symbol"
                                        class="form-control @error('symbol') border-theme-6 @enderror"
                                        value="{{ old('symbol',$ledger->symbol) }}">

                                    @error('symbol')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_type" class="form-label sm:w-28">Exchange Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $exchange_types = \Kanexy\LedgerFoundation\Enums\ExchangeType::toArray();
                                    @endphp
                                    <select name="exchange_type" id="exchange_type"  data-search="true" class="tail-select w-full @error('exchange_type') border-theme-6 @enderror">
                                        @foreach ($exchange_types as $key => $exchange_type)
                                            <option value="{{ $exchange_type }}" @if (old("exchange_type",$ledger->exchange_type ) == $exchange_type) selected @endif>{{ trans('ledger-foundation::configuration.'.$exchange_type) }}</option>
                                        @endforeach
                                    </select>
                                    @error('exchange_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_rate" class="form-label sm:w-28">Exchange Rate <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="exchange_rate" name="exchange_rate" type="text"
                                        class="form-control @error('exchange_rate') border-theme-6 @enderror"
                                        value="{{ old('exchange_rate',$ledger->exchange_rate) }}"  onKeyPress="if(this.value.length==11) return false;" required>

                                    @error('exchange_rate')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_category" class="form-label sm:w-28">Asset Category <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $asset_categories = \Kanexy\LedgerFoundation\Enums\AssetCategory::toArray();
                                    @endphp
                                    <select name="asset_category" onchange="getAssetCategory(this)" id="asset_category" data-search="true" class="tail-select w-full @error('asset_category') border-theme-6 @enderror">
                                        @foreach ($asset_categories as $key => $asset_category)
                                            <option value="{{ $asset_category }}" @if (old('asset_category',$ledger->asset_category) == $asset_category) selected @endif>{{ trans('ledger-foundation::configuration.'.$asset_category) }}</option>
                                        @endforeach
                                    </select>
                                    @error('asset_category')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_from" class="form-label sm:w-28">Exchange From  <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php
                                        $exchange_from = \Kanexy\LedgerFoundation\Enums\ExchangeFrom::toArray();
                                    @endphp
                                    <select name="exchange_from" id="exchange_from" data-search="true" class="tail-select w-full @error('exchange_from') border-theme-6 @enderror">
                                        @foreach ($exchange_from as $key => $exchange_from_val)
                                            <option value="{{ $exchange_from_val }}" @if (old('exchange_from',$ledger->exchange_from) == $exchange_from_val) selected @endif>{{ trans('ledger-foundation::configuration.'.$exchange_from_val) }}</option>
                                        @endforeach
                                    </select>

                                    @error('exchange_from')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_type" class="form-label sm:w-28"> Asset Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="asset_type" id="asset_type" data-search="true" class="tail-select w-full @error('asset_type') border-theme-6 @enderror">
                                        @foreach ($asset_types as $asset_type)
                                            <option value="{{ $asset_type['id'] }}" @if (old('asset_type',$ledger->asset_type) == $asset_type['id']) selected @endif>{{ ucfirst($asset_type['name']) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_type')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="logo" class="form-label sm:w-28"> Logo <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input type="file" class="form-control" name="image">
                                    <img class="rounded-md proof-default" style="width:100px;" alt="" src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->url($ledger->image) }}">
                                    @error('image')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="asset_class" class="form-label sm:w-28"> Asset Class <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="asset_class" id="asset_class" data-search="true" class="tail-select w-full @error('asset_class') border-theme-6 @enderror">
                                        @foreach ($asset_classes as $asset_class)
                                            <option value=" {{ $asset_class['id'] }} " @if (old('asset_class',$ledger->asset_class) == $asset_class['id']) selected @endif>{{ ucfirst($asset_class['name']) }}</option>
                                        @endforeach
                                    </select>

                                    @error('asset_class')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="commodity_category" class="form-label sm:w-28"> Commodity Category <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="commodity_category" id="commodity_category" data-search="true" class="tail-select w-full @error('commodity_category') border-theme-6 @enderror">
                                        @foreach ($commodity_types as $commodity_type)
                                            <option value=" {{ $commodity_type['id'] }} " @if (old('commodity_category',$ledger->commodity_category) == $commodity_type['id']) selected @endif>{{ ucfirst($commodity_type['name']) }}</option>
                                        @endforeach
                                    </select>

                                    @error('commodity_category')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="deposit_fee" class="form-label sm:w-28">Deposit Fee <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="deposit_fee" name="deposit_fee" type="text"
                                        class="form-control @error('deposit_fee') border-theme-6 @enderror"
                                        value="{{ old('deposit_fee',$ledger->deposit_fee) }}" required>

                                    @error('deposit_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="withdraw_fee" class="form-label sm:w-28">Withdraw Fee <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="withdraw_fee" name="withdraw_fee" type="text"
                                        class="form-control @error('withdraw_fee') border-theme-6 @enderror"
                                        value="{{ old('withdraw_fee',$ledger->withdraw_fee) }}" required>

                                    @error('withdraw_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="payout_fee" class="form-label sm:w-28">Payout Fee <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="payout_fee" name="payout_fee" type="text"
                                        class="form-control @error('payout_fee') border-theme-6 @enderror"
                                        value="{{ old('payout_fee',$ledger->payout_fee) }}" required>

                                    @error('payout_fee')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-28"> Status <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">

                                    <select name="status" id="status" data-search="true" class="tail-select w-full">
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::NEW }}" @if (old("status",$ledger->status)  == \Kanexy\LedgerFoundation\Enums\LedgerStatus::NEW) selected @endif>{{ trans('ledger-foundation::configuration.new') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE }}" @if (old("status",$ledger->status)  == \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE) selected @endif>{{ trans('ledger-foundation::configuration.active') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::INACTIVE }}" @if (old("status",$ledger->status)  == \Kanexy\LedgerFoundation\Enums\LedgerStatus::INACTIVE) selected @endif>{{ trans('ledger-foundation::configuration.inactive') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::HOLD }}" @if (old("status",$ledger->status)  == \Kanexy\LedgerFoundation\Enums\LedgerStatus::HOLD) selected @endif>{{ trans('ledger-foundation::configuration.hold') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Enums\LedgerStatus::SUSPENDED }}" @if (old("status",$ledger->status)  == \Kanexy\LedgerFoundation\Enums\LedgerStatus::SUSPENDED) selected @endif>{{ trans('ledger-foundation::configuration.suspended') }}</option>
                                    </select>

                                    @error('status')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Daily Sales -->

        </div>
    </div>
@endsection
