<div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="wallet" class="form-label sm:w-30"> Withdraw From <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6 tillselect-marging" wire:ignore>
                <select wire:change="getWalletBalance($event.target.value)" name="sender_wallet_account_id" id="wallet"
                    class="form-control" data-search="true" required>
                    <option value="">Select Withdraw From</option>
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->getKey() }}" @if ($selected_wallet == $wallet->getKey()) selected @endif>
                            {{ \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first()?->name }}
                        </option>
                    @endforeach
                </select>
                @error('sender_wallet_account_id')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="balance" class="form-label sm:w-30"> Balance </label>
            <div class="sm:w-5/6">
                <input wire:model="balance" id="balance" name="balance" type="text" class="form-control" readonly>
                @error('balance')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div wire:ignore class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="beneficiary" class="form-label sm:w-30"> Beneficiary <span
                    class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <div class="w-full relative">
                <select name="beneficiary_id" id="beneficiary_id" class="form-control" data-search="true">
                    @foreach ($beneficiaries as $beneficiary)
                        <option value="{{ $beneficiary->getKey() }}">{{ $beneficiary->getFullName() }}</option>
                    @endforeach
                </select>
                <a data-toggle="modal" data-target="#withdrawbenificary-modal" class="absolute top-0 right-0 plus" style="">
                    <i data-feather="plus-circle" class="w-4 h-4 ml-4"></i>
                </a>
                </div>
                @error('beneficiary_id')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="remaining_amount" class="form-label sm:w-30"> Remaining </label>
            <div class="sm:w-5/6">
                <input wire:model="remaining_amount" id="remaining_amount" name="remaining_amount" type="text"
                    class="form-control" placeholder="£ 120.00" readonly>
                @error('remaining_amount')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>
    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="amount" class="form-label sm:w-30"> Amount to Pay <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <input wire:model="amount" id="amount" name="amount" type="text" class="form-control"
                    onKeyPress="return isNumberKey(event);" required>
                @error('amount')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8  form-inline mt-2">
            <label for="reference" class="form-label sm:w-30"> Reference <span class="text-theme-6">*</span></label>
            <div class="sm:w-5/6">
                <input id="reference" name="reference" type="text" class="form-control"
                    value="{{ old('reference') }}" required>
                @error('reference')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2"
            style="align-items: center;">
            <label for="note" class="form-label sm:w-30"> Note </label>
            <div class="sm:w-5/6">
                <input id="note" name="note" type="text" class="form-control" value="{{ old('note') }}">
                @error('note')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-12 md:col-span-8 lg:col-span-6 sm:col-span-8 form-inline mt-2">
            <label for="attachment" class="form-label sm:w-30"> Attachment </label>
            <div class="sm:w-5/6">
                <input id="attachment" name="attachment" type="file" class="form-control w-full">
                @error('attachment')
                    <span class="block text-theme-6 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
