@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Payout List')

@section('content')
    <div class="grid grid-cols-12  gap-3">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12 mt-4">
            <div class="grid grid-cols-12 gap-3">
                <!-- BEGIN: -->
                <div class="intro-y box col-span-12 lg:col-span-12 xxl:col-span-12 p-4">
                <div id="1" class="tab-pane grid grid-cols-12 gap-3 pt-0" role="tabpanel" aria-labelledby="1-tab">
                <div class="active col-span-12 mt-0 w-full" role="tabpanel" id="k-wallet" aria-labelledby="k-wallet-tab">

                    <div class="intro-y lg:overflow-visible mt-3 sm:mt-0">

                        <div class="sm:flex items-center p-2 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <div class="nav nav-tabs mr-auto hidden sm:flex" role="tablist">
                                <a id="work-in-progress-mobile-new-tab" data-toggle="tab" data-target="#work-in-progress-new" href="javascript:;" class="py-2 ml-0 active" role="tab" aria-selected="true">Wallet Payout List</a>
                                <!-- <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-2 ml-6" role="tab" aria-selected="false">ASSIGNED TO ME</a>  -->
                            </div>
                            <div class="flex items-center md:ml-auto mb-2">
                            <div class="dark:text-gray-300">1 of 50</div>
                                <a href="javascript:;" class="w-5 h-5 ml-1 flex items-center justify-center dark:text-gray-300"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-5 h-5"><polyline points="15 18 9 12 15 6"></polyline></svg> </a>
                                <a href="javascript:;" class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-5 h-5"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>

                                <a href="design/transactionlist" class="ml-auto w-5 h-5 ml-2 mr-2 flex items-center justify-center dark:text-gray-300"> <i class="w-4 h-4" data-feather="list"></i></a>
                                <a href="/design/cxrmcontact" class="w-5 h-5 mr-2 flex items-center justify-center dark:text-gray-300"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="#c1c4c9">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg> </a>


                            </div>

                            <div class="flex sm:flex mt-5 sm:mt-0" style="margin-top:-6px;">

                                <div class="dropdown sm:w-auto mr-2">
                                    <button class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto" aria-expanded="false"><i data-feather="filter" class="w-4 h-4 ml-auto sm:ml-0 mr-2"></i> Filter <i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
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
                                                    <a href="javascript:;"><i data-feather="trash-2" class="w-4 h-4 mr-2"></i></a>
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
                                                        <button type="submit" class="btn btn-elevated-primary btn-sm mr-1"><i data-feather="file-text" class="w-5 h-5 mr-1"></i> Apply</button>
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-sm mr-1"><i data-feather="plus-circle" class="w-5 h-5 mr-1"></i> Add a condition</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="tabulator-print" class="w-full btn btn-sm py-2 btn-outline-secondary sm:w-auto mr-2"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </button>
                                <div class="dropdown sm:w-auto">
                                    <button class="dropdown-toggle btn btn-sm py-2 btn-outline-secondary w-full sm:w-auto" aria-expanded="false">  Export <i data-feather="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                            <a id="tabulator-export-xlsx" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export XLSX </a>
                                            <a id="tabulator-export-html" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export PDF </a>
                                        </div>
                                    </div>
                                </div>
                                <a  href="{{ route('dashboard.ledger-foundation.wallet-payout.create') }}" class="btn btn-sm btn-primary ml-2">Payout</a>
                            </div>
                        </div>
                        <!-- BEGIN: HTML Table Data -->
                        <div class="intro-y box p-3 mt-0">
                            <div class=" overflow-auto lg:overflow-visible">
                                <!-- <div id="tabulator" class="mt-5 table-report table-report--tabulator"></div> -->

                                <table id="tableID" class="shroting display table table-report -mt-2" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </th>

                                            <th class="whitespace-nowrap text-left">Student ID</th>
                                            <th class="whitespace-nowrap text-left">Student Name</th>
                                            <th class="whitespace-nowrap text-left">Age</th>
                                            <th class="whitespace-nowrap text-left">Gender</th>
                                            <th class="whitespace-nowrap text-left">Marks Scored</th>
                                            <th style="width:40px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="intro-x">
                                            <td>
                                                <div class="form-check mt-1 border-gray-400">
                                                    <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                                    <label class="form-check-label" for="checkbox-switch-1"></label>
                                                </div>
                                            </td>

                                            <td>ST1</td>
                                            <td>Prema</td>
                                            <td>35</td>
                                            <td>Female</td>
                                            <td>320</td>
                                            <td class="table-report__action">
                                                <div class="absolute top-0 mt-2 dropdown">
                                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="settings" class="w-5 h-5 text-gray-600"></i> </a>
                                                    <div class="dropdown-menu w-40">
                                                        <div class="dropdown-menu__content box p-2">
                                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="refresh-cw" class="w-4 h-4 mr-2"></i> Update </a>
                                                            <a href=""  data-toggle="modal"
                                                            data-target="#pauoutwalletdetailpopup-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="eye" class="w-4 h-4 mr-1"></i> View </a>
                                                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
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

    <!-- BEGIN: Modal Content -->
    <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Broadcast Message
                    </h2>
                    <button class="btn btn-outline-secondary hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </button>
                    <div class="dropdown sm:hidden">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-600"></i> </a>
                        <div class="dropdown-menu w-40">
                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-1" class="form-label">From</label>
                        <input id="modal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-2" class="form-label">To</label>
                        <input id="modal-form-2" type="text" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-3" class="form-label">Subject</label>
                        <input id="modal-form-3" type="text" class="form-control" placeholder="Important Meeting">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-4" class="form-label">Has the Words</label>
                        <input id="modal-form-4" type="text" class="form-control" placeholder="Job, Work, Documentation">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-5" class="form-label">Doesn't Have</label>
                        <input id="modal-form-5" type="text" class="form-control" placeholder="Job, Work, Documentation">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-6" class="form-label">Size</label>
                        <select id="modal-form-6" class="form-select">
                            <option>10</option>
                            <option>25</option>
                            <option>35</option>
                            <option>50</option>
                        </select>
                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-20">Save</button>
                </div>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
    <!-- END: Modal Content -->

    <!--pauout wallet detail popup-->
    <div id="pauoutwalletdetailpopup-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h2 class="font-medium text-base mr-auto">Payout Details</h2>
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
