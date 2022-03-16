@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Recieves')

@section('content')

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Request Payments
                    </h2>
                    {{-- <div>
                        <a href="{{ route('dashboard.wallet.receive.create') }}" class="btn btn-sm btn-primary shadow-md">Receive</a>
                    </div> --}}
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12  gap-3">
                        <div class="col-span-12 lg:col-span-12 xxl:col-span-12 mt-0">
                            <div class="grid grid-cols-12 gap-3">
                                <!-- BEGIN: -->
                                <div class="intro-y col-span-12 lg:col-span-12 xxl:col-span-12 p-0">
                                    <div id="1" class="tab-pane grid grid-cols-12 gap-3 pt-0" role="tabpanel"
                                        aria-labelledby="1-tab">
                                        <div class="active col-span-12 mt-0 w-full" role="tabpanel" id="k-wallet"
                                            aria-labelledby="k-wallet-tab">

                                            <div class="intro-y  overflow-x-auto overflow-y-hidden  mt-3 sm:mt-0">

                                                <div
                                                    class="sm:flex items-center p-2 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="nav nav-tabs mr-auto hidden sm:flex" role="tablist">
                                                        <a id="work-in-progress-mobile-new-tab" data-toggle="tab"
                                                            data-target="#work-in-progress-new" href="javascript:;"
                                                            class="py-2 ml-0 active" role="tab" aria-selected="true">ALL</a>
                                                        <!-- <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-2 ml-6" role="tab" aria-selected="false">ASSIGNED TO ME</a>  -->
                                                    </div>
                                                    <div class="flex items-center md:ml-auto mb-2">
                                                        <div
                                                            class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 search hidden sm:block mr-2 ml-auto">
                                                            <input list="browsers" name="browser" id="browser"
                                                                placeholder="Search"
                                                                class="search__input form-control border-transparent placeholder-theme-13">
                                                            <i data-feather="search"
                                                                class="search__icon dark:text-gray-300"></i>
                                                        </div>
                                                        <div class="dark:text-gray-300">1 of 50</div>
                                                        <a href="javascript:;"
                                                            class="w-5 h-5 ml-1 flex items-center justify-center dark:text-gray-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-chevron-left w-5 h-5">
                                                                <polyline points="15 18 9 12 15 6"></polyline>
                                                            </svg> </a>
                                                        <a href="javascript:;"
                                                            class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-chevron-right w-5 h-5">
                                                                <polyline points="9 18 15 12 9 6"></polyline>
                                                            </svg> </a>

                                                        <a href="#"
                                                            class="ml-auto w-5 h-5 ml-2 mr-2 flex items-center justify-center dark:text-gray-300">
                                                            <i class="w-4 h-4" data-feather="list"></i></a>
                                                        <a href="#"
                                                            class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="#c1c4c9">
                                                                <path
                                                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                                            </svg> </a>


                                                    </div>

                                                    <div class="flex sm:flex mt-5 sm:mt-0 mb-2" style="margin-top:-6px;">

                                                        <div class="dropdown sm:w-auto mr-2">
                                                            <button
                                                                class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto"
                                                                aria-expanded="false"><i data-feather="filter"
                                                                    class="w-4 h-4 ml-auto sm:ml-0 mr-2"></i> Filter <i
                                                                    data-feather="chevron-down"
                                                                    class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                                                            <div class="dropdown-menu w-40 filter-dropbox">
                                                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                    <a id="tabulator-export-xlsx" href="javascript:;"
                                                                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        Add Custom Filter </a>
                                                                    <form class="filter-form relative">
                                                                        <div class="form mb-1">
                                                                            <select data-search="true"
                                                                                class="tail-select w-full form-control-sm mt-2">
                                                                                <option value="1">Column Name</option>
                                                                                <option value="2">Column Name 1</option>
                                                                                <option value="3">Column Name 2</option>
                                                                            </select>
                                                                            <span class="float-right ml-2 absolute plus"
                                                                                style="margin:0;">
                                                                                <a href="javascript:;"><i
                                                                                        data-feather="trash-2"
                                                                                        class="w-4 h-4 mr-2"></i></a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="form mb-1">
                                                                            <select data-search="true"
                                                                                class="tail-select w-full form-control-sm mt-2">
                                                                                <option value="1">Action is true</option>
                                                                                <option value="2">Action is false</option>
                                                                            </select>
                                                                        </div>
                                                                    </form>
                                                                    <div class="flex mt-3">
                                                                        <div class="w-full px-2">
                                                                            <div class="form-inline">
                                                                                <button type="submit"
                                                                                    class="btn btn-elevated-primary btn-sm mr-1"><i
                                                                                        data-feather="file-text"
                                                                                        class="w-5 h-5 mr-1"></i>
                                                                                    Apply</button>
                                                                                <a href="javascript:void(0);"
                                                                                    class="btn btn-secondary btn-sm mr-1"><i
                                                                                        data-feather="plus-circle"
                                                                                        class="w-5 h-5 mr-1"></i> Add a
                                                                                    condition</a>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button id="tabulator-print"
                                                            class="w-full btn btn-sm py-2 btn-outline-secondary sm:w-auto mr-2">
                                                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                                                        </button>
                                                        <div class="dropdown sm:w-auto">
                                                            <button
                                                                class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto"
                                                                aria-expanded="false"> Export <i data-feather="chevron-down"
                                                                    class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                                                            <div class="dropdown-menu w-40">
                                                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                                    <a id="tabulator-export-xlsx" href="javascript:;"
                                                                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-feather="file-text"
                                                                            class="w-4 h-4 mr-2"></i> Export XLSX </a>
                                                                    <a id="tabulator-export-html" href="javascript:;"
                                                                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-feather="file-text"
                                                                            class="w-4 h-4 mr-2"></i> Export PDF </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary sm:ml-2 -mt-1 mb-2">Add New</button>
                                                </div>
                                                <!-- BEGIN: HTML Table Data -->
                                                <div class="intro-y p-3 mt-0">
                                                    <div class=" overflow-x-auto overflow-y-hidden">
                                                        <!-- <div id="tabulator" class="mt-5 table-report table-report--tabulator"></div> -->

                                                        <table id="tableID"
                                                            class="shroting display table table-report -mt-2">
                                                            <thead class="short-wrp">
                                                                <tr>
                                                                    <th>
                                                                        <div class="form-check mt-1 border-gray-400">
                                                                            <input id="checkbox-switch-1"
                                                                                class="form-check-input" type="checkbox"
                                                                                value="">
                                                                            <label class="form-check-label"
                                                                                for="checkbox-switch-1"></label>
                                                                        </div>
                                                                    </th>

                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Transaction ID
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Date & Time
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Sender Name
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Receiver Name
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Wallet
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Debit
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Credit
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Balance
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Status
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        <span class="flex short-icon">Reference
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>



                                                                    <th class="flex" style="width:40px;">Action
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                        </table>

                                                    </div>
                                                </div>
                                                <!-- END: HTML Table Data -->

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
    </div>

    <div id="WalletPayout-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h2 class="font-medium text-base mr-auto"> Request</h2>
                </div>

                <div class="modal-body">
                    <form action="" method="">
                        <div class="grid grid-cols-12 md:gap-0 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Wallet <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1"
                                        name="currency">

                                        <option>Paypal</option>
                                        <option>Stripe</option>
                                        <option>Bank</option>
                                    </select>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Balance </label>
                                <div class="sm:w-5/6">
                                    <input id="" disabled type="text" class="form-control" value=""
                                        placeholder="£ 1,320.00">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-0 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0 relative">
                                <label for="" class="form-label sm:w-28"> Beneficiary <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1"
                                        name="currency">
                                        <option>Paypal</option>
                                        <option>Stripe</option>
                                        <option>Bank</option>
                                    </select>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                                <a data-toggle="modal" data-target="#walletbenificary-modal"
                                    class="absolute top-0 right-0 plus"
                                    style="cursor: pointer;right: -18px;top: 0;margin-top: 20px;">
                                    <i data-feather="plus-circle" class="w-4 h-4 ml-4"></i>
                                </a>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Mobile </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-0 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Amount to Pay <span
                                        class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Remaining </label>
                                <div class="sm:w-5/6">
                                    <input id="" disabled type="text" class="form-control" value=""
                                        placeholder="£ 120.00">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-0 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0"
                                style="align-items: center;">
                                <label for="" class="form-label sm:w-28"> Note </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Attachment </label>
                                <div class="sm:w-5/6">
                                    <input id="" name="" type="file" class="form-control w-full " placeholder="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-0 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Reason </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-right mt-5">
                        <a data-toggle="modal" data-target="#wsave-preview-modal" class="btn btn-primary w-24">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Modal Content -->
    <div id="wsave-preview-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Otp Verification
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-12 md:gap-0 mt-0">
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                            <label for="" class="form-label sm:w-28"> Mobile No <span
                                    class="text-theme-6">*</span></label>
                            <div class="sm:w-5/6">
                                <input id="" type="text" class="form-control" value="">
                                <span class="block text-theme-6 mt-2"></span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                            <label for="" class="form-label sm:w-28"> Otp <span class="text-theme-6">*</span></label>
                            <div class="sm:w-5/6">
                                <input id="" type="text" class="form-control" value="">
                                <span class="block text-theme-6 mt-2"></span>
                                <div class="form-help">Please check OTP sent to your mobile number. It will expire in
                                    10 minutes.</div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center mt-5">
                        <button type="button" data-dismiss="modal" class="btn btn-link mr-2">Resend Otp</button>
                        <button type="button" data-dismiss="modal" class="btn btn-primary w-24">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal Content -->

    <!--pauout wallet detail popup-->
    <div id="pauoutwalletdetailpopup-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h2 class="font-medium text-base mr-auto">Receive/Request payment Details</h2>
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

                                <div class="flex text-sm tracking-wide font-medium uppercase">
                                    <h4 class="font-medium text-base mr-auto">Billing Information </h4> <button
                                        class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Edit </button>
                                </div>
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
                                <div class="flex text-sm tracking-wide font-medium uppercase">
                                    <h4 class="font-medium text-base mr-auto">Payment Method </h4> <button
                                        class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Edit </button>
                                </div>

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
    <!--payout wallet detail popup-->
@endsection
