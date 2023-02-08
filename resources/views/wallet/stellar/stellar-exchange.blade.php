

@extends('ledger-foundation::wallet.stellar.skeleton')

@section('stellar-content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 xl:col-span-6 mt-0">
            <div class="box dark-black">
                <div class="ml-0 mr-auto py-5 px-5">
                    <div class="text-xl 2xl:text-2xl font-medium text-white">Exchange Money
                    </div>
                </div>
                <div class="intro-y mb-3 p-0 sellerTabs">

                    <ul class="nav nav-link-tabs pt-2 px-5" role="tablist">
                        <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#half"
                                type="button" role="tab" aria-controls="half" aria-selected="false">
                                Half</button>
                        </li>
                        <li id="example-6-tab" class="nav-item flex-1" role="presentation"> <button
                                class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#min" type="button"
                                role="tab" aria-controls="min" aria-selected="false">
                                Min</button> </li>
                        <li id="example-6-tab" class="nav-item flex-1" role="presentation"> <button
                                class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#all" type="button"
                                role="tab" aria-controls="all" aria-selected="false">
                                All </button> </li>

                    </ul>
                    <div class="tab-content mt-0 p-5">
                        <div id="half" class="tab-pane leading-relaxed active" role="tabpanel"
                            aria-labelledby="example-5-tab">

                            <div class="intro-y col-span-12 lg:col-span-12 mt-0">
                                <!-- BEGIN: Horizontal Form -->
                                <div class="intro-y mt-0 pt-5">
                                    <div class="py-4 rounded-lg w-12/12 md:w-8/12 lg:w-8/12 m-auto">
                                        <h3 class="text-lg font-medium mb-4 text-white">Enter The Amount To Transfer</h3>
                                        <div class="mb-2 relative">
                                            <input
                                                class="text-white dark:bg-darkmode-400 dark:border-darkmode-400 input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-10 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"
                                                id="" placeholder="&#163; 250.00" type="text" autofocus>
                                            <label for=""
                                                class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">&#163;
                                                EURO</label>

                                            <div id="input-group-email"
                                                class="dropdown input-group-text form-inline exchange-euro flex">
                                                <button class="dropdown-toggle -mt-10 text-xs" aria-expanded="false"
                                                    data-tw-toggle="dropdown">EURO <i data-lucide="chevron-down"
                                                        class="w-4 h-4 ml-0"></i></button>
                                                <div class="dropdown-menu w-40">
                                                    <ul class="dropdown-content">
                                                        <li> <a href="" class="dropdown-item">New Dropdown</a> </li>
                                                        <li> <a href="" class="dropdown-item">Delete Dropdown</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div
                                                class="flip-icon w-8 h-8 flex-none image-fit rounded-md overflow-hidden flip-img">
                                                <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                            </div>

                                        </div>

                                        <div class="mb-4 relative">
                                            <input
                                                class="text-white dark:bg-darkmode-400 dark:border-darkmode-400 input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-10 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"
                                                id="" placeholder="&#x24; 250.00" type="text" autofocus>
                                            <label for=""
                                                class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">&#x24;
                                                USD</label>

                                            <div id="input-group-email"
                                                class="dropdown input-group-text form-inline exchange-euro flex">
                                                <button class="dropdown-toggle -mt-10 text-xs" aria-expanded="false"
                                                    data-tw-toggle="dropdown">American Dollar <i data-lucide="chevron-down"
                                                        class="w-4 h-4 ml-0"></i></button>
                                                <div class="dropdown-menu w-40">
                                                    <ul class="dropdown-content">
                                                        <li> <a href="" class="dropdown-item">New Dropdown</a>
                                                        </li>
                                                        <li> <a href="" class="dropdown-item">Delete Dropdown</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="py-4 rounded-lg w-12/12 md:w-12/12 lg:w-12/12">
                                            <a data-tw-toggle="modal" data-tw-target="#large-slide-over-size-preview"
                                                class="col-span-12 lg:col-span-12 block btn org-clr py-2 px-2 mr-0 ">Exchange</a>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div id="min" class="tab-pane leading-relaxed" role="tabpanel"
                            aria-labelledby="example-6-tab">
                            2

                        </div>
                        <div id="all" class="tab-pane leading-relaxed" role="tabpanel"
                            aria-labelledby="example-6-tab">
                            3
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="col-span-12 xl:col-span-6 mt-0">
            <div class="ml-0 mr-auto py-0 px-0 box dark-black">
                <div class="text-xl 2xl:text-2xl font-medium text-white py-5 px-5">Previous Transactions
                </div>
                <div class="sellerTabs">
                    <div class="intro-y mb-3 p-0 tab-content ">
                        <div class="tab-content mt-0 p-5 p-4 rounded-lg w-12/12 md:w-8/12 lg:w-8/12 m-auto">
                            <div class="mt-0">
                                <div class="intro-y">
                                    <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                        <div class="ml-2">
                                            <div class="font-medium">&#163; 1200.00</div>
                                            <div class="text-success text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                        <div
                                            class="flip-icon m-auto w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                            <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                        </div>
                                        <div class="text-right">
                                            <div class="font-medium">&#x24; 945.87</div>
                                            <div class="text-slate-500 text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                        <div class="ml-2">
                                            <div class="font-medium">&#x24; 750.00</div>
                                            <div class="text-success text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                        <div
                                            class="flip-icon m-auto w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                            <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                        </div>
                                        <div class="text-right">
                                            <div class="font-medium">&#163; 350.87</div>
                                            <div class="text-slate-500 text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="intro-y">
                                    <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                        <div class="ml-2">
                                            <div class="font-medium">&#163; 1200.00</div>
                                            <div class="text-success text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                        <div
                                            class="flip-icon m-auto w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                            <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                        </div>
                                        <div class="text-right">
                                            <div class="font-medium">&#x24; 945.87</div>
                                            <div class="text-slate-500 text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                        <div class="ml-2">
                                            <div class="font-medium">&#x24; 750.00</div>
                                            <div class="text-success text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                        <div
                                            class="flip-icon m-auto w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                            <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                        </div>
                                        <div class="text-right">
                                            <div class="font-medium">&#163; 350.87</div>
                                            <div class="text-slate-500 text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                        <div class="ml-2">
                                            <div class="font-medium">&#163; 1200.00</div>
                                            <div class="text-success text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                        <div
                                            class="flip-icon m-auto w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                            <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                        </div>
                                        <div class="text-right">
                                            <div class="font-medium">&#x24; 945.87</div>
                                            <div class="text-slate-500 text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-y">
                                    <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                        <div class="ml-2">
                                            <div class="font-medium">&#x24; 750.00</div>
                                            <div class="text-success text-xs mt-0.5">14-05-2021</div>
                                        </div>
                                        <div
                                            class="flip-icon m-auto w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                            <img src="{{ asset('dist/images/crypto/flip-img.png') }}">
                                        </div>
                                        <div class="text-right">
                                            <div class="font-medium">&#163; 350.87</div>
                                            <div class="text-slate-500 text-xs mt-0.5">14-05-2021</div>
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
