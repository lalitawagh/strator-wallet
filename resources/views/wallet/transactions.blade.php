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
.wallet-slide .active{
    --tw-border-opacity: 1;
    border-color: rgba(112, 41, 125, var(--tw-border-opacity));
    border-bottom-width: 2px;
    font-weight: 500;
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
                <div class="p-5">
                    @if (\Illuminate\Support\Facades\Auth::user()->isSubscriber() && is_null($walletID))
                        <div id="multiple-item-slider" class="wallet-slide preview" role="tablist">
                            <div class="mx-6">
                                <div class="multiple-items">
                                    @foreach ($wallets as $key =>  $wallet)
                                        @php
                                            $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first();
                                            if($key == 0){
                                                $first_wallet_id = $wallet->getKey();
                                            }
                                        @endphp
                                        <div class="px-2 col-span-12 sm:col-span-4 xl:col-span-4 flex">
                                            <div class="h-full bg-gray-200 dark:bg-dark-1 rounded-md">
                                                <h3 class="h-full font-medium flex items-center justify-center text-2xl">
                                                    <a id="{{ $key }}-tab" href="javascript:void(0);"
                                                    onclick="walletTabSelect('{{ $wallet->getKey() }}')" data-toggle="tab"
                                                    class="flex-1 items-center px-3 py-2 mt-2 pb-5 font-medium wallet-slide-tab @if($key == 0) active @endif">
                                                        <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y" id="k-wallet" data-toggle="tab" data-target="#k-wallet">
                                                            <div class="report-box zoom-in">
                                                                <div class="box p-5">
                                                                    <div class="flex">
                                                                        <div class="ml-auto">
                                                                            <div class="flex mt-4 lg:mt-0 lg:w-12 lg:h-12 image-fit">
                                                                                <img alt="" class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default" src="@isset($ledger?->image){{ \Illuminate\Support\Facades\Storage::disk('azure')->url($ledger->image) }}@endisset">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex mt-3">
                                                                        <span class="text-2xl font-bold leading-8 mt-0">{{ $ledger?->name }}</span>
                                                                        <div class="ml-auto">
                                                                            <div class="report-box__indicator bg-theme-1 cursor-pointer mt-5">
                                                                                <span class="px-3" onclick="window.location.href+='?filter[workspace_id]={{ $workspace->id }}&wallet_id={{ $wallet->getKey() }}'">Transactions</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-base text-gray-600 mt-1">{{ $wallet?->urn }}</span>
                                                                    </div>
                                                                    <div class="flex mt-3">
                                                                        <span class="text-lg @if ($wallet->status == \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) text-theme-9 @else text-theme-6 @endif"> {{ trans('ledger-foundation::configuration.'.$wallet->status) }}</span>
                                                                        <div class="ml-auto">
                                                                            <div class="report-box__indicator bg-theme-6 cursor-pointer mt-1">
                                                                                @if($ledger?->exchange_type == \Kanexy\LedgerFoundation\Enums\ExchangeType::FIAT)
                                                                                    {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($wallet?->balance, $ledger?->name) }}
                                                                                @else
                                                                                    {{$ledger?->symbol}}{{ $wallet?->balance }}
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
                                        </div>
                                    @endforeach
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

    @include('ledger-foundation::wallet.transaction-detail-modal')

@endsection
@if (\Illuminate\Support\Facades\Auth::user()->isSubscriber())
    @push('scripts')
    <script>
    function walletTabSelect(walletID){
        $('.wallet-slide-tab').removeClass('active');
        Livewire.emit('transactionList', walletID)
    }
    $(document).ready(function(){
        Livewire.emit('transactionList', '{{ $first_wallet_id ?? null }}');
    });
    </script>
    @endpush
@endif
