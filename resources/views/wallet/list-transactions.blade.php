<div>
    <div class="intro-y mt-0">
        <div
            class="text-right flex-wrap sm:flex items-center justify-end sm:py-0 border-b border-gray-200 dark:border-dark-5">
            <x-list-view-filters />
            @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSubscriber())
                @if ($transactionType == 'deposit')
                    <a id="walletDepositBtn"
                        href="{{ route('dashboard.wallet.deposit.create', ['workspace_id' => $workspace->id]) }}"
                        class="btn btn-sm btn-primary shadow-md sm:ml-2 sm:ml-2 sm:-mt-2 py-2 sm:mb-0 mb-2">Deposit</a>
                @elseif ($transactionType == 'payout')
                    @if (request()->input('type') == trans('ledger-foundation::configuration.transfer'))
                        <a id="walletTransfertBtn"
                            href="{{ route('dashboard.wallet.payout.create', ['workspace_id' => $workspace->id, 'type' => request()->input('type')]) }}"
                            class="btn btn-sm btn-primary shadow-md sm:ml-2 sm:ml-2 sm:-mt-2 sm:mb-0 mb-2">Transfer</a>
                    @else
                        <a id="walletPayoutBtn"
                            href="{{ route('dashboard.wallet.payout.create', ['workspace_id' => $workspace->id]) }}"
                            class="btn btn-sm btn-primary shadow-md sm:ml-2 sm:ml-2 sm:-mt-2 sm:mb-0 mb-2">Payout</a>
                    @endif
                @endif
            @endif
        </div>
    </div>
    <div class="intro-y box p-0 mt-0">
        <div class=" overflow-x-auto overflow-y-hidden">
            <table id="tableID" class="shroting display table table-report mt-0">
                <thead class="short-wrp dark:bg-darkmode-400 dark:border-darkmode-400">
                    <tr>
                        <th>
                            <div class="form-check mt-1 border-gray-400">
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label" for="checkbox-switch-1"></label>
                            </div>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            Transaction ID
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            Date & Time
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            Sender Name
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            Receiver Name
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            @if (isset($transactionType) && $transactionType == 'deposit')
                                Payment Method
                            @else
                                Wallet
                            @endif
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>

                        <th class="whitespace-nowrap text-left">
                            Debit
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            Credit
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            Balance
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                                @if ($transactionType == 'payout' || $transactionType == 'all')
                                    User Status
                                @else
                                    Status
                                @endif
                            @else
                                Status
                            @endif

                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                            @if ($transactionType == 'payout' || $transactionType == 'all')
                                <th class="whitespace-nowrap text-left">
                                    Admin Status
                                    <span class="flex short-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                        </svg>
                                    </span>
                                </th>
                            @endif
                        @endif
                        @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                            @if ($transactionType == 'all')
                                <th class="whitespace-nowrap text-left">
                                    Type
                                    <span class="flex short-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                        </svg>
                                    </span>
                                </th>
                            @endif
                        @endif
                        <th class="whitespace-nowrap text-left">
                            Reference
                            <span class="flex short-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                </svg>
                            </span>
                        </th>
                        <th class="flex">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($transactions)

                        @foreach ($transactions as $index => $transaction)
                            @if ((isset($transaction->meta['transaction_type']) && @$transaction->meta['transaction_type'] == 'deposit') ||
                                @$transaction->meta['transaction_type'] == 'payout')
                                @php $wallet = \Kanexy\LedgerFoundation\Model\Wallet::whereId($transaction->ref_id)->first(); @endphp
                            @else
                                @isset($transaction?->meta['sender_wallet_account_id'])
                                    @php $wallet = \Kanexy\LedgerFoundation\Model\Wallet::whereId($transaction->meta['sender_wallet_account_id'])->first(); @endphp
                                @endisset
                            @endif
                            @php
                                $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet?->ledger_id)->first();
                            @endphp
                            @if (isset($transaction->meta['transaction_type']) &&
                                @$transaction->meta['transaction_type'] == 'payout' &&
                                @$transaction->status == 'pending-confirmation')
                            @elseif (isset($transaction->meta['transaction_type']) &&
                                @$transaction->meta['transaction_type'] == 'withdraw' &&
                                @$transaction->status == 'draft')
                            @else
                                <tr class="intro-x">
                                    <td>
                                        <div class="form-check mt-1 border-gray-400">
                                            <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                value="">
                                            <label class="form-check-label" for="checkbox-switch-1"></label>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap text-left">
                                        <a id="showTransactionDetail" href="javascript:void(0);" data-tw-toggle="modal"
                                            data-tw-target="#transaction-detail-modal"
                                            onclick="Livewire.emit('showTransactionDetail', {{ $transaction->getKey() }})"
                                            class="active-clr">{{ $transaction->urn }}</a>
                                    </td>
                                    <td class="whitespace-nowrap text-left">
                                        {{ $transaction->getLastProcessDateTime()->format($defaultDateFormat . ' ' . $defaultTimeFormat) }}
                                    </td>
                                    <td class="whitespace-nowrap text-left">
                                        @if ((isset($transaction->meta['transaction_type']) &&
                                            @$transaction->meta['transaction_type'] == 'wallet-withdraw') ||
                                            @$transaction->meta['transaction_type'] == 'withdraw')
                                            {{ $wallet->name }}
                                        @else
                                            {{ @$transaction->meta['sender_name'] }}
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap text-left">{{ @$transaction?->meta['beneficiary_name'] }}
                                    </td>
                                    @if (isset($transactionType) && $transactionType == 'deposit')
                                        <td class="whitespace-nowrap text-left">
                                            {{ trans('ledger-foundation::configuration.' . $transaction->payment_method) }}
                                        </td>
                                    @else
                                        <td class="whitespace-nowrap text-left">
                                            {{ $ledger?->name }}
                                        </td>
                                    @endif
                                    @if ($transaction->type === 'debit')
                                        <td class="whitespace-nowrap text-center text-theme-6">
                                            @if ($ledger?->exchange_type == \Kanexy\LedgerFoundation\Enums\ExchangeType::FIAT)
                                                {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($transaction->amount, $ledger?->name) }}
                                            @else
                                                {{ $ledger?->symbol }}
                                                {{ number_format((float) $transaction->amount, 2, '.', '') }}
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap text-center">-</td>
                                    @else
                                        <td class="whitespace-nowrap text-center">-</td>
                                        <td class="whitespace-nowrap text-center text-success">
                                            @if ($ledger?->exchange_type == \Kanexy\LedgerFoundation\Enums\ExchangeType::FIAT)
                                                {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($transaction->amount, $ledger?->name) }}
                                            @else
                                                {{ $ledger?->symbol }}
                                                {{ number_format((float) $transaction->amount, 2, '.', '') }}
                                            @endif
                                        </td>
                                    @endif
                                    <td class="whitespace-nowrap text-center"> {{ $ledger?->symbol }}
                                        {{ number_format((float) @$transaction->meta['balance'], 2, '.', '') }} </td>
                                    <td class="whitespace-nowrap text-left">{{ ucfirst($transaction->status) }}</td>
                                    @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                                        @if ($transactionType == 'payout' || $transactionType == 'all')
                                            <td class="whitespace-nowrap text-left">
                                                {{ ucfirst(@$transaction?->meta['transfer_status']) }}</td>
                                        @endif
                                    @endif
                                    @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                                        @if ($transactionType == 'all')
                                            <td class="whitespace-nowrap text-left">
                                                {{ ucfirst(@$transaction->meta['transaction_type']) }}</td>
                                        @endif
                                    @endif
                                    <td class="whitespace-nowrap text-left">{{ @$transaction->meta['reference'] }}</td>
                                    <td class="whitespace-nowrap text-left">
                                        <div class="dropdown">
                                            <button id="DropdownD" class="dropdown-toggle btn px-2 box"
                                                aria-expanded="false" data-tw-toggle="dropdown">
                                                <span class="w-5 h-5 flex items-center justify-center">
                                                    <x-feathericon-settings class="w-5 h-5 text-gray-600" />
                                                </span>
                                            </button>
                                            <div class="dropdown-menu w-40">
                                                <ul class="dropdown-content">
                                                    <li>
                                                        <a id="Show" href="javascript:void(0);"
                                                            data-tw-toggle="modal"
                                                            data-tw-target="#transaction-detail-modal"
                                                            onclick="Livewire.emit('showTransactionDetail', {{ $transaction->getKey() }})"
                                                            class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white">
                                                            <x-feathericon-eye class="w-4 h-4 mr-1" /> Show
                                                        </a>
                                                    </li>


                                                    @if (isset($transactionType) && \Illuminate\Support\Facades\Auth::user()->isSuperAdmin())
                                                        @if ($transactionType != 'deposit' &&
                                                            !is_null(@$transaction?->meta['transfer_status']) &&
                                                            $transaction?->meta['transfer_status'] == 'pending')
                                                            <li><a id="Accepted"
                                                                    href="{{ route('dashboard.wallet.wallet-payout.transferAccepted', ['id' => $transaction->getKey(), 'type' => $transactionType]) }}"
                                                                    class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white">
                                                                    <x-feathericon-check class="w-4 h-4 mr-1" />
                                                                    Accepted
                                                                </a></li>
                                                        @endif

                                                        @if ($transactionType != 'payout' &&
                                                            $transaction->meta['transaction_type'] == 'deposit' &&
                                                            !is_null(@$transaction?->status) &&
                                                            $transaction?->status != 'accepted')
                                                            <li><a id="Accepted"
                                                                    href="{{ route('dashboard.wallet.wallet-deposit.transferAccepted', ['id' => $transaction->getKey(), 'type' => $transactionType]) }}"
                                                                    class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white">
                                                                    <x-feathericon-check class="w-4 h-4 mr-1" />
                                                                    Accepted
                                                                </a></li>
                                                        @endif
                                                        @if ($transactionType != 'payout' &&
                                                            $transaction->meta['transaction_type'] == 'deposit' &&
                                                            !is_null(@$transaction?->status) &&
                                                            $transaction?->status != 'pending' &&
                                                            $transaction?->status != 'accepted')
                                                            <li><a id="Pending"
                                                                    href="{{ route('dashboard.wallet.wallet-deposit.transferPending', ['id' => $transaction->getKey(), 'type' => $transactionType]) }}"
                                                                    class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white">
                                                                    <x-feathericon-alert-circle class="w-4 h-4 mr-1" />
                                                                    Pending
                                                                </a></li>
                                                        @endif

                                                        @if ($transaction->status == \Kanexy\PartnerFoundation\Core\Enums\TransactionStatus::PENDING_CONFIRMATION)
                                                            <li><a id="PartnerAccepted" href="{{ route('dashboard.wallet.withdrawAccepted', ['id' => $transaction->getKey(), 'type' => $transactionType]) }}"
                                                                    class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white">
                                                                    <x-feathericon-check class="w-4 h-4 mr-1" />
                                                                    Accepted
                                                                </a></li>
                                                        @endif
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
    @if (!is_array($transactions) && method_exists($transactions, 'links'))
        <div class="my-2">
            {{ $transactions->withQueryString()->links() }}
        </div>
    @endif
</div>
