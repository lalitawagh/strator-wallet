@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Withdraw')

@section('content')

    <div class="grid grid-cols-12 gap-6 mb-3">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Withdraw
                    </h2>
                </div>
                <div class="p-5">
                    @if (Session::has('error'))
                        <span class="block text-theme-6">{{ Session::get('error') }}</span>
                    @endif
                    <form action="{{ route('dashboard.wallet.withdraw.store', ['workspace_id' => $workspace->getKey()]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="workspace_id" value="{{ $workspace->getKey() }}">
                        @livewire('wallet-withdraw-component', ['wallets' => $wallets, 'beneficiaries' => $beneficiaries, 'countryWithFlags' => $countryWithFlags, 'defaultCountry' => $defaultCountry, 'user' => $user, 'ledgers' => $ledgers, 'asset_types' => $asset_types, 'workspace' => $workspace])

                        <div class="text-right mt-5">
                            <button class="btn btn-primary w-24" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="withdrawbenificary-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg ihphone-scroll-height">
            <div class="modal-content">
                @livewire('withdraw-beneficiary', ['workspace' => $workspace, 'countryWithFlags' => $countryWithFlags, 'defaultCountry' => $defaultCountry])
            </div>
        </div>
    </div>
@endsection
