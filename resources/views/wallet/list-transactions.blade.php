<div class="intro-y mt-3 sm:mt-10">
    <x-list-view-filters/>
    <div class="intro-y box p-3 mt-0">
        <div class=" overflow-x-auto overflow-y-hidden">
            <table id="tableID" class="shroting display table table-report mt-2" style="width:100%">
                <thead class="short-wrp">
                    <tr>
                        <th>
                            <div class="form-check mt-1 border-gray-400">
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label" for="checkbox-switch-1"></label>
                            </div>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Transaction ID
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Date & Time
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Sender Name
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Receiver Name
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">@if(isset($transactionType) && $transactionType == 'deposit') Payment Method @else Wallet @endif
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Debit
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Credit
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Balance
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Status
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Reference
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th  class="flex">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($transactions)
                    @foreach ($transactions as $index => $transaction)
                        <tr class="intro-x">
                            <td>
                                <div class="form-check mt-1 border-gray-400">
                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                </div>
                            </td>
                            <td class="whitespace-nowrap text-left">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#transaction-detail-modal" onclick="Livewire.emit('showTransactionDetail', {{ $transaction->getKey() }})" style="color:#70297d !important;">{{ $transaction->urn }}</a>
                            </td>
                            <td class="whitespace-nowrap text-left">{{ $transaction->getLastProcessDateTime()->format($defaultDateFormat . ' ' . $defaultTimeFormat) }}</td>
                            <td class="whitespace-nowrap text-left">{{ $transaction->meta['sender_name'] }}</td>
                            <td class="whitespace-nowrap text-left">{{ $transaction->meta['beneficiary_name'] }}</td>
                            @if(isset($transactionType) && $transactionType == 'deposit')
                                <td class="whitespace-nowrap text-left">{{ ucfirst($transaction->payment_method) }}</td>
                            @else
                                <td class="whitespace-nowrap text-left">
                                    @php
                                        $wallet = \Kanexy\LedgerFoundation\Model\Wallet::whereId($transaction->ref_id)->first();
                                        $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first();
                                    @endphp
                                    {{ $ledger?->name }}
                                </td>
                            @endif
                            @if ($transaction->type === 'debit')
                                <td class="whitespace-nowrap text-center text-theme-6">{{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmount($transaction->amount) }}</td>
                                <td class="whitespace-nowrap text-center">{{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmount(0) }}</td>
                            @else
                                <td class="whitespace-nowrap text-center">{{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmount(0) }}</td>
                                <td class="whitespace-nowrap text-center text-theme-9">{{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmount($transaction->amount) }}</td>
                            @endif
                            <td class="whitespace-nowrap text-center">{{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmount(0) }}</td>
                            <td class="whitespace-nowrap text-left">{{ ucfirst($transaction->status) }}</td>
                            <td class="whitespace-nowrap text-left">{{ @$transaction->meta['reference'] }}</td>
                            <td class="table-report__action">
                                <div class="absolute top-0 mt-2 dropdown">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <x-feathericon-settings class="w-5 h-5 text-gray-600" /> </a>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box p-2">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#transaction-detail-modal" onclick="Livewire.emit('showTransactionDetail', {{ $transaction->getKey() }})" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <x-feathericon-eye class="w-4 h-4 mr-1" /> Show </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>