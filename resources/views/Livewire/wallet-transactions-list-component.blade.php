<div class="intro-y mt-3 sm:mt-10">
    <div class="sm:flex items-center p-2 sm:py-0 border-b border-gray-200 dark:border-dark-5">
        <div class="nav nav-tabs mr-auto hidden sm:flex" role="tablist">
            <a id="work-in-progress-mobile-new-tab" data-toggle="tab" data-target="#work-in-progress-new" href="javascript:;" class="py-2 ml-0 active" role="tab" aria-selected="true">ALL</a>
        <!-- <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-2 ml-6" role="tab" aria-selected="false">ASSIGNED TO ME</a>  -->
        </div>
        <div class="flex items-center md:ml-auto mb-2">
            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 search hidden sm:block mr-2 ml-auto">
                <input list="browsers" name="browser" id="browser" placeholder="Search" class="search__input form-control border-transparent placeholder-theme-13">
                <span wire:ignore><i data-feather="search" class="search__icon dark:text-gray-300"></i></span>
            </div>
            <a href="#" class="ml-auto w-5 h-5 ml-2 mr-2 flex items-center justify-center dark:text-gray-300"> <i class="w-4 h-4" data-feather="list"></i></a>
            <a href="#" class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="#c1c4c9">
            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg> </a>
        </div>
        <div class="flex sm:flex mt-5 sm:mt-0" style="margin-top:-6px;">

            <div class="dropdown sm:w-auto mr-2">
                <button class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto" aria-expanded="false"><span wire:ignore><i data-feather="filter" class="w-4 h-4 ml-auto sm:ml-0 mr-2"></i></span> Filter <span wire:ignore><i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i></span> </button>
                <div class="dropdown-menu w-40 filter-dropbox">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                        <a id="tabulator-export-xlsx" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">  Add Custom Filter </a>
                        <form class="filter-form relative">
                            <div class="form mb-1">
                                <select data-search="true" class="tail-select w-full form-control-sm mt-2">
                                    <option value="1">Column Name</option>
                                    <option value="2">Column Name 1</option>
                                    <option value="3">Column Name 2</option>
                                </select>
                                <span class="float-right ml-2 absolute plus" style="margin:0;">
                                <a href="javascript:;"><span wire:ignore><i data-feather="trash-2" class="w-4 h-4 mr-2"></i></span></a>
                                </span>
                            </div>
                            <div class="form mb-1">
                                <select data-search="true" class="tail-select w-full form-control-sm mt-2">
                                    <option value="1">Action is true</option>
                                    <option value="2">Action is false</option>
                                </select>
                            </div>
                        </form>
                        <div class="flex mt-3">
                            <div class="w-full px-2">
                                <div class="form-inline">
                                    <button type="submit" class="btn btn-elevated-primary btn-sm mr-1"><span wire:ignore><i data-feather="file-text" class="w-5 h-5 mr-1"></i></span> Apply</button>
                                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm mr-1"><span wire:ignore><i data-feather="plus-circle" class="w-5 h-5 mr-1"></i></span> Add a condition</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button id="tabulator-print" class="w-full btn btn-sm py-2 btn-outline-secondary sm:w-auto mr-2"> <span wire:ignore><i data-feather="printer" class="w-4 h-4 mr-2"></i></span> Print </button>
            <div class="dropdown sm:w-auto">
                <button class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto" aria-expanded="false">  Export <span wire:ignore><i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i></span> </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                        <a id="tabulator-export-xlsx" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <span wire:ignore><i data-feather="file-text" class="w-4 h-4 mr-2"></i></span> Export XLSX </a>
                        <a id="tabulator-export-html" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <span wire:ignore><i data-feather="file-text" class="w-4 h-4 mr-2"></i></span> Export PDF </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <span class="flex short-icon">Wallet
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Transaction Party
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
                            <td class="whitespace-nowrap text-left">{{ $transaction->urn }}</td>
                            <td class="whitespace-nowrap text-left">{{ $transaction->getLastProcessDateTime()->format($defaultDateFormat . ' ' . $defaultTimeFormat) }}</td>
                            <td class="whitespace-nowrap text-left">
                                @php
                                    $wallet = \Kanexy\LedgerFoundation\Model\Wallet::whereId($transaction->ref_id)->first();
                                    $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first();
                                @endphp
                                {{ $ledger?->name }}
                            </td>
                            <td class="whitespace-nowrap text-left">@if ($transaction->type === 'debit') {{ @$transaction->meta['beneficiary_name'] }} @else {{ @$transaction->meta['sender_name'] }} @endif</td>
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
