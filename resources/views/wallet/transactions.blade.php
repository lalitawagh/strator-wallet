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
                        <div class="nav nav-tabs flex-col sm:flex-row grid grid-cols-12 gap-6 mt-5" role="tablist">
                            @foreach ($wallets as $key =>  $wallet)
                                @php
                                $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first();
                                @endphp

                                <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y w-full" id="k-wallet" data-toggle="tab" data-target="#k-wallet">
                                    <a id="{{ $key }}-tab" href="javascript:void(0);" onclick="Livewire.emit('transactionList', '{{ $wallet->getKey() }}', '{{ $ledger?->name }}')" data-toggle="tab"
                                        class="block px-3 py-2 mt-2 pb-5 font-medium @if($key == 0) active @php $first_wallet_id = $wallet->getKey(); @endphp @endif">
                                        <div class="report-box zoom-in">
                                            <div class="box p-5">
                                                <div class="flex">
                                                    <div class="text-2xl font-bold leading-8 mt-0">{{ $ledger?->name }}</div>
                                                    <div class="ml-auto">
                                                        <div class="flex mt-4 lg:mt-0 lg:w-12 lg:h-12 image-fit">
                                                            <img alt="" class="" src="@isset($ledger?->image){{ \Illuminate\Support\Facades\Storage::disk('azure')->url($ledger->image) }}@endisset">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="text-base text-gray-600 mt-1">{{ $wallet?->urn }}</div>

                                                <div class="flex mt-3">
                                                    <span class="@if ($wallet->status == \Kanexy\LedgerFoundation\Enums\WalletStatus::ACTIVE) text-theme-9 @else text-theme-6 @endif"> {{ trans('ledger-foundation::configuration.'.$wallet->status) }}</span>
                                                    <div class="ml-auto">
                                                        <div class="report-box__indicator bg-theme-6 cursor-pointer">
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
                                    </a>
                                    <div class="flex">
                                        <div class="ml-5 mt-1">
                                            <a href="?filter[workspace_id]={{ $workspace->id }}&wallet_id={{ $wallet->getKey() }}" class="underline">Transactions</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
    $(document).ready(function(){
        Livewire.emit('transactionList', '{{ $first_wallet_id ?? null }}');
    });
    </script>
    @endpush
@endif
