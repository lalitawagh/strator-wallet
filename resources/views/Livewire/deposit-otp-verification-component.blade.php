<div>
    @if ($sent_resend_otp == true)
        <h4 class="text-success mt-1">OTP Resend Success</h4>
    @else
        <h3 class="text-success">OTP is sent to your registered mobile number. Please enter.</h3>
    @endif
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="amount" class="form-label sm:w-40"> Mobile <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6 tillselect-marging">
            <div class="input-group flex flex-col sm:flex-row">
                <div id="input-group-phone" wire:ignore class="input-group-text flex form-inline"
                    style="padding: 0 5px;">

                    <span id="countryWithPhoneFlagImg" style="display: flex;
                                justify-content: center;
                                align-items: center;
                                align-self: center;margin-right:10px;">
                        @foreach ($countryWithFlags as $country)
                            @if ($country->id == old('country_code', $user->country_id))
                                <img src="{{ $country->flag }}">
                            @endif
                        @endforeach
                    </span>

                    <select id="countryWithPhone" name="country_code" onchange="getFlagImg(this)" data-search="true" class="w-full" >
                        @foreach ($countryWithFlags as $country)
                            <option data-source="{{ $country->flag }}" value="{{ $country->id }}"
                                @if ($country->id == old('country_code', $user->country_id)) selected @endif>
                                {{ $country->code }} ({{ $country->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <input id="phone" name="phone" value="{{ old('phone', $user?->phone) }}" type="number"
                    class="form-control @error('phone') border-theme-6 @enderror"
                    onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);" disabled>

            </div>

        </div>
    </div>
    <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
        <label for="code" class="form-label sm:w-40"> OTP <span class="text-theme-6">*</span></label>
        <div class="sm:w-5/6">
            <input id="code" type="text" wire:model="code" class="form-control" name="code"
                value="{{ old('otp') }}" required onKeyPress="return isNumberKey(event);">
            @error('code')
                <span class="block text-theme-6 mt-2">{{ $message }}</span>
            @enderror
            <a wire:click="resendOtp({{ $oneTimePassword }})" class="block active-clr mt-2"
                style="cursor: pointer;">Resend OTP </a>
        </div>
    </div>
    <div class="text-right mt-5">
        <button type="button" wire:click="verifyOtp()" class="btn btn-primary w-24">Next</button>
    </div>
</div>


@push('styles')
<style>
[x-cloak] { display: none; }
</style>
@endpush
<div>
    <div class="col-span-5">
        <div class="intro-y col-span-12 lg:col-span-8 xxl:col-span-9">
            <div class="tab-content">
                <div id="chats" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                    <div class="pr-1">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <div class="intro-y box mt-0">
                                <div class="flex sm:flex-row items-center p-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base">Mobile Verification</h2>
                                    <!-- BEGIN: Custom Tooltip Content -->
                                    <span class="lock-amount tooltip ml-auto" data-theme="light"
                                        data-tooltip-content="#custom-content-tooltip" data-trigger="click"
                                        title="This is awesome tooltip example!">
                                        <i data-lucide="info" class="block mx-auto"></i>
                                    </span>
                                    <div class="tooltip-content">
                                        <div id="custom-content-tooltip" class="relative flex items-center py-1">
                                            <div class="ml-4 mr-auto">
                                                <div class="text-gray-600">
                                                    Please enter six digits OTP received on mobile number to continue
                                                    your registration.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="horizontal-form" class="p-5" x-data="{ show: @if (old('phone')) true @else false @endif }">
                                    <div class="p-3 mt-3 text-center">
                                        {{-- <div class="w-20 flex-none image-fit rounded-full overflow-hidden mx-auto">
                                        <i data-lucide="smartphone" class="block mx-auto"></i>
                                        </div> --}}
                                        <div class="text-center mt-3">
                                            <div class="font-medium text-lg">Hello, {{ auth()->user()->first_name }}</div>
                                            <div class="text-gray-600 mt-1">Welcome, You are few minutes away from joining us.</div>
                                        </div>
                                        <form action="{{ route('customer.signup.changeMobileNumber') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method("post")
                                            <div class="bg-white py-3 rounded text-center mt-5">
                                                <h1 class="text-2xl font-bold">OTP Verification</h1>
                                                <div class="w-full mx-auto mt-4">
                                                    <div class="flex items-baseline sm:w-6/12 mx-auto">
                                                        <div class="pos__ticket__item-name w-full mt-3" x-cloak>
                                                            <span class="font-normal text-2xl"
                                                                x-show="!show">{{ auth()->user()->getPhoneWithCountryCode() }}
                                                            </span>
    
                                                            <div x-show="show">
                                                                <span>Enter new mobile number to get new OTP</span>
                                                                <div class="w-full pb-3">
                                                                    <div class="input-group mt-2">
                                                                        <input type="number" class="form-control" id="phone"
                                                                            name="phone"
                                                                            onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);">
                                                                        <span class="block text-center text-theme-6 mt-2"
                                                                            id="mobile_error"></span>
    
                                                                        <div id="input-group-price" class="input-group-text"
                                                                            style="padding: 0;">
                                                                            <button type="submit"
                                                                                class="btn btn-elevated-primary mt-0 w-32">
                                                                                Update Number
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    @error('phone')
                                                                        <span
                                                                            class="block text-theme-6 mt-2">{{ $message }}</span>
                                                                    @enderror
    
                                                                </div>
                                                            </div>
                                                            <button class="ml-0" @click="show = !show"
                                                                :aria-expanded="show ? 'true' : 'false'"
                                                                :class="{ 'active': show }" type="button">
                                                                <i data-lucide="edit" class="block mx-auto"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                        </form>
                                    </div>
                                    <div class="p-3 mt-3">
                                        <form action="{{ route('customer.signup.mobileOtpVerification') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method("post")
                                            <div id="otp" class="flex flex-row justify-center text-center px-2 mt-5"
                                                x-show="!show">
                                                <input
                                                    class="p-0 m-1 border border-2 border-theme-1 dark:border-theme-1 h-8 w-8 text-center form-control rounded"
                                                    type="number" id="first" maxlength="1"  onkeypress="preventNonNumericalInput(event)"  />
                                                <input
                                                    class="p-0 m-1 border border-2 border-theme-1 dark:border-theme-1 h-8 w-8 text-center form-control rounded"
                                                    type="number" id="second" maxlength="1" onkeypress="preventNonNumericalInput(event)"  />
                                                <input
                                                    class="p-0 m-1 border border-2 border-theme-1 dark:border-theme-1 h-8 w-8 text-center form-control rounded"
                                                    type="number" id="third" maxlength="1" onkeypress="preventNonNumericalInput(event)"  />
                                                <input
                                                    class="p-0 m-1 border border-2 border-theme-1 dark:border-theme-1 h-8 w-8 text-center form-control rounded"
                                                    type="number" id="fourth" maxlength="1" onkeypress="preventNonNumericalInput(event)"  />
                                                <input
                                                    class="p-0 m-1 border border-2 border-theme-1 dark:border-theme-1 h-8 w-8 text-center form-control rounded"
                                                    type="number" id="fifth" maxlength="1" onkeypress="preventNonNumericalInput(event)"  />
                                                <input
                                                    class="p-0 m-1 border border-2 border-theme-1 dark:border-theme-1 h-8 w-8 text-center form-control rounded"
                                                    type="number" id="sixth" maxlength="1" onkeypress="preventNonNumericalInput(event)"  />
                                                <input type="hidden" name="code">
                                            </div>
    
                                            @error('code')
                                                <span class="block text-center text-theme-6 mt-2">{{ $message }}</span>
                                            @enderror
                                            <div class="flex justify-center text-center mt-5" x-show="!show">
                                                <a onclick="mobileresendotp()"
                                                    class="flex items-center text-blue-700 hover:text-blue-900 cursor-pointer"><span
                                                        class="font-bold resendOtp">Resend OTP</span><i
                                                        class='bx bx-caret-right ml-1'></i></a>
    
                                            </div>
    
                                            <span x-show="!show" class="block text-center text-theme-1 mt-2"
                                                id="resendotp"></span>
    
                                            <div class="flex mt-3">
                                                <div class="w-full px-2">
                                                    <div class="form-inline float-right">
                                                        <button type="submit" class="btn btn-elevated-primary w-24 mr-1">
                                                            Continue
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var otp = '';

        function OTPInput() {
            const inputs = document.querySelectorAll('#otp > *[id]');

            for (let i = 0; i < inputs.length; i++) {

                inputs[i].addEventListener('keyup', function(event) {

                    $("input[name='code']").val($("#first").val() + $("#second").val() + $("#third")
                        .val() + $("#fourth").val() + $("#fifth").val() + $("#sixth").val());
                    if (event.key === "Backspace") {
                        inputs[i].value = '';
                        if (i !== 0) inputs[i - 1].focus();
                    } else {

                        if (i === inputs.length - 1 && inputs[i].value !== '') {
                            return true;
                        } else if (event.keyCode > 47 && event.keyCode < 58) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1) inputs[i + 1].focus();
                            event.preventDefault();
                        } else if (event.keyCode > 95 && event.keyCode < 106) {
                            inputs[i].value = event.key;
                            if (i !== inputs.length - 1) inputs[i + 1].focus();

                            event.preventDefault();
                        }
                    }

                });
            }
        }
        OTPInput();
    });


    function mobileresendotp() {
        $(".resendOtp").html('Sending....');
        $(".resendOtp").addClass("OtpSend");
        $(".resendOtp").removeClass("resendOtp");

        $.ajax({
            url: "{{ route('customer.signup.resendMobileOtp') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);
                if (response.status == 'success') {
                    $("#resendotp").html(response.message);
                    $(".OtpSend").html('Resend OTP');
                    $(".OtpSend").addClass("resendOtp");
                    $(".OtpSend").removeClass("OtpSend");

                }


            },
        });
    }

    function preventNonNumericalInput(e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);

        if (!charStr.match(/^[0-9]+$/))
            e.preventDefault();
    }
</script>
@endpush
