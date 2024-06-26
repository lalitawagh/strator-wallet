@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Exchange')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Exchange
                    </h2>
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
                                                    class="flex-wrap sm:flex items-center justify-end sm:py-0 border-b border-gray-200 dark:border-dark-5">
                                                    <div class="w-auto w-auto nav nav-tabs mr-auto hidden sm:flex"
                                                        role="tablist">
                                                        <a id="work-in-progress-mobile-new-tab" data-tw-toggle="tab"
                                                            data-tw-target="#work-in-progress-new" href="javascript:;"
                                                            class="py-2 ml-0 active" role="tab"
                                                            aria-selected="true">ALL</a>
                                                        <!-- <a id="week-work-in-progress-mobile-last-week-tab" data-tw-toggle="tab" data-tw-target="#work-in-progress-last-week" href="javascript:;" class="py-2 ml-6" role="tab" aria-selected="false">ASSIGNED TO ME</a>  -->
                                                    </div>
                                                    <div class="flex items-center md:ml-auto mb-2">
                                                        <div
                                                            class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 search sm:block mr-2 ml-auto">
                                                            <input type="text" list="browsers" name="browser"
                                                                id="browser" placeholder="Search"
                                                                class="search__input form-control border-transparent placeholder-theme-13">
                                                            <i data-lucide="search"
                                                                class="search__icon dark:text-gray-300"></i>
                                                        </div>
                                                        {{-- <div class="dark:text-gray-300">1 of 50</div>
                                                        <a href="javascript:;"
                                                            class="w-5 h-5 ml-1 flex items-center justify-center dark:text-gray-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-chevron-left w-5 h-5">
                                                                <polyline points="15 18 9 12 15 6"></polyline>
                                                            </svg> </a>
                                                        <a href="javascript:;"
                                                            class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-chevron-right w-5 h-5">
                                                                <polyline points="9 18 15 12 9 6"></polyline>
                                                            </svg> </a> --}}

                                                        <a id="List" href="#"
                                                            class="ml-auto w-5 h-5 ml-2 mr-2 flex items-center justify-center dark:text-gray-300">
                                                            <i class="w-4 h-4" data-lucide="list"></i></a>
                                                        <a id="Grid" href="#"
                                                            class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="#c1c4c9">
                                                                <path
                                                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                                            </svg> </a>


                                                    </div>

                                                    <div class="flex sm:flex sm:mt-0 sm:mt-0 mb-2">
                                                        <div class="dropdown sm:w-auto mr-2">

                                                            <button id="Filter"
                                                                class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto"
                                                                aria-expanded="false" data-tw-toggle="dropdown">
                                                                <span class="w-5 h-5 flex items-center justify-center">
                                                                    <i data-lucide="filter"
                                                                        class="w-4 h-4 ml-auto sm:ml-0 mr-2"></i> Filter
                                                                    <i data-lucide="chevron-down"
                                                                        class="w-4 h-4 ml-auto sm:ml-2"></i>
                                                                </span>
                                                            </button>


                                                            <div
                                                                class="dropdown-menu w-40 filter-dropbox box dark:bg-dark-1 p-2">
                                                                <ul class="dropdown-content">
                                                                    <li>
                                                                        <a id="tabulator-export-xlsx" href="javascript:;"
                                                                            class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                            Add Custom Filter </a>
                                                                        <form class="filter-form relative">
                                                                            <div class="form mb-1">
                                                                                <select data-search="true"
                                                                                    class="w-full form-control-sm mt-2">
                                                                                    <option value="1">Column Name
                                                                                    </option>
                                                                                    <option value="2">Column Name 1
                                                                                    </option>
                                                                                    <option value="3">Column Name 2
                                                                                    </option>
                                                                                </select>
                                                                                <span class="float-right ml-2 absolute plus"
                                                                                    style="margin:0;">
                                                                                    <a href="javascript:;"><i
                                                                                            data-lucide="trash-2"
                                                                                            class="w-4 h-4 mr-2"></i></a>
                                                                                </span>
                                                                            </div>
                                                                            <div class="form mb-1">
                                                                                <select data-search="true"
                                                                                    class="w-full form-control-sm mt-2">
                                                                                    <option value="1">Action is true
                                                                                    </option>
                                                                                    <option value="2">Action is false
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </form>
                                                                        <div class="flex mt-3">
                                                                            <div class="w-full px-2">
                                                                                <div class="form-inline">
                                                                                    <button id="Apply" type="submit"
                                                                                        class="btn btn-elevated-primary btn-sm mr-1"><i
                                                                                            data-lucide="file-text"
                                                                                            class="w-5 h-5 mr-1"></i>
                                                                                        Apply</button>
                                                                                    <a id="AddCondition"
                                                                                        href="javascript:void(0);"
                                                                                        class="btn btn-secondary btn-sm mr-1"><i
                                                                                            data-lucide="plus-circle"
                                                                                            class="w-5 h-5 mr-1"></i> Add a
                                                                                        condition</a>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <button id="tabulator-print"
                                                            class="w-full btn btn-sm py-2 btn-outline-secondary sm:w-auto mr-2">
                                                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                                                        </button>
                                                        <div class="dropdown sm:w-auto">
                                                            <button id="Export"
                                                                class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto"
                                                                aria-expanded="false" data-tw-toggle="dropdown">
                                                                <span class="w-5 h-5 flex items-center justify-center">
                                                                    Export <i data-lucide="chevron-down"
                                                                        class="w-4 h-4 ml-auto sm:ml-2"></i>
                                                                </span>
                                                            </button>
                                                            <div class="dropdown-menu w-40">
                                                                <ul class="dropdown-content box dark:bg-dark-1 p-2">
                                                                    <li>
                                                                        <a id="tabulator-export-xlsx" href="javascript:;"
                                                                            class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-lucide="file-text"
                                                                                class="w-4 h-4 mr-2"></i> Export XLSX </a>
                                                                    </li>
                                                                    <li>
                                                                        <a id="tabulator-export-html" href="javascript:;"
                                                                            class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-lucide="file-text"
                                                                                class="w-4 h-4 mr-2"></i> Export PDF </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button id="ExchangeAdd" type="submit"
                                                        class="btn btn-sm btn-primary sm:ml-2 -mt-1 mb-2">Add New</button>
                                                </div>
                                                <!-- BEGIN: HTML Table Data -->
                                                <div class="intro-y px-5 py-3 mt-0">
                                                    <div class="intro-y mt-0">
                                                        <div
                                                            class="sm:flex justify-end flex-wrap items-center sm:py-1 border-b border-gray-200 dark:border-dark-5 gap-1">
                                                            <x-list-view-filters />
                                                        </div>
                                                    </div>
                                                    <div class=" overflow-x-auto overflow-y-hidden">
                                                        <!-- <div id="tabulator" class="mt-5 table-report table-report--tabulator"></div> -->

                                                        <table id="tableID"
                                                            class="shroting display table table-report -mt-2">
                                                            <thead class="short-wrp">
                                                                <tr>
                                                                    <th>
                                                                        <div class="form-check mt-0 border-gray-400">
                                                                            <input id="checkbox-switch-1"
                                                                                class="form-check-input" type="checkbox"
                                                                                value="">
                                                                            <label class="form-check-label"
                                                                                for="checkbox-switch-1"></label>
                                                                        </div>
                                                                    </th>

                                                                    <th class="whitespace-nowrap text-left">
                                                                        Transaction ID
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Date & Time
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Sender Name
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Receiver Name
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Wallet
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Debit
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Credit
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Balance
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Status
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="whitespace-nowrap text-left">
                                                                        Reference
                                                                        <span class="flex short-icon">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 up" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="h-4 w-4 down" fill="#c1c4c9"
                                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                                                            </svg>
                                                                        </span>
                                                                    </th>
                                                                    <th class="flex" style="width:40px;">Action</th>
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
@endsection
