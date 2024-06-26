<div>
    <div class="flex flex-col sm:flex-row items-center p-4 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Beneficiary</h2>
        <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
            @isset($membership_urn)
                {{ @$membership_urn }} - {{ @$membership_name }}
            @endisset
        </div>
    </div>
    <div class="modal-body">
        <div class="grid grid-cols-12 md:gap-0 mt-0 ihphone-scroll-height-inr3">
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-48"> Name <span class="text-theme-6">*</span></label>
                <div class="sm:w-2/6 pr-2 mb-2 sm:mb-0">
                    <input id="" type="text" class="form-control" placeholder="First Name"
                        wire:model="first_name">
                    @error('first_name')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="sm:w-2/6 pr-2 mb-2 sm:mb-0">
                    <input id="" type="text" class="form-control" placeholder="Middle Name"
                        wire:model="middle_name">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
                <div class="sm:w-2/6 pr-2 mb-2 sm:mb-0">
                    <input id="" type="text" class="form-control" placeholder="Last Name"
                        wire:model="last_name">
                    @error('last_name')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="" class="form-label sm:w-32"> Account Name <span
                        class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="account_name">
                    @error('account_name')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="" class="form-label sm:w-32"> Account Number <span
                        class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="account_number">
                    @error('account_number')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="" class="form-label sm:w-32"> Sort Code <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="sort_code">
                    @error('sort_code')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="" class="form-label sm:w-32"> Email </label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="email">
                    @error('email')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="phone" class="form-label sm:w-32"> Mobile </label>
                <div class="sm:w-5/6">
                    <div class="input-group flex flex-col sm:flex-row mt-0">
                        <div id="input-group-phone" wire:ignore class="input-group-text flex form-inline"
                            style="padding: 0 5px;">

                            <span id="countryWithPhoneFlagImgWallet"
                                style="display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        align-self: center;margin-right:10px;">
                                @foreach ($countryWithFlags as $country)
                                    @if ($country->id == old('country_code', $user->country_id))
                                        <img src="{{ $country->flag }}">
                                    @endif
                                @endforeach
                            </span>

                            <select id="countryWithPhone" wire:change="changeCountryCode($event.target.value)"
                                name="country_code" onchange="getFlagImgWallet(this)" data-search="true"
                                class="form-control w-full">
                                @foreach ($countryWithFlags as $country)
                                    <option data-source="{{ $country->flag }}" value="{{ $country->id }}"
                                        @if ($country->id == old('country_code', $user->country_id)) selected @endif>
                                        {{ $country->code }} ({{ $country->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input wire:model="mobile" wire:change="getMembershipDetails()" id="mobile" name="mobile"
                            value="{{ old('mobile') }}" type="number"
                            class="form-control @error('phone') border-theme-6 @enderror"
                            onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);">

                    </div>
                    @error('country_code')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror

                    @error('mobile')
                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="" class="form-label sm:w-32"> Notes </label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="notes">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
        </div>
        @error('beneficiary')
            <span class="block text-theme-6 mt-2">{{ $message }}</span>
        @enderror
        <div class="text-right mt-5">
            <button id="WithdrawCreateBeneficiary" type="button" wire:click="createBeneficiary"
                class="btn btn-primary w-24">Create</button>
        </div>
    </div>
</div>

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

        function getFlagImgWallet(the) {
            var img = $('option:selected', the).attr('data-source');
            $('#countryWithPhoneFlagImgWallet').html('<img src="' + img + '">');
        }
    </script>
@endpush
