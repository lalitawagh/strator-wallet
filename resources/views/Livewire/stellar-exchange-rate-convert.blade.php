<div>
    <div class="mb-4 relative" >
        <input
            class="dark:bg-darkmode-400 dark:border-darkmode-400 input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"
            id="" placeholder="" type="text" wire:model="sending_amount" autofocus>
        <label for=""
               class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Sending</label>

        <div id="input-group-email"
             class="input-group-text form-inline cuntery-in flex gap-2" wire:ignore>
            {{-- <span class="self-center" id="tabcuntery-img-flag flex mr-3"><img
                    src="{{ asset('flags/UK.png') }}"></span> --}}

            <select name="from" id="tabcuntery-selection"
            class="form-control text-white"  style='width: 105px;'  wire:change="getSenderCurrency($event.target.value)" data-search="true" required>
                {{-- <option value="" hidden> From </option> --}}
                <option value="GBP" > GBP </option>
                <option value="XLM" > XLM </option>
                <option value="USDC" > USDC </option>
                <option value="ETH" > ETH </option>
                <option value="YUSDC" > YUSDC </option>

                    
            </select>
        </div>
    </div>

    <div class="mb-4 relative">
        <ul
            class="sequence sequence-top sequence-bottom tw-calculator-breakdown tw-calculator-breakdown--detailed sequence-inverse tw-calculator-breakdown--inverse">
            <li>
                <span
                    class="sequence-icon tw-calculator-breakdown__icon dark:bg-darkmode-400 dark:border-darkmode-400">x</span>
                <span class="tw-calculator-breakdown-item__left"></span>
                <span class="tw-calculator-breakdown-item__right"></span>
               

            </li>
            <li>
                <span
                    class="sequence-icon tw-calculator-breakdown__icon dark:bg-darkmode-400 dark:border-darkmode-400">x</span>
                <span class="tw-calculator-breakdown-item__left"></span>
                <span class="tw-calculator-breakdown-item__right"></span>
               

            </li>
        </ul>
    </div>
    <div class="mb-4 relative">
        <input
            class="dark:bg-darkmode-400 dark:border-darkmode-400 input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"
            id="" placeholder="" type="text" wire:model="receive_amount" autofocus>
        <label for=""
               class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Receiving</label>
        <div id="input-group-email"
             class="input-group-text form-inline cuntery-in flex gap-2" wire:ignore>
            {{-- <span class="self-center" id="tabcuntery-img-flag2"><img
                    src="{{ asset('flags/UK.png') }}"></span> --}}
            <select name="to" id="tabcuntery-selection2"
                class="form-control text-white"  style='width: 105px;' wire:change="getReceiverCurrency($event.target.value)" data-search="true" required>
                {{-- <option value="" hidden> From </option> --}}
                <option value="GBP" > GBP </option>
                <option value="XLM" > XLM </option>
                <option value="USDC" > USDC </option>
                <option value="ETH" > ETH </option>
                <option value="YUSDC" > YUSDC </option>

                
            </select>

        </div>
        
    </div>

</div>