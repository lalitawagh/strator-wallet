@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Withdraw')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Withdraw
                    </h2>
                </div>

                <div class="p-5">
                    <div class="intro-y">
                        <div class="sm:flex items-center sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <div class="nav nav-tabs mr-auto hidden sm:flex" role="tablist">
                                <a id="work-in-progress-mobile-new-tab" data-toggle="tab"
                                    data-target="#work-in-progress-new" href="javascript:;" class="py-2 ml-0 active"
                                    role="tab" aria-selected="true">ALL</a>
                                <!-- <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-2 ml-6" role="tab" aria-selected="false">ASSIGNED TO ME</a>  -->
                            </div>
                            <div class="flex items-center md:ml-auto mb-2">
                                <div
                                    class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 search hidden sm:block mr-2 ml-auto">
                                    <input list="browsers" name="browser" id="browser" placeholder="Search"
                                        class="search__input form-control border-transparent placeholder-theme-13">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-search search__icon dark:text-gray-300">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg></span>
                                </div>
                                <a href="#"
                                    class="ml-auto w-5 h-5 ml-2 mr-2 flex items-center justify-center dark:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-list w-4 h-4">
                                        <line x1="8" y1="6" x2="21" y2="6"></line>
                                        <line x1="8" y1="12" x2="21" y2="12"></line>
                                        <line x1="8" y1="18" x2="21" y2="18"></line>
                                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                    </svg></a>
                                <a href="#" class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300"> <svg
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="#c1c4c9">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                        </path>
                                    </svg> </a>
                            </div>
                            <div class="flex sm:flex mt-5 sm:mt-0" style="margin-top:-6px;">

                                <div class="dropdown sm:w-auto mr-2">
                                    <button class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto"
                                        aria-expanded="false"><span><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-filter w-4 h-4 ml-auto sm:ml-0 mr-2">
                                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                            </svg></span> Filter <span><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down w-4 h-4 ml-auto sm:ml-2">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg></span> </button>
                                    <div class="dropdown-menu w-40 filter-dropbox">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                            <a id="tabulator-export-xlsx" href="javascript:;"
                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                Add Custom Filter </a>
                                            <form class="filter-form relative">
                                                <div class="form mb-1">
                                                    <select data-search="true"
                                                        class="tail-select w-full form-control-sm mt-2"
                                                        data-select-hidden="display" data-tail-select="tail-1"
                                                        style="display: none;">
                                                        <option disabled=""></option>
                                                        <option value="1" selected="selected">Column Name</option>
                                                        <option value="2">Column Name 1</option>
                                                        <option value="3">Column Name 2</option>
                                                    </select>
                                                    <div class="tail-select no-classes hide-disabled" tabindex="0"
                                                        style="display: none;">
                                                        <div class="select-label"><span class="label-inner">Column
                                                                Name</span></div>
                                                        <div class="select-dropdown" style="max-height: 350px;">
                                                            <div class="dropdown-search"><input type="text"
                                                                    class="search-input"
                                                                    placeholder="Type in to search..."></div>
                                                            <div class="dropdown-inner">
                                                                <ul class="dropdown-optgroup" data-group="#">
                                                                    <li class="dropdown-option disabled" title=""
                                                                        data-key="" data-group="#"></li>
                                                                    <li class="dropdown-option selected" title=""
                                                                        data-key="1" data-group="#">Column Name</li>
                                                                    <li class="dropdown-option" title="" data-key="2"
                                                                        data-group="#">Column Name 1</li>
                                                                    <li class="dropdown-option" title="" data-key="3"
                                                                        data-group="#">Column Name 2</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tail-select tail-select w-full form-control-sm mt-2"
                                                        tabindex="0">
                                                        <div class="select-label"><span class="label-inner">Column
                                                                Name</span></div>
                                                        <div class="select-dropdown" style="max-height: 350px;">
                                                            <div class="dropdown-search"><input type="text"
                                                                    class="search-input"
                                                                    placeholder="Type in to search..."></div>
                                                            <div class="dropdown-inner">
                                                                <ul class="dropdown-optgroup" data-group="#">
                                                                    <li class="dropdown-option selected" data-key="1"
                                                                        data-group="#">Column Name</li>
                                                                    <li class="dropdown-option" data-key="2" data-group="#">
                                                                        Column Name 1</li>
                                                                    <li class="dropdown-option" data-key="3" data-group="#">
                                                                        Column Name 2</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div><span class="float-right ml-2 absolute plus" style="margin:0;">
                                                        <a href="javascript:;"><span><svg xmlns="http://www.w3.org/2000/svg"
                                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-trash-2 w-4 h-4 mr-2">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                </svg></span></a>
                                                    </span>
                                                </div>
                                                <div class="form mb-1">
                                                    <select data-search="true"
                                                        class="tail-select w-full form-control-sm mt-2"
                                                        data-select-hidden="display" data-tail-select="tail-2"
                                                        style="display: none;">
                                                        <option disabled=""></option>
                                                        <option value="1" selected="selected">Action is true</option>
                                                        <option value="2">Action is false</option>
                                                    </select>
                                                    <div class="tail-select no-classes hide-disabled" tabindex="0"
                                                        style="display: none;">
                                                        <div class="select-label"><span class="label-inner">Action is
                                                                true</span></div>
                                                        <div class="select-dropdown" style="max-height: 350px;">
                                                            <div class="dropdown-search"><input type="text"
                                                                    class="search-input"
                                                                    placeholder="Type in to search..."></div>
                                                            <div class="dropdown-inner">
                                                                <ul class="dropdown-optgroup" data-group="#">
                                                                    <li class="dropdown-option disabled" title=""
                                                                        data-key="" data-group="#"></li>
                                                                    <li class="dropdown-option selected" title=""
                                                                        data-key="1" data-group="#">Action is true</li>
                                                                    <li class="dropdown-option" title="" data-key="2"
                                                                        data-group="#">Action is false</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tail-select tail-select w-full form-control-sm mt-2"
                                                        tabindex="0">
                                                        <div class="select-label"><span class="label-inner">Action is
                                                                true</span></div>
                                                        <div class="select-dropdown" style="max-height: 350px;">
                                                            <div class="dropdown-search"><input type="text"
                                                                    class="search-input"
                                                                    placeholder="Type in to search..."></div>
                                                            <div class="dropdown-inner">
                                                                <ul class="dropdown-optgroup" data-group="#">
                                                                    <li class="dropdown-option selected" data-key="1"
                                                                        data-group="#">Action is true</li>
                                                                    <li class="dropdown-option" data-key="2" data-group="#">
                                                                        Action is false</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="flex mt-3">
                                                <div class="w-full px-2">
                                                    <div class="form-inline">
                                                        <button type="submit"
                                                            class="btn btn-elevated-primary btn-sm mr-1"><span><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-file-text w-5 h-5 mr-1">
                                                                    <path
                                                                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                                    </path>
                                                                    <polyline points="14 2 14 8 20 8"></polyline>
                                                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                                                    <polyline points="10 9 9 9 8 9"></polyline>
                                                                </svg></span> Apply</button>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-secondary btn-sm mr-1"><span><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-plus-circle w-5 h-5 mr-1">
                                                                    <circle cx="12" cy="12" r="10"></circle>
                                                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                                                </svg></span> Add a condition</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="tabulator-print"
                                    class="w-full btn btn-sm py-2 btn-outline-secondary sm:w-auto mr-2"> <span><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-printer w-4 h-4 mr-2">
                                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                            <path
                                                d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                            </path>
                                            <rect x="6" y="14" width="12" height="8"></rect>
                                        </svg></span> Print </button>
                                <div class="dropdown sm:w-auto">
                                    <button class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto"
                                        aria-expanded="false"> Export <span><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-chevron-down w-4 h-4 ml-auto sm:ml-2">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg></span> </button>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                            <a id="tabulator-export-xlsx" href="javascript:;"
                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-file-text w-4 h-4 mr-2">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                                        <polyline points="10 9 9 9 8 9"></polyline>
                                                    </svg></span> Export XLSX </a>
                                            <a id="tabulator-export-html" href="javascript:;"
                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-file-text w-4 h-4 mr-2">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                                        <polyline points="10 9 9 9 8 9"></polyline>
                                                    </svg></span> Export PDF </a>
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
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Transaction ID
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Date &amp; Time
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Sender Name
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Receiver Name
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon"> Wallet <svg
                                                        xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Debit
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Credit
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Balance
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Status
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="whitespace-nowrap text-left">
                                                <span class="flex short-icon">Reference
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18"></path>
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th class="flex">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 239)"
                                                    style="color:#70297d !important;">15022022398567</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 11:12</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">Testing wallet wallet </td>
                                            <td class="whitespace-nowrap text-left">
                                                ALP Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                A 2079.56
                                            </td>
                                            <td class="whitespace-nowrap text-center"> A 2089.56 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">Tron to Alp 10</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 239)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 238)"
                                                    style="color:#70297d !important;">15022022111119</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 11:12</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">Testing wallet wallet </td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center text-theme-6">
                                                T 10.00
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center"> T 95.52 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">Tron to Alp 10</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 238)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 237)"
                                                    style="color:#70297d !important;">15022022610295</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 11:07</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">Testing wallet wallet </td>
                                            <td class="whitespace-nowrap text-left">
                                                ALP Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                A 10.00
                                            </td>
                                            <td class="whitespace-nowrap text-center"> A 10.00 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">from tron to 10 alp</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 237)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 236)"
                                                    style="color:#70297d !important;">15022022962837</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 11:06</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">Testing wallet wallet </td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center text-theme-6">
                                                T 10.00
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center"> T 105.52 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">from tron to 10 alp</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 236)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 235)"
                                                    style="color:#70297d !important;">15022022906007</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:57</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">Testing wallet wallet </td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                T 10.00
                                            </td>
                                            <td class="whitespace-nowrap text-center"> T 10.00 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">Tron to tron 10</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 235)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 234)"
                                                    style="color:#70297d !important;">15022022912610</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:56</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">Testing wallet wallet </td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center text-theme-6">
                                                T 10.00
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center"> T 115.52 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">Tron to tron 10</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 234)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 233)"
                                                    style="color:#70297d !important;">15022022412036</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:35</td>
                                            <td class="whitespace-nowrap text-left">card</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">
                                                Pay Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                P 0.03
                                            </td>
                                            <td class="whitespace-nowrap text-center"> P 0.03 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">From usd to 10 pay coin</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 233)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 232)"
                                                    style="color:#70297d !important;">15022022465161</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:19</td>
                                            <td class="whitespace-nowrap text-left">Card holder</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                T 4.70
                                            </td>
                                            <td class="whitespace-nowrap text-center"> T 125.52 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">From gbp to to 100 tron</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 232)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 231)"
                                                    style="color:#70297d !important;">15022022017985</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:13</td>
                                            <td class="whitespace-nowrap text-left">card</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                T 96.90
                                            </td>
                                            <td class="whitespace-nowrap text-center"> T 120.82 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">From gbp to 100 tron</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 231)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 230)"
                                                    style="color:#70297d !important;">15022022241756</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:09</td>
                                            <td class="whitespace-nowrap text-left">Card holder</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                T 23.68
                                            </td>
                                            <td class="whitespace-nowrap text-center"> T 23.92 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">From usd to 10000 tron</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 230)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 229)"
                                                    style="color:#70297d !important;">15022022836104</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 10:01</td>
                                            <td class="whitespace-nowrap text-left">Card holder name</td>
                                            <td class="whitespace-nowrap text-left">Demo Wallet</td>
                                            <td class="whitespace-nowrap text-left">
                                                Tron
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                T 0.24
                                            </td>
                                            <td class="whitespace-nowrap text-center"> T 0.24 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">From usd to 100 tron</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 229)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 228)"
                                                    style="color:#70297d !important;">15022022452838</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 05:34</td>
                                            <td class="whitespace-nowrap text-left">Swarna Ronit</td>
                                            <td class="whitespace-nowrap text-left">Smith Torans</td>
                                            <td class="whitespace-nowrap text-left">
                                                ALP Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                A 0.90
                                            </td>
                                            <td class="whitespace-nowrap text-center"> A 0.90 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">dd</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 228)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 227)"
                                                    style="color:#70297d !important;">15022022665182</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 05:33</td>
                                            <td class="whitespace-nowrap text-left">Swarna Ronit</td>
                                            <td class="whitespace-nowrap text-left">Smith Torans</td>
                                            <td class="whitespace-nowrap text-left">
                                                Pay Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center text-theme-6">
                                                P 0.90
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center"> P 0.71 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">dd</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 227)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 226)"
                                                    style="color:#70297d !important;">15022022554110</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">15-02-2022 05:32</td>
                                            <td class="whitespace-nowrap text-left">John Doe</td>
                                            <td class="whitespace-nowrap text-left">Swarna Ronit</td>
                                            <td class="whitespace-nowrap text-left">
                                                Pay Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                P 1.61
                                            </td>
                                            <td class="whitespace-nowrap text-center"> P 1.61 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">Deposit from USD TO PAYCOIN</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 226)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap text-left">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#transaction-detail-modal"
                                                    onclick="Livewire.emit('showTransactionDetail', 225)"
                                                    style="color:#70297d !important;">14022022854877</a>
                                            </td>
                                            <td class="whitespace-nowrap text-left">14-02-2022 19:13</td>
                                            <td class="whitespace-nowrap text-left">Sindhura G</td>
                                            <td class="whitespace-nowrap text-left">Test Wallet Feb eigth</td>
                                            <td class="whitespace-nowrap text-left">
                                                Pay Coin
                                            </td>
                                            <td class="whitespace-nowrap text-center">-</td>
                                            <td class="whitespace-nowrap text-center text-theme-9">
                                                P 0.23
                                            </td>
                                            <td class="whitespace-nowrap text-center"> P 1458.88 </td>
                                            <td class="whitespace-nowrap text-left">Accepted</td>
                                            <td class="whitespace-nowrap text-left">From GBP to Paycoin</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"
                                                        aria-expanded="false"> <svg class="w-5 h-5 text-gray-600"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                            <path
                                                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                            </path>
                                                        </svg> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="javascript:void(0);" data-toggle="modal"
                                                                data-target="#transaction-detail-modal"
                                                                onclick="Livewire.emit('showTransactionDetail', 225)"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <svg class="w-4 h-4 mr-1"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12" r="3"></circle>
                                                                </svg> Show </a>
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
                    <div class="my-2">
                        <nav role="navigation" aria-label="Pagination" class="flex items-center justify-between">
                            <div class="flex justify-between flex-1 sm:hidden">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                    « Previous
                                </span>

                                <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=2"
                                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                    Next »
                                </a>
                            </div>

                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 leading-5">
                                        Showing
                                        <span class="font-medium">1</span>
                                        to
                                        <span class="font-medium">15</span>
                                        of
                                        <span class="font-medium">195</span>
                                        results
                                    </p>
                                </div>

                                <div>
                                    <span class="relative z-0 inline-flex shadow-sm rounded-md">

                                        <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                            <span
                                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                                                aria-hidden="true">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </span>





                                        <span aria-current="page">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>
                                        </span>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=2"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 2">
                                            2
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=3"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 3">
                                            3
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=4"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 4">
                                            4
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=5"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 5">
                                            5
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=6"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 6">
                                            6
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=7"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 7">
                                            7
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=8"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 8">
                                            8
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=9"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 9">
                                            9
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=10"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 10">
                                            10
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=11"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 11">
                                            11
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=12"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 12">
                                            12
                                        </a>
                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=13"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 13">
                                            13
                                        </a>


                                        <a href="https://dev.kanexy.com/dashboard/wallet/transaction?page=2" rel="next"
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                            aria-label="Next &amp;raquo;">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
