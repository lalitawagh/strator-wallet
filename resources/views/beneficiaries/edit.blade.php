@extends('cms::dashboard.layouts.default')

@section('title', 'Edit Wallet Beneficiary')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center py-2 px-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Edit Wallet Beneficiary
                    </h2>
                </div>

                <div class="p-5">
                    <form action="{{ route('dashboard.wallet.beneficiaries.update', $beneficiary->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-12 md:gap-0 mt-0 ihphone-scroll-height-inr3">
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 sm:col-span-12 form-inline mt-2">
                                <label for="" class="form-label sm:w-30"> Name <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 flex">
                                    <div class="pr-2 mb-2 sm:mb-0">
                                        <input id="" type="text" name="first_name" class="form-control"
                                            value="{{ $beneficiary?->first_name }}" placeholder="First Name">
                                        @error('first_name')
                                            <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="pr-2 mb-2 sm:mb-0">
                                        <input id="" type="text" name="middle_name"
                                            value="{{ $beneficiary?->middle_name }}" class="form-control"
                                            placeholder="Middle Name">
                                        <span class="block text-theme-6 mt-2"></span>
                                    </div>
                                    <div class="pr-2 mb-2 sm:mb-0">
                                        <input id="" type="text" name="last_name" class="form-control"
                                            value="{{ $beneficiary?->last_name }}" placeholder="Last Name">
                                        @error('last_name')
                                            <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="phone" class="form-label sm:w-30"> Mobile <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6 tillselect-marging">
                                    <div class="input-group flex flex-col sm:flex-row mb-2 mt-0">
                                        <div id="input-group-phone" class="input-group-text flex form-inline"
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

                                            <select id="countryWithPhone" name="country_code"
                                                onchange="getFlagImgWallet(this)" data-search="true" class="form-control">
                                                @foreach ($countryWithFlags as $country)
                                                    <option data-source="{{ $country->flag }}" value="{{ $country->id }}"
                                                        @if ($country->id == old('country_code', $user->country_id)) selected @endif>
                                                        {{ $country->code }} ({{ $country->phone }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input id="mobile" name="mobile" value="{{ $beneficiary?->mobile }}"
                                            type="number" class="form-control @error('phone') border-theme-6 @enderror"
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
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2 mb-2 sm:mb-0 sm:mt-0">
                                <label for="" class="form-label sm:w-30"> Email </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" name="email" value="{{ $beneficiary?->email }}"
                                        class="form-control">
                                    @error('email')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                                <label for="" class="form-label sm:w-30"> Notes </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" name="notes" value="{{ $beneficiary?->notes }}"
                                        class="form-control">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 sm:col-span-12 form-inline mt-2">
                                <label for="" class="form-label sm:w-30"> Nick Name </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" name="nick_name"
                                        value="{{ $beneficiary?->nick_name }}" class="form-control">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5 sm:mr-2">
                            <a id="BeneficiaryEditeCancel"
                                href="{{ route('dashboard.wallet.beneficiaries.index', ['filter' => ['workspace_id' => $beneficiary->workspace_id]]) }}"
                                class="btn btn-secondary w-24 inline-block mr-1">Cancel</a>
                            <button id="BeneficiaryUpdate" type="submit" class="btn btn-primary w-24">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function contactTypeChange(val) {
            if (val == "{{ \Kanexy\PartnerFoundation\Cxrm\Enums\ContactType::COMPANY }}") {
                $(".contact-company").removeClass('hidden hiddenform');
                $(".contact-company").addClass('visible');
                $(".contact-company #company_name").attr('required', 'required');
                $("#first_name, #middle_name, #last_name").val('');

                $(".contact-personal").removeClass('visible');
                $(".contact-personal").addClass('hidden hiddenform');
                $(".contact-personal #first_name, #last_name").removeAttr('required');
            } else {
                $(".contact-company").removeClass('visible');
                $(".contact-company").addClass('hidden hiddenform');
                $(".contact-company #company_name").removeAttr('required');



                $(".contact-personal").removeClass('hidden hiddenform');
                $(".contact-personal").addClass('visible');
                $(".contact-personal #first_name, #last_name").attr('required', 'required');
                $(".contact-personal #middle_name").removeAttr('required');
                $(".contact-personal #email").removeAttr('required');
                $("#company_name").val('');
            }
        }
        $(".contact-type").each(function() {
            if ($(this).is(':checked')) {
                contactTypeChange($(this).val());
            }
        });

        $(".contact-type").click(function() {
            contactTypeChange($(this).val());
        });
    </script>
@endpush
