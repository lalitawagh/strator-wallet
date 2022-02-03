<div class="intro-y lg:overflow-visible mt-3 sm:mt-10">
    <div class="sm:flex items-center p-2 sm:py-0 border-b border-gray-200 dark:border-dark-5">
        <!--<div class="nav nav-tabs mr-auto hidden sm:flex" role="tablist">
            <a id="work-in-progress-mobile-new-tab" data-toggle="tab" data-target="#work-in-progress-new" href="javascript:;" class="py-2 ml-0 active" role="tab" aria-selected="true">ALL</a>
        --><!-- <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-2 ml-6" role="tab" aria-selected="false">ASSIGNED TO ME</a>  --><!--
        </div>-->
        <div class="flex items-center md:ml-auto mb-2">
            <div class="col-span-6 sm:col-span-3 lg:col-span-2 xl:col-span-1 search hidden sm:block mr-2 ml-auto">
                <input list="browsers" name="browser" id="browser" placeholder="Search" class="search__input form-control border-transparent placeholder-theme-13">
                <span wire:ignore><i data-feather="search" class="search__icon dark:text-gray-300"></i></span>
            </div>
        </div>
    </div>

    <div class="intro-y box p-3 mt-0">
        <div class=" overflow-auto lg:overflow-visible">
            <table id="tableID" class="shroting display table table-report -mt-2" style="width:100%">
                <thead class="short-wrp">
                    <tr>
                        <!--<th>
                            <div class="form-check mt-1 border-gray-400">
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label" for="checkbox-switch-1"></label>
                            </div>
                        </th>-->
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">URN
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Date
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Wallet
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Description
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Status
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Fee
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th class="whitespace-nowrap text-left">
                            <span class="flex short-icon">Balance
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" /></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="#c1c4c9" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" /></svg>
                            </span>
                        </th>
                        <th  class="flex" style="width:40px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x">
                        <!--<td>
                            <div class="form-check mt-1 border-gray-400">
                                <input id="checkbox-switch-1" class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label" for="checkbox-switch-1"></label>
                            </div>
                        </td>-->
                        <td>{{$wallet_urn}}</td>
                        <td>28 Aug 2021</td>
                        <td>Pay Coin</td>
                        <td>Recieve Pay coin</td>
                        <td>Success</td>
                        <td>30</td>
                        <td>-20</td>
                        <td class="table-report__action">
                            <div class="absolute top-0 mt-2 dropdown">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <span wire:ignore><i data-feather="settings" class="w-5 h-5 text-gray-600"></i></span> </a>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-menu__content box p-2">
                                        <a href="#" data-toggle="modal" data-target="#transaction-detail-modal" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <span wire:ignore><i data-feather="eye" class="w-4 h-4 mr-1"></i></span> View </a>
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
