@extends('ledger-foundation::config-skeleton')

@section('title', 'Edit Fee Setup')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div
                    class="flex gap-2 sm:gap-0 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

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
                        <a id="EditFee" href="" class="breadcrumb--active">Edit Fee Setup</a>
                    </div>
                </div>
                <div class="p-5">
                    @if (Session::has('error'))
                        <span class="block text-theme-6">{{ Session::get('error') }}</span>
                    @endif
                    <form action="{{ route('dashboard.wallet.fee.update', $fee['id']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-2">
                                <label for="base_currency" class="form-label sm:w-30">Exchange From <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">

                                    <select name="base_currency" id="base_currency" class="form-control" data-search="true">
                                        @foreach ($ledgers as $ledger)
                                            <option value="{{ $ledger->getKey() }}"
                                                @if (old('base_currency', $fee['base_currency']) == $ledger->getKey()) selected @endif>{{ $ledger->name }}
                                            </option>
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
                                    <select name="exchange_currency" id="exchange_currency" class="form-control"
                                        data-search="true">
                                        @foreach ($ledgers as $ledger)
                                            <option value="{{ $ledger->getKey() }}"
                                                @if (old('exchange_currency', $fee['exchange_currency']) == $ledger->getKey()) selected @endif>{{ $ledger->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('exchange_currency')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                            <div class="col-span-12 lg:col-span-12 xl:col-span-6 form-inline mt-2">
                                <label for="payment_type" class="form-label sm:w-30">Payment Type <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    <select class="form-control" data-search="true" name="payment_type">
                                        <option value="deposit" @if (old('payment_type', $fee['payment_type']) == 'deposit') selected @endif>Deposit
                                        </option>
                                        <option value="payout" @if (old('payment_type', $fee['payment_type']) == 'payout') selected @endif>Payout
                                        </option>
                                        <option value="withdraw" @if (old('payment_type', $fee['payment_type']) == 'withdraw') selected @endif>Withdraw
                                        </option>
                                    </select>

                                    @error('payment_type')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-8 xl:col-span-6 form-inline mt-0">
                                <label for="status" class="form-label sm:w-30"> Status </label>
                                <div class="sm:w-5/6 form-check form-switch">
                                    <input id="status" name="status" type="checkbox" class="form-check-input"
                                        @if (old('status', $fee['status']) === \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) checked @endif>

                                    @error('status')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0"
                            @if (old('fee_type', $fee['fee_type']) == 'amount') x-data="{ selected: '1' }" @elseif (old('fee_type', $fee['fee_type']) == 'percentage') x-data="{ selected: '0' }" @else x-data="{ selected: '3' }" @endif>
                            <div
                                class="items-center justify-center col-span-12 lg:col-span-12 xl:col-span-6 form-inline mt-2">
                                <label for="amount" class="form-label sm:w-30 fee-label">Fee <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 sm:pt-3">
                                    <div class="form-check mr-2">
                                        <input id="radio-switch-1" class="form-check-input" type="radio"
                                            x-on:click="selected = '1'" name="fee_type" value="amount"
                                            @if (old('fee_type', $fee['fee_type']) == 'amount') checked @endif>
                                        <label class="form-check-label" for="radio-switch-1">
                                            <h4 href="javascript:;" class="font-medium truncate mr-5 ">
                                                <h4>Amount</h4>
                                        </label>
                                        <input id="radio-switch-2" class="form-check-input ml-3" type="radio"
                                            x-on:click="selected = '0'" name="fee_type" value="percentage"
                                            @if (old('fee_type', $fee['fee_type']) == 'percentage') checked @endif>
                                        <label class="form-check-label" for="radio-switch-2">
                                            <h4 href="javascript:;" class="font-medium truncate mr-5">
                                                <h4>Percentage</h4>
                                        </label>
                                    </div>
                                    @error('fee_type')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 lg:col-span-12 xl:col-span-6 form-inline mt-2"
                                x-show="selected == '1'">
                                <label for="amount" class="form-label sm:w-30">Amount <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    <input id="amount" name="amount" type="text"
                                        class="form-control @error('amount') border-theme-6 @enderror amount"
                                        value="{{ old('amount', $fee['amount']) }}">

                                    @error('amount')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 lg:col-span-12 xl:col-span-6 form-inline mt-2"
                                x-show="selected == '0'">
                                <label for="percentage tillselect-marging" class="form-label sm:w-30">Percentage <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <div class="input-group">
                                        <input id="percentage" name="percentage" type="text"
                                            class="form-control @error('percentage') border-theme-6 @enderror percentage"
                                            value="{{ old('percentage', $fee['percentage']) }}">
                                        <div id="input-group-percentage" class="input-group-text">%</div>
                                    </div>

                                    @error('percentage')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <a id="feeSetupEditCancel" href="{{ route('dashboard.wallet.fee.index') }}"
                                class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button id="feeSetupUpdate" type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
