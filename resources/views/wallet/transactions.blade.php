@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Transactions')

@push('styles')
    <style>
        .col-sm-12.col-md-6 {
            float: left;
            width: 50%;
        }

        .short-icon svg {
            color: #959aa3;
        }

        thead.short-wrp th {
            position: relative;
        }

        .wallet-slide .active {
            --tw-border-opacity: 1;
            border-color: rgb(var(--color-primary) / var(--tw-bg-opacity));
            border-bottom-width: 2px;
            font-weight: 500;
        }

        #multiple-item-slider button {
            display: block;
            top: -50px;
        }
    </style>
@endpush

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Transactions
                    </h2>
                </div>
                <div class="p-3 sm:p-5">
                    <div id="before-slider-loader" class="z-50 static w-full">
                        <img src="https://paladins-draft.com/img/circle_loading.gif" width="64" height="64"
                            class="m-auto mt-1/4 m-20">
                        <p class="text-center font-medium">Loading Transactions</p>
                    </div>
                    <div id="after-slider-loader" style="display:none;">
                        @if (\Illuminate\Support\Facades\Auth::user()->isSubscriber() && is_null($walletID))
                            <div id="multiple-item-slider" class="wallet-slide preview pb-5" role="tablist">
                                <div class="preview">
                                    <div class="mx-6">
                                        <div class="multiple-items">
                                            @foreach ($wallets as $key => $wallet)
                                                @php
                                                    $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first();
                                                    if ($key == 0) {
                                                        $first_wallet_id = $wallet->getKey();
                                                    }
                                                @endphp

                                                <div class="h-60 px-2" style="">
                                                    <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                                        <div
                                                            class="h-full font-medium items-center justify-center text-2xl">
                                                            <div id="{{ $key }}-tab" href="javascript:void(0);"
                                                                onclick="walletTabSelect('{{ $wallet->getKey() }}','{{ $key }}')"
                                                                data-tw-toggle="tab"
                                                                class="flex-1 items-center px-3 py-2 mt-2 pb-5 font-medium wallet-slide-tab @if ($key == 0) active @endif {{ $key }}-tab">
                                                                <div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y p-3"
                                                                    id="k-wallet" data-tw-toggle="tab"
                                                                    data-tw-target="#k-wallet">
                                                                    <div class="report-box zoom-in">
                                                                        <div class="box p-5">
                                                                            <div class="flex">
                                                                                <span
                                                                                    class="text-lg font-medium truncate mr-5font-bold leading-8 mt-0 align-self item-center">
                                                                                    @isset($ledger)
                                                                                        {{ $ledger?->name }}
                                                                                    @else
                                                                                        USTD
                                                                                    @endisset
                                                                                </span>
                                                                                <div class="ml-auto">
                                                                                    <div
                                                                                        class="flex sm:mt-4 lg:mt-0 lg:w-12 lg:h-12 image-fit">
                                                                                        <img alt=""
                                                                                            class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default"
                                                                                            src="@isset($ledger?->image) {{ \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($ledger->image, now()->addMinutes(5)) }} @endisset">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="text-base text-gray-600 mt-1">
                                                                                {{ $wallet?->urn }}</span>
                                                                            </div>
                                                                            @if (!isset($ledger) && isset($wallet?->meta['publicKey']))
                                                                                <div
                                                                                    class="text-sm mt-1  overflow-x-hidden overflow-y-auto h-20">
                                                                                    <p class="break-all mb-2">
                                                                                        Public Key
                                                                                        {{ $wallet?->meta['publicKey'] }}</span>
                                                                                    </p>
                                                                                    <p class="break-all mb-2">
                                                                                        Secret Key
                                                                                        {{ $wallet?->meta['secretKey'] }}</span>
                                                                                    </p>
                                                                                </div>
                                                                            @endif
                                                                            <div class="flex mt-3">
                                                                                <span
                                                                                    class="text-lg @if ($wallet->status == \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) text-success @else text-theme-6 @endif">
                                                                                    {{ trans('ledger-foundation::configuration.' . $wallet->status) }}</span>
                                                                                <div class="ml-auto">
                                                                                    <div
                                                                                        class="report-box__indicator bg-theme-1 cursor-pointer mt-1">
                                                                                        <span class="px-3"
                                                                                            onclick="window.location.href+='?filter[workspace_id]={{ $workspace->id }}&wallet_id={{ $wallet->getKey() }}'">Transactions</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ml-auto">
                                                                                    <div
                                                                                        class="report-box__indicator bg-theme-6 cursor-pointer mt-1">
                                                                                        @if ($ledger?->exchange_type == \Kanexy\LedgerFoundation\Enums\ExchangeType::FIAT)
                                                                                            {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($wallet?->balance, $ledger?->name) }}
                                                                                        @else
                                                                                            {{ $ledger?->symbol }}
                                                                                            {{ $wallet?->balance }}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- <div class="px-2 col-span-12 sm:col-span-4 xl:col-span-4 flex">
                                                    <div
                                                        class="short-wrp dark:bg-darkmode-400 dark:border-darkmode-400 h-full bg-gray-200 dark:bg-dark-1 rounded-md">
                                                        <h3
                                                            class="h-full font-medium flex items-center justify-center text-2xl">
                                                            <a id="{{ $key }}-tab" href="javascript:void(0);"
                                                                onclick="walletTabSelect('{{ $wallet->getKey() }}')"
                                                                data-tw-toggle="tab"
                                                                class="flex-1 items-center px-3 py-2 mt-2 pb-5 font-medium wallet-slide-tab @if ($key == 0) active @endif">
                                                                <div class="col-span-12 sm:col-span-12 xl:col-span-4 intro-y"
                                                                    id="k-wallet" data-tw-toggle="tab"
                                                                    data-tw-target="#k-wallet">
                                                                    <div class="report-box zoom-in">
                                                                        <div class="box p-5">
                                                                            <div class="flex">
                                                                                <span
                                                                                    class="text-lg font-medium truncate mr-5font-bold leading-8 mt-0 align-self item-center">
                                                                                    @isset($ledger)
                                                                                        {{ $ledger?->name }}
                                                                                    @else
                                                                                        USTD
                                                                                    @endisset
                                                                                </span>
                                                                                <div class="ml-auto">
                                                                                    <div
                                                                                        class="flex sm:mt-4 lg:mt-0 lg:w-12 lg:h-12 image-fit">
                                                                                        <img alt=""
                                                                                            class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default"
                                                                                            src="@isset($ledger?->image) {{ \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($ledger->image, now()->addMinutes(5)) }} @endisset">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="text-base text-gray-600 mt-1">
                                                                                {{ $wallet?->urn }}</span>
                                                                            </div>
                                                                            @if (!isset($ledger) && isset($wallet?->meta['publicKey']))
                                                                                <div class="text-sm mt-1">
                                                                                    <p>
                                                                                        Public Key
                                                                                        {{ $wallet?->meta['publicKey'] }}</span>
                                                                                    </p>
                                                                                    <p>
                                                                                        Secret Key
                                                                                        {{ $wallet?->meta['secretKey'] }}</span>
                                                                                    </p>
                                                                                </div>
                                                                            @endif
                                                                            <div class="flex mt-3">
                                                                                <span
                                                                                    class="text-lg @if ($wallet->status == \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) text-success @else text-theme-6 @endif">
                                                                                    {{ trans('ledger-foundation::configuration.' . $wallet->status) }}</span>
                                                                                <div class="ml-auto">
                                                                                    <div
                                                                                        class="report-box__indicator bg-theme-1 cursor-pointer mt-1">
                                                                                        <span class="px-3"
                                                                                            onclick="window.location.href+='?filter[workspace_id]={{ $workspace->id }}&wallet_id={{ $wallet->getKey() }}'">Transactions</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="ml-auto">
                                                                                    <div
                                                                                        class="report-box__indicator bg-theme-6 cursor-pointer mt-1">
                                                                                        @if ($ledger?->exchange_type == \Kanexy\LedgerFoundation\Enums\ExchangeType::FIAT)
                                                                                            {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($wallet?->balance, $ledger?->name) }}
                                                                                        @else
                                                                                            {{ $ledger?->symbol }}
                                                                                            {{ $wallet?->balance }}
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div> --}}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @livewire('wallet-transactions-list-component')
                        @else
                            @include('ledger-foundation::wallet.list-transactions')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('ledger-foundation::wallet.transaction-detail-modal')

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#before-slider-loader").remove();
            $("#after-slider-loader").show();
        });
    </script>
@endpush
@if (\Illuminate\Support\Facades\Auth::user()->isSubscriber())
    @push('scripts')
        <script>
            function walletTabSelect(walletID, key) {
                $('.wallet-slide-tab').removeClass('active');
                // console.log('#' + key + '-tab');
                $('.' + key + '-tab').addClass('active');
                Livewire.emit('transactionList', walletID)
            }
            $(document).ready(function() {
                Livewire.emit('transactionList', '{{ $first_wallet_id ?? null }}');
            });
        </script>
    @endpush
@endif
