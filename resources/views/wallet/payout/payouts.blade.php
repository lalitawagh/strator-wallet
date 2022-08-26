@extends('ledger-foundation::layouts.master')

@if (request()->input('type') == trans('ledger-foundation::configuration.transfer'))
    @section('title', 'Wallet Transfer')
@else
    @section('title', 'Wallet Payout')
@endif

@section('content')
    <div class="grid grid-cols-12 gap-6 mb-3">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        @if (request()->input('type') == trans('ledger-foundation::configuration.transfer'))
                        Transfer
                        @else
                        Payouts
                        @endif
                    </h2>
                </div>
                <div class="p-5">
                    @if (Session::has('error'))
                    <span class="block text-theme-6">{{ Session::get('error') }}</span>
                    @endif
                    <form action="{{ route('dashboard.wallet.payout.store',['workspace_id' => $workspace->getKey()]) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="workspace_id" value="{{ $workspace->getKey() }}">
                        @livewire('wallet-payout-component',['wallets' => $wallets, 'beneficiaries' => $beneficiaries, 'countryWithFlags' => $countryWithFlags, 'defaultCountry' => $defaultCountry, 'user' => $user,'ledgers' => $ledgers, 'asset_types' => $asset_types])

                        <div class="text-right mt-5">
                            <button class="btn btn-primary w-24" type="submit">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="walletbenificary-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 @livewire('wallet-beneficiary',['workspace' => $workspace,'countryWithFlags' => $countryWithFlags, 'defaultCountry' => $defaultCountry, 'type' => request()->input('type')])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function formatStateTwo(state) {
            if (!state.id) {
                return state.text;
            }

            var $state = $(
                '<span ><img  src="' + state.element.getAttribute('data-source') + '" /> ' + state.text + '</span>'
            );
            return $state;
        }

        function getFlagImg(the) {
            var img = $('option:selected', the).attr('data-source');
            $('#countryWithPhoneFlagImg').html('<img src="' + img + '">');
        }
    </script>
@endpush
