@extends("ledger-foundation::config-skeleton")

@section('title', 'Exchange Rate')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex gap-2 sm:gap-0 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg"
                            width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="breadcrumb--active">Create Exchange rate</a>
                    </div>
                </div>
                <div class="p-5">
                    @if (Session::has('error'))
                        <span class="block text-theme-6">{{ Session::get('error') }}</span>
                    @endif
                    <form action="{{ route('dashboard.wallet.exchange-rate.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="base_currency" class="form-label sm:w-30">Exchange From <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">

                                    <select name="base_currency" id="base_currency" class="tom-select form-control"
                                        data-search="true">
                                        @foreach ($ledgers as $ledger)
                                            <option value="{{ $ledger->getKey() }}">{{ $ledger->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('base_currency')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="exchange_currency" class="form-label sm:w-30">Exchange To <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    <select name="exchange_currency" id="exchange_currency" class="tom-select form-control"
                                        data-search="true">
                                        @foreach ($ledgers as $ledger)
                                            <option value="{{ $ledger->getKey() }}">{{ $ledger->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('exchange_currency')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="frequency" class="form-label sm:w-30">Frequency <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    @php
                                        $exchange_rate_frequencies = \Kanexy\LedgerFoundation\Enums\ExchangeRateFrequency::toArray();
                                    @endphp
                                    <select name="frequency" id="frequency" data-search="true"
                                        class="tom-select w-full @error('frequency') border-theme-6 @enderror">
                                        @foreach ($exchange_rate_frequencies as $exchange_rate_frequency)
                                            <option value="{{ $exchange_rate_frequency }}">
                                                {{ trans('ledger-foundation::configuration.' . $exchange_rate_frequency) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('frequency')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="exchange_rate" class="form-label sm:w-30">Exchange Rate <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="exchange_rate" name="exchange_rate" type="text"
                                        class="form-control @error('exchange_rate') border-theme-6 @enderror"
                                        value="{{ old('exchange_rate') }}" onKeyPress="return isNumberKey(event);"
                                        required>

                                    @error('exchange_rate')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="is_hard_stop" class="form-label sm:w-30">Hard Stop </label>
                                <div class="sm:w-5/6">
                                    <input id="is_hard_stop" name="is_hard_stop" type="checkbox" class="form-check-switch"
                                        onclick="toggleHardStop(this)" @if (!is_null(old('is_hard_stop'))) checked @endif>

                                    @error('is_hard_stop')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div
                                class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2 @if (!is_null(old('is_hard_stop'))) @else valid_date hidden @endif">
                                <label for="valid_date" class="form-label sm:w-30">Valid Date <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="valid_date" name="valid_date"
                                        class="form-control datepicker_flatpicker @error('valid_date') border-theme-6 @enderror"
                                        placeholder="DD-MM-YYYY" value="{{ old('valid_date') }}"
                                        data-min-date="{{ \Carbon\Carbon::now()->subYear(0)->format('Y-m-d') }}"
                                        data-single-mode="true">

                                    @error('valid_date')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="note" class="form-label sm:w-30"> Note <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input type="text" class="form-control" name="note" value="{{ old('note') }}"
                                        required>

                                    @error('note')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="text-right mt-5">
                            <a href="{{ route('dashboard.wallet.exchange-rate.index') }}"
                                class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary w-24">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
