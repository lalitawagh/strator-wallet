@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Payout')

@section('content')
    <div class="grid grid-cols-12 gap-6 mb-3">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Wallet Payout
                    </h2>
                    {{-- <div>
                        <a class="btn btn-sm btn-primary shadow-md" data-toggle="modal"
                            data-target="#WalletPayout-modal">Payout</a>
                    </div> --}}
                </div>
                <!--S Payout list-->
                <div class="p-5">
                    <form action="" method="">
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Wallet <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1"
                                        name="currency" required>

                                        <option>Paypal</option>
                                        <option>Stripe</option>
                                        <option>Bank</option>
                                    </select>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Balance </label>
                                <div class="sm:w-5/6">
                                    <input id="" disabled type="text" class="form-control" value=""
                                        placeholder="£ 1,320.00">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0 relative">
                                <label for="" class="form-label sm:w-30"> Beneficiary <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1"
                                        name="currency">
                                        <option>John Smith</option>

                                    </select>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                                <a data-toggle="modal" data-target="#walletbenificary-modal"
                                    class="absolute top-0 right-0 plus"
                                    style="cursor: pointer;right: -18px;top: 0;margin-top: 20px;">
                                    <i data-feather="plus-circle" class="w-4 h-4 ml-4"></i>
                                </a>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0">
                                <label for="phone" class="form-label sm:w-30"> Mobile </label>
                                <div class="sm:w-5/6">
                                    <div class="input-group flex flex-col sm:flex-row">
                                        <div id="input-group-phone" class="input-group-text flex form-inline"
                                            style="padding: 0 5px;">

                                            <span id="countryWithPhoneFlagImg" style="display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        align-self: center;margin-right:10px;">
                                                @foreach ($countryWithFlags as $country)
                                                    @if ($country->id == old('country_code', $defaultCountry->id))
                                                        <img src="{{ $country->flag }}">
                                                    @endif
                                                @endforeach
                                            </span>

                                            <select id="countryWithPhone" name="country_code"
                                                onchange="getFlagImg(this)" data-search="true"
                                                class="tail-select" style="width:30%">
                                                @foreach ($countryWithFlags as $country)
                                                    <option data-source="{{ $country->flag }}"
                                                        value="{{ $country->id }}" @if ($country->id == old('country_code', $defaultCountry->id)) selected @endif>
                                                        {{ $country->name }} ({{ $country->phone }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input id="phone" name="phone" value="{{ old('phone',$user?->phone) }}"
                                            type="number"
                                            class="form-control @error('phone') border-theme-6 @enderror"
                                            onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);">

                                    </div>
                                    @error('country_code')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror

                                    @error('phone')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Amount to Pay <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="" required>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Remaining </label>
                                <div class="sm:w-5/6">
                                    <input id="" disabled type="text" class="form-control" value=""
                                        placeholder="£ 120.00">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6  sm:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Receiver Currency <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select name="currecny" id="currecny" class="tail-select" required>
                                        <option value="GBP">GBP</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6  form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Reference <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="" required>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0"
                                style="align-items: center;">
                                <label for="" class="form-label sm:w-30"> Note </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 sm:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-30"> Attachment </label>
                                <div class="sm:w-5/6">
                                    <input id="" name="" type="file" class="form-control w-full " placeholder="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-right mt-5">
                        <a data-toggle="modal" data-target="#wsave-preview-modal" class="btn btn-primary w-24">Save</a>
                    </div>
                </div>

                <!--E payout list-->

            </div>
        </div>
    </div>

    <div id="walletbenificary-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 @livewire('wallet-beneficiary')
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
