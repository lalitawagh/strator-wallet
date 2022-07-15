<div>
    <div class="flex flex-col xl:flex-row xl:items-center">
        <div class="flex">
            <h2 class="text-lg font-medium truncate mr-5">
                Transactions
            </h2>
        </div>
        <div class="hidden" id="updateWalletCredit">{{ $creditWalletTransactionGraphData }}</div>
        <div class="hidden" id="updateWalletDebit">{{ $debitWalletTransactionGraphData }}</div>
        <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
            <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                <select class="tom-select w-60" wire:change="getWalletTransaction($event.target.value)">
                    @foreach ($wallets as $wallet)
                        <option value="{{ $wallet->getKey() }}" @if($selected_wallet == $wallet->getKey()) selected @endif>{{ $wallet->ledger?->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 md:col-span-12 lg:col-span-10 mt-3">
            <div class="report-chart">
                <canvas id="chartLine" height="150" class="mt-6"></canvas>
            </div>
        </div>

    </div>
</div>
