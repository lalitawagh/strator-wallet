@extends("cms::dashboard.layouts.default")

@section("title", "Create Ledger")

@section("content")
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center py-2 px-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Create Ledger
                    </h2>
                </div>

                <div class="p-5">
                    <form action="{{ route('dashboard.ledger-foundation.ledger.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="name" class="form-label sm:w-28">Ledger Name <span class="text-theme-6">*</span></label>
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
                                <label for="code" class="form-label sm:w-28">Code <span class="text-theme-6">*</span></label>
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
                                <label for="ledger_type" class="form-label sm:w-28">Ledger Type <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php $ledger_types = \Kanexy\LedgerFoundation\Http\Enums\LedgerType::toArray(); @endphp
                                    <select name="ledger_type" id="ledger_type" data-search="true" class="tail-select w-full @error('ledger_type') border-theme-6 @enderror">
                                        @foreach($ledger_types as $key => $ledger_type)
                                            <option value="{{ $ledger_type }}">{{ trans('ledger-foundation::configuration.'.$ledger_type) }}</option>
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
                                        value="{{ old('symbol') }}">

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
                                    @php $exchange_types = \Kanexy\LedgerFoundation\Http\Enums\ExchangeType::toArray(); @endphp
                                    <select name="exchange_type" id="exchange_type"  data-search="true" class="tail-select w-full @error('exchange_type') border-theme-6 @enderror">
                                        @foreach($exchange_types as $key => $exchange_type)
                                            <option value="{{ $exchange_type }}">{{ trans('ledger-foundation::configuration.'.$exchange_type) }}</option>
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
                                        value="{{ old('exchange_rate') }}"  onKeyPress="if(this.value.length==11) return false;" required>

                                    @error('exchange_rate')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @livewire('ledger-config-field-component', ['asset_types' => $asset_types])

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="exchange_from" class="form-label sm:w-28">Exchange From  <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    @php $exchange_from = \Kanexy\LedgerFoundation\Http\Enums\ExchangeFrom::toArray(); @endphp
                                    <select name="exchange_from" id="exchange_from" data-search="true" class="tail-select w-full @error('exchange_from') border-theme-6 @enderror">
                                        @foreach($exchange_from as $key => $exchange_from_val)
                                            <option value="{{ $exchange_from_val }}" @if(old('exchange_from') == $exchange_from_val) selected @endif>{{ trans('ledger-foundation::configuration.'.$exchange_from_val) }}</option>
                                        @endforeach
                                    </select>

                                    @error('exchange_from')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="logo" class="form-label sm:w-28"> Logo </label>
                                <div class="sm:w-5/6">
                                    <input type="file" class="form-control" name="image">

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
                                            <option value="{{ $asset_class['id'] }}" @if(old('asset_class') == $asset_class['id']) selected @endif>{{ ucfirst($asset_class['name']) }}</option>
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
                                            <option value="{{ $commodity_type['id'] }}" @if(old('commodity_category') == $commodity_type['id']) selected @endif>{{ ucfirst($commodity_type['name']) }}</option>
                                        @endforeach
                                    </select>

                                    @error('image')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-6 form-inline mt-2">
                                <label for="status" class="form-label sm:w-28"> Status</label>
                                <div class="sm:w-5/6">
                                    <select name="status" id="status" data-search="true" class="tail-select w-full">
                                        <option value="{{ \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::NEW }}" @if(old("status")  === \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::NEW) checked @endif>{{ trans('ledger-foundation::configuration.new') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::ACTIVE }}" @if(old("status")  === \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::ACTIVE) checked @endif>{{ trans('ledger-foundation::configuration.active') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::INACTIVE }}" @if(old("status")  === \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::INACTIVE) checked @endif>{{ trans('ledger-foundation::configuration.inactive') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::HOLD }}" @if(old("status")  === \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::HOLD) checked @endif>{{ trans('ledger-foundation::configuration.hold') }}</option>
                                        <option value="{{ \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::SUSPENDED }}" @if(old("suspended")  === \Kanexy\LedgerFoundation\Http\Enums\LedgerStatus::SUSPENDED) checked @endif>{{ trans('ledger-foundation::configuration.suspended') }}</option>
                                    </select>
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

