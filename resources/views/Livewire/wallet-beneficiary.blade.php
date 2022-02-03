<div>
    <div class="modal-header py-2">
        <h2 class="font-medium text-base mr-auto">Beneficiary</h2>
        <h4 class="font-medium text-base">@isset($membership_urn) {{ @$membership_urn }} - {{ @$membership_name }} @endisset</h4>
    </div>

    <div class="modal-body">
        <div class="grid grid-cols-12 md:gap-0 mt-0">
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-28"> Name <span class="text-theme-6">*</span></label>
                <div class="sm:w-2/6 pr-2">
                    <input id="" type="text" class="form-control" placeholder="First Name" wire:model="first_name">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
                <div class="sm:w-2/6 pr-2">
                    <input id="" type="text" class="form-control" placeholder="Middle Name" wire:model="middle_name">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
                <div class="sm:w-2/6 pr-2">
                    <input id="" type="text" class="form-control" placeholder="Last Name" wire:model="last_name">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-28"> Email <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="email">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-28"> Mobile <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="mobile" wire:change="getMembershipDetails()" onKeyPress="if(this.value.length==11) return false;return onlyNumberKey(event);">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-28"> Notes </label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="notes">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-28"> Nick Name </label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" wire:model="nick_name">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
        </div>
        <div class="text-right mt-5">
            <button type="button" wire:click="createBeneficiary" class="btn btn-primary w-24">Send Otp</button>
        </div>
        @isset($beneficiary_created)
        <h2 class="font-medium text-base mr-auto mt-5">Verify Otp</h2>
        <div class="grid grid-cols-12 md:gap-0 mt-5">
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                <label for="" class="form-label sm:w-28"> Enter Otp <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" placeholder="Enter Otp"  wire:model="code">
                    @error('code') <span class="block text-theme-6 mt-2">{{ $message }}</span>@enderror
                    <a class="block text-theme-1 mt-2">Resend Otp </a>
                </div>
            </div>

        </div>
        <div class="text-right mt-5">
            <button type="button" wire:click="verifyOtp" class="btn btn-primary w-24">Confirm</button>
        </div>
        @endisset
    </div>
</div>
