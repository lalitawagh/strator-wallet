@extends('ledger-foundation::layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('dist/css/stellar.css') }}"/>
@endpush
@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 xl:col-span-12 mt-0">
        <div class="intro-y mb-3 p-0 sellerTabs">
            <ul class="nav nav-link-tabs pt-2" role="tablist">
                <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                    <button
                        class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail1"
                        type="button" role="tab" aria-controls="seller-detail1" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" icon-name="filter" data-lucide="filter"
                             class="lucide lucide-filter inline-block">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                    </button>
                </li>
                <li id="example-6-tab" class="nav-item flex-1" role="presentation">
                    <button
                        class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#seller-detail2"
                        type="button" role="tab" aria-controls="seller-detail2" aria-selected="false">
                        <img src="{{ asset('dist/images/crypto/7.png') }}"> USDC
                    </button>
                </li>
                <li id="example-6-tab" class="nav-item flex-1" role="presentation">
                    <button
                        class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail3"
                        type="button" role="tab" aria-controls="seller-detail3" aria-selected="false">
                        <img src="{{ asset('dist/images/crypto/5.png') }}"> XLM
                    </button>
                </li>
                <li id="example-6-tab" class="nav-item flex-1" role="presentation">
                    <button
                        class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail4"
                        type="button" role="tab" aria-controls="seller-detail4" aria-selected="false">
                        <img src="{{ asset('dist/images/crypto/6.png') }}"> ETH
                    </button>
                </li>
                <li id="example-6-tab" class="nav-item flex-1" role="presentation">
                    <button
                        class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail5"
                        type="button" role="tab" aria-controls="seller-detail5" aria-selected="false">
                        <img src="{{ asset('dist/images/crypto/6.png') }}"> YUSDC
                    </button>
                </li>
            </ul>
            <div class="tab-content mt-0 p-5">
                <div id="seller-detail1" class="tab-pane leading-relaxed" role="tabpanel"
                     aria-labelledby="example-5-tab">


                </div>
                <div id="seller-detail2" class="tab-pane leading-relaxed active" role="tabpanel"
                     aria-labelledby="example-6-tab">
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="box dark-black">
                                <div class="items-start px-5 py-5">
                                    <div class="w-full flex-col lg:flex-row items-center">
                                        <div class="flex w-full">
                                            <div class="ml-0 mr-auto">
                                                <div class="text-xl 2xl:text-2xl font-medium text-warning">0.0637
                                                    USDC
                                                </div>
                                            </div>
                                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                <img alt="rounded-md border border-white"
                                                     src=" https://kanexydevstorage.blob.core.windows.net/kanexy/walletImages/UGqLTzYltFjuNredUZ2l7JHZ0MUNgvWND6jf80LA.jpg?sv=2017-11-09&sr=b&se=2023-01-16T13:45:42Z&sp=r&spr=https&sig=VkNEFk%2FUr5D4POZ2n%2FfzSv6w4RoXT9CXwAq1JuSZBWE%3D ">
                                            </div>
                                        </div>
                                        <div class="flex-col sm:flex-row">
                                            <div class="text-left pt-3 mr-auto">
                                                <div class="text-xl 2xl:text-2xl font-medium text-white">&#163;
                                                    2456.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="text-center p-0 md:mt-10 mb-4 border-slate-200/60 dark:border-darkmode-400 usdc-wrapper">
                                        <button class="btn btn-send py-1 px-2 mr-2 col">Message</button>
                                        <button class="btn btn-flip py-1 px-2 mr-2 col-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="repeat" data-lucide="repeat"
                                                 class="lucide lucide-repeat block mx-auto">
                                                <path d="M17 2l4 4-4 4"></path>
                                                <path d="M3 11v-1a4 4 0 014-4h14"></path>
                                                <path d="M7 22l-4-4 4-4"></path>
                                                <path d="M21 13v1a4 4 0 01-4 4H3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-recive py-1 px-2 col">Profile</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="box dark-black">
                                <div class="items-start px-5 py-5">
                                    <div class="w-full flex-col lg:flex-row items-center">
                                        <div class="flex w-full">
                                            <div class="ml-0 mr-auto">
                                                <div class="ml-4 mr-auto">
                                                    <div class="font-medium">Price Chart</div>
                                                    <div class="text-success text-xs mt-0.5">&#163; 2456.00</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <img src="{{ asset('dist/images/crypto/pinchart-img.png') }}"
                                         style="max-width: 100%;height: 144px;width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-12 mt-5">
                        <!-- BEGIN: Horizontal Form -->
                        <div class="intro-y box dark-black mt-0 pt-10">
                            <h3 class="text-lg font-medium mb-4 text-white">Enter The Amount To Transfer</h3>
                            <form method="POST" action="{{ route('dashboard.wallet.stellar-exchange-rate') }}">
                            @csrf
                                <div class="grid grid-cols-12 md:gap-0 lg:gap-3 xl:gap-10 mt-0">
                                <div class="col-span-12 md:col-span-6 lg:col-span-4 sm:col-span-6 form-inline mt-2">
                            
                                    <div class="sm:w-full">
                                        <input id="amount" name="amount" type="text"
                                               value=" {{ old('amount') }}" class="form-control text-white"
                                               onKeyPress="return isNumberKey(event);" placeholder="Amount" onpaste="return false;" required>
                                        @error('amount')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-4 sm:col-span-6 form-inline mt-2">
                                    <div class="sm:w-full tillselect-marging" >
                                        <select name="from" id="from"
                                                class="form-control text-white" data-search="true" required>
                                            <option value="" hidden> From </option>
                                            <option value="GBP" > GBP </option>
                                            <option value="XLM" > XLM </option>
                                            <option value="USDC" > USDC </option>
                                            <option value="ETH" > ETH </option>
                                            <option value="YUSDC" > YUSDC </option>

                                            
                                        </select>
                                        @error('from')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-4 sm:col-span-6 form-inline mt-2">
                                    <div class="sm:w-full tillselect-marging" >
                                        <select name="to" id="to"
                                                class="form-control text-white" data-search="true" required>
                                            <option value="" hidden>To  </option>
                                            <option value="" hidden> From </option>
                                            <option value="GBP" > GBP </option>
                                            <option value="XLM" > XLM </option>
                                            <option value="USDC" > USDC </option>
                                            <option value="ETH" > ETH </option>
                                            <option value="YUSDC" > YUSDC </option>
                                        </select>
                                        @error('to')
                                        <span class="block text-theme-6 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="text-right mt-5 py-4">
                                <button type="submit"
                                       class="btn btn-secondary">Convert</button>

                                    {{-- <button class="btn btn-primary w-24 ml-2" @click="step++">Continue</button>
                                <button type="submit"
                                   class="btn btn-secondary">Convert</button>

                                <button class="btn btn-primary w-24 ml-2" >Continue</button> --}}
                            </div>
                            </form>
                            {{-- <div class="grid rounded-lg w-12/12 md:w-6/12 lg:w-6/12 m-auto p-0">
                                <h3 class="text-lg font-medium mb-4 text-white">Enter The Amount To Transfer</h3>
                                <div class="mb-4 ">
                                    
                                    <label for=""
                                           class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Sending</label>

                                    <div class="input-group-text form-inline cuntery-in flex gap-2">
                                        <span class="self-center" id="tabcuntery-img-flag flex mr-3"><img
                                                src="{{ asset('flags/UK.png') }}"></span>
                                        <select class="" id='tabcuntery-selection' style='width: 105px;'
                                                class="flex" name="country_code"
                                                onchange="getFlagImg(this)">
                                            <option>xxx</option>
                                            <option>xxxccc</option>
                                            </select>
                                    </div>
                                </div>

                                <div class="mb-4 relative">
                                    <input
                                        class="dark:bg-darkmode-400 dark:border-darkmode-400 input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"
                                        id="" placeholder="" type="text" autofocus>
                                    <label for=""
                                           class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Sending</label>

                                    <div id="input-group-email"
                                         class="input-group-text form-inline cuntery-in flex gap-2">
                                        <span class="self-center" id="tabcuntery-img-flag flex mr-3"><img
                                                src="{{ asset('flags/UK.png') }}"></span>
                                        <select class="" id='tabcuntery-selection' style='width: 105px;'
                                                class="flex" name="country_code"
                                                onchange="getFlagImg(this)"></select>
                                    </div>
                                </div>

                                <div class="mb-4 relative">
                                    <ul
                                        class="sequence sequence-top sequence-bottom tw-calculator-breakdown tw-calculator-breakdown--detailed sequence-inverse tw-calculator-breakdown--inverse">


                                        <li>
                                            <span
                                                class="sequence-icon tw-calculator-breakdown__icon dark:bg-darkmode-400 dark:border-darkmode-400">–</span>
                                            <span class="tw-calculator-breakdown-item__left"><strong>4.35
                                                    GBP</strong></span>
                                            <span class="tw-calculator-breakdown-item__right">
                                                <span class="m-r-1" data-tracking-id="calculator-payment-select">
                                                    <div class="tw-select btn-group dropdown">
                                                        <div class="dropdown-toggle notification cursor-pointer"
                                                             role="button" aria-expanded="false">

                                                            <button
                                                                class="dropdown-toggle btn px-2 box btn btn-sm btn-secondary mr-4 mb-0"
                                                                aria-expanded="false" data-tw-toggle="dropdown">
                                                                <span
                                                                    class="flex items-center justify-center text-slate-500">
                                                                    Fast & Easy Transfer <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        class="h-4 w-4" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              stroke-width="2"
                                                                              d="M19 9l-7 7-7-7"/>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>


                                                        <div class="dropdown-menu w-auto">
                                                            <div class="dropdown-menu__content box p-2">
                                                                <a href=""
                                                                   class="dropdown-item dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <div
                                                                        class="dark:bg-darkmode-400 dark:border-darkmode-400 cursor-pointer relative items-center cursor-pointer relative items-center px-3 py-1 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md  ">
                                                                        <div class="ml-0 overflow-hidden">
                                                                            <div class="flex items-center">
                                                                                <h4 href="javascript:;"
                                                                                    class="font-medium truncate mr-5">
                                                                                    Fast % easy transfer
                                                                                    -4.39 GBP fee</h4>
                                                                                <div
                                                                                    class="text-xs text-gray-500 ml-auto whitespace-nowrap text-right float-right">
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-6 w-6" fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke="currentColor">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              stroke-width="2"
                                                                                              d="M5 13l4 4L19 7"/>
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="w-full truncate text-gray-500  mt-0.5">
                                                                                Send money from your
                                                                                debit
                                                                                or credit card</div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href=""
                                                                   class="dropdown-item dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <div
                                                                        class="dark:bg-darkmode-400 dark:border-darkmode-400 cursor-pointer relative items-center cursor-pointer relative items-center px-3 py-1 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md  ">
                                                                        <div class="ml-0 overflow-hidden">
                                                                            <div class="flex items-center">
                                                                                <h4 href="javascript:;"
                                                                                    class="font-medium truncate mr-5">
                                                                                    Fast % easy transfer
                                                                                    -4.39 GBP fee</h4>
                                                                                <div
                                                                                    class="text-xs text-gray-500 ml-auto whitespace-nowrap text-right float-right">
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-6 w-6" fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke="currentColor">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              stroke-width="2"
                                                                                              d="M5 13l4 4L19 7"/>
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="w-full truncate text-gray-500  mt-0.5">
                                                                                Send money from your
                                                                                debit
                                                                                or credit card</div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href=""
                                                                   class="dropdown-item dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <div
                                                                        class="dark:bg-darkmode-400 dark:border-darkmode-400 cursor-pointer relative items-center cursor-pointer relative items-center px-3 py-1 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md  ">
                                                                        <div class="ml-0 overflow-hidden">
                                                                            <div class="flex items-center">
                                                                                <h4 href="javascript:;"
                                                                                    class="font-medium truncate mr-5">
                                                                                    Fast % easy transfer
                                                                                    -4.39 GBP fee</h4>
                                                                                <div
                                                                                    class="text-xs text-gray-500 ml-auto whitespace-nowrap text-right float-right">
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-6 w-6" fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke="currentColor">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              stroke-width="2"
                                                                                              d="M5 13l4 4L19 7"/>
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="w-full truncate text-gray-500  mt-0.5">
                                                                                Send money from your
                                                                                debit
                                                                                or credit card</div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a href=""
                                                                   class="dropdown-item dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <div
                                                                        class="dark:bg-darkmode-400 dark:border-darkmode-400 cursor-pointer relative items-center cursor-pointer relative items-center px-3 py-1 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md  ">
                                                                        <div class="ml-0 overflow-hidden">
                                                                            <div class="flex items-center">
                                                                                <h4 href="javascript:;"
                                                                                    class="font-medium truncate mr-5">
                                                                                    Fast % easy transfer
                                                                                    -4.39 GBP fee</h4>
                                                                                <div
                                                                                    class="text-xs text-gray-500 ml-auto whitespace-nowrap text-right float-right">
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        class="h-6 w-6" fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke="currentColor">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              stroke-width="2"
                                                                                              d="M5 13l4 4L19 7"/>
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="w-full truncate text-gray-500  mt-0.5">
                                                                                Send money from your
                                                                                debit
                                                                                or credit card</div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span style="text-transform:none">Fees</span>
                                            </span>

                                        </li>
                                        <li><span
                                                class="sequence-icon tw-calculator-breakdown__icon dark:bg-darkmode-400 dark:border-darkmode-400">=</span>
                                            <span class="tw-calculator-breakdown-item__left">993.33
                                                INR</span>
                                            <span class="tw-calculator-breakdown-item__right">Amount
                                                we'll convert</span>
                                        </li>
                                        <li>
                                            <span
                                                class="sequence-icon tw-calculator-breakdown__icon dark:bg-darkmode-400 dark:border-darkmode-400">x</span>
                                            <span class="tw-calculator-breakdown-item__left">94,97141</span>
                                            <span class="tw-calculator-breakdown-item__right">Exchange
                                                Rate</span>
                                           

                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-4 relative">
                                    <input
                                        class="dark:bg-darkmode-400 dark:border-darkmode-400 input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600"
                                        id="" placeholder="" type="text" autofocus>
                                    <label for=""
                                           class="label absolute mb-0 -mt-0 pt-0 pl-3 leading-tighter text-gray-400 text-base mt-0 cursor-text">Receiving</label>
                                    <div id="input-group-email"
                                         class="input-group-text form-inline cuntery-in flex gap-2">
                                        <span class="self-center" id="tabcuntery-img-flag2"><img
                                                src="{{ asset('flags/UK.png') }}"></span>
                                        <select id='tabcuntery-selection2' style='width: 105px;' class=""
                                                name="country_code" onchange="getFlagImg(this)">


                                        </select>
                                    </div>
                                    
                                </div>
                                
                                <div class="text-right mt-5 py-4">
                                    <a data-tw-toggle="modal" data-tw-target="#large-slide-over-size-preview"
                                       class="btn btn-secondary">Compare Price</a>

                                    <button class="btn btn-primary w-24 ml-2" @click="step++">Continue</button>
                                </div>
                            </div> --}}

                            @if(!is_null($exchangedAmount))
                            <div class="text-right">
                            <h4 class="text-xl 2xl:text-2xl font-medium text-white">{{ $amount }} {{ $currency}} =</h4>
                            <h6 class="text-xl 2xl:text-2xl font-medium text-white">{{ $exchangedAmount}} {{ $conversionCurrency}}</h6>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div id="seller-detail3" class="tab-pane leading-relaxed" role="tabpanel"
                     aria-labelledby="example-6-tab">
                    3
                </div>
                <div id="seller-detail4" class="tab-pane leading-relaxed" role="tabpanel"
                     aria-labelledby="example-6-tab">
                    4
                </div>
                <div id="seller-detail5" class="tab-pane leading-relaxed" role="tabpanel"
                     aria-labelledby="example-6-tab">
                    5
                </div>
            </div>
        </div>
    </div>
</div>
<div class="seller-menu gap-6 gap-6 px-5 pt-5 pb-3">
    <ul>
        <li>
            <a  href="{{ route('dashboard.wallet.stellar-dashboard') }}">
                <img src="{{ asset('dist/images/crypto/menu-icon1.svg') }}">
            </a>
        </li>
        <li>
            <a class="cryptoMenu-active" href="{{ route('dashboard.wallet.stellar-exchange-rate') }}">
                <img src="{{ asset('dist/images/crypto/menu-icon2.svg') }}">
            </a>
        </li>
        <li>
            <a href="">
                <img src="{{ asset('dist/images/crypto/menu-icon3.svg') }}">
            </a>
        </li>
        <li>
            <a href="{{ route('dashboard.wallet.stellar-payouts.create', ['filter' => ['workspace_id' => \Kanexy\PartnerFoundation\Core\Helper::activeWorkspaceId()]]) }}">
                <img src="{{ asset('dist/images/crypto/menu-icon4.svg') }}">
            </a>
        </li>

    </ul>
</div>
@endsection

@push('scripts')
        <script>
            $url = window.location.pathname.split('/');
            if ($url[3] == 'stellar-exchange-rate') {
                $('#color-scheme-content').addClass('dark');
            }
        </script>
@endpush