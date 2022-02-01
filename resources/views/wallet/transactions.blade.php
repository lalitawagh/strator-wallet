@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Transactions')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Wallet Transactions
                    </h2>
                </div>

                <div class="p-5">
                    <div class="nav nav-tabs flex-col sm:flex-row" role="tablist">
                        @foreach($wallets as $key =>  $wallet)
                            @php
                            $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet->ledger_id)->first();
                            @endphp
                        <a id="{{ $key }}-tab" data-toggle="tab" data-target="#{{$key}}"
                            href="javascript:;" class="flex-1 flex items-center px-3 py-2 mt-2 pb-5 font-medium">
                            <div class="col-span-12 sm:col-span-4 xl:col-span-3 intro-y w-full" id="k-wallet" data-toggle="tab" data-target="#k-wallet">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <div class="text-2xl font-bold leading-8 mt-0">{{ $ledger?->name }}</div>
                                            <div class="ml-auto">
                                                <div class="flex mt-4 lg:mt-0 lg:w-12 lg:h-12 image-fit">
                                                    <img alt="" class="" src="@isset($ledger?->image){{ \Illuminate\Support\Facades\Storage::disk('azure')->url($ledger->image) }}@endisset">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="text-base text-gray-600 mt-1">{{ $wallet?->urn }}</div>
                                        <div class="flex mt-3">
                                            <span class="@if( $wallet->status == \Kanexy\LedgerFoundation\Http\Enums\WalletStatus::ACTIVE) text-theme-9 @else text-theme-6 @endif"> {{ ucfirst($wallet->status)}}</span>
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-6 cursor-pointer"> {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmount($wallet?->balance) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                    <div class="tab-content">
                        <div id="1" class="tab-pane grid grid-cols-12 gap-3 pt-4 active" role="tabpanel" aria-labelledby="1-tab">
                            <div class="active col-span-12 mt-6 w-full" role="tabpanel" id="k-wallet" aria-labelledby="k-wallet-tab">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Weekly Top Products
                                    </h2>

                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Date</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Wallet</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Fee</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Balance</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">28 Aug 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Send Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">29 July 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Recieve Pay coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="2" class="tab-pane grid grid-cols-12 gap-3 pt-4" role="tabpanel" aria-labelledby="2-tab">
                            <div class="col-span-12 mt-6 w-full" role="tabpanel" id="k-wallet1" aria-labelledby="k-wallet1-tab">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Weekly Top Products 1
                                    </h2>

                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Date</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Wallet</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Fee</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Balance</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">28 Aug 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Send Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">29 July 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Recieve Pay coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="3" class="tab-pane grid grid-cols-12 gap-3 pt-4" role="tabpanel" aria-labelledby="3-tab">
                            <div class="col-span-12 mt-6 w-full" role="tabpanel" id="k-wallet2" aria-labelledby="k-wallet2-tab">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Weekly Top Products 2
                                    </h2>

                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Date</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Wallet</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Fee</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Balance</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">28 Aug 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Send Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">29 July 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Recieve Pay coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="4" class="tab-pane grid grid-cols-12 gap-3 pt-4" role="tabpanel" aria-labelledby="4-tab">
                            <div class="col-span-12 mt-6 w-full" role="tabpanel" id="k-wallet3" aria-labelledby="k-wallet3-tab">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Weekly Top Products 3
                                    </h2>

                                </div>
                                <div class="overflow-x-auto">
                                    <table class="table">
                                        <thead>
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Date</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Wallet</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Description</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Fee</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Balance</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">28 Aug 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Send Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="border-b dark:border-dark-5">29 July 2021</td>
                                                <td class="border-b dark:border-dark-5">Pay Coin</td>
                                                <td class="border-b dark:border-dark-5">Recieve Pay coin</td>
                                                <td class="border-b dark:border-dark-5">Success</td>
                                                <td class="border-b dark:border-dark-5">30</td>
                                                <td class="border-b dark:border-dark-5">-20</td>
                                                <td class="border-b whitespace-nowrap dark:border-dark-5">
                                                    <div class="dropdown">
                                                        <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                            <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </button>

                                                        <div class="dropdown-menu w-48">
                                                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-feather="eye" class="w-4 h-4 mr-2"></i> Show
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="transaction-detail-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h2 class="font-medium text-base mr-auto">Transaction Details</h2>
                    <button class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Change Plan </button>
                </div>

                <div class="modal-body">
                    <div>
                            <div>
                                <div class="flex flex-col lg:flex-row px-1 sm:px-2 py-0 mb-2">
                                    <div class="dark:text-theme-10">
                                        <h2 class="text-theme-1 dark:text-theme-10 font-semibold text-2xl">$110/y</h2>
                                        <p class="text-sm font-medium text-gray-700">t1</p>
                                    </div>
                                </div>
                                <div class="mt-5 border-b border-dashed pb-3">
                                    <p class="text-sm tracking-wide font-medium uppercase">Sender Account</p>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Next Payment
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                23 Jun, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Subscription plan
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                Gold
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Payment Due Date
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                25 Agust, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Subscription Start Date
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                12 Jun, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Subscription End Date
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                25 Jun, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Bill
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                1,25,846
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 border-b border-dashed pb-3">

                                    <div class="flex text-sm tracking-wide font-medium uppercase"><h4 class="font-medium text-base mr-auto">Billing Information </h4> <button class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Edit </button></div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Company Name
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                             <span class="font-medium">
                                                Kanexy
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Email Address
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                             <span class="font-medium">
                                                kanexy@gmail.co
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                VAT number
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                             <span class="font-medium">
                                                RF845762158762
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 border-b border-dashed pb-3">
                                    <div class="flex text-sm tracking-wide font-medium uppercase"><h4 class="font-medium text-base mr-auto">Payment Method </h4> <button class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Edit </button></div>

                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Credit Card
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                             <span class="font-medium">
                                                Ending in 5845
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Expiring
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                             <span class="font-medium">
                                                09/28
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
