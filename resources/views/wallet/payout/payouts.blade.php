@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Payout')

@section('content')
    <div class="grid grid-cols-12 gap-6 mb-3">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Payout
                    </h2>
                </div>
                <div class="p-5">
                    @if (Session::has('error'))
                    <span class="block text-theme-6">{{ Session::get('error') }}</span>
                    @endif
                    <form action="{{ route('dashboard.wallet.payout.store',['workspace_id' => $workspace->getKey()]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="workspace_id" value="{{ $workspace->getKey() }}">
                        @livewire('wallet-payout-component',['wallets' => $wallets, 'beneficiaries' => $beneficiaries, 'countryWithFlags' => $countryWithFlags, 'defaultCountry' => $defaultCountry, 'user' => $user])
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6  sm:col-span-6 form-inline mt-2">
                                <label for="receiver_currency" class="form-label sm:w-30"> Receiver Currency <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="receiver_currency" id="receiver_currency" class="form-control" data-search="true" required>
                                        @foreach ($ledgers as $ledger)
                                            <option value="{{ $ledger->getKey() }}" @if(old('receiver_currency') == $ledger->getKey()) selected @endif>{{ $ledger->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('receiver_currency')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6  form-inline mt-2">
                                <label for="reference" class="form-label sm:w-30"> Reference <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="reference" name="reference" type="text" class="form-control" value="{{ old('reference') }}" required>
                                    @error('reference')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-3">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2"
                                style="align-items: center;">
                                <label for="note" class="form-label sm:w-30"> Note </label>
                                <div class="sm:w-5/6">
                                    <input id="note" name="note" type="text" class="form-control" value="{{ old('note') }}" >
                                    @error('note')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-2">
                                <label for="attachment" class="form-label sm:w-30"> Attachment </label>
                                <div class="sm:w-5/6">
                                    <input id="attachment" name="attachment" type="file" class="form-control w-full">
                                    @error('attachment')
                                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
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
                 @livewire('wallet-beneficiary',['workspace' => $workspace])
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
