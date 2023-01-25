@extends('ledger-foundation::layouts.master')
@push('styles')
    <style>
        .input {
            transition: border 0.2s ease-in-out;
            min-width: 280px;
            border-radius: 10px;
        }

        .input:focus+.label,
        .input:active+.label,
        .input.filled+.label {
            font-size: .75rem;
            transition: all 0.2s ease-out;
            top: -0.1rem;
            color: #667eea;
        }

        .label {
            transition: all 0.2s ease-out;
            top: 0.4rem;
            left: 0;
            font-size: 0.75rem;
        }

        .sequence.tw-calculator-breakdown {
            padding-left: 8px;
            margin-left: 40px;
        }

        .sequence.sequence-top>li:first-child {
            padding-top: 0px;
            margin-top: 0px;
        }

        .sequence>li:first-child {
            margin-top: 16px;
        }

        .sequence-inverse>li {
            border-color: #253655;
        }

        .sequence>li {
            display: block;
            line-height: 32px;
            position: relative;
            border-color: #d3d5d8;
            margin-bottom: 24px;
        }

        .sequence.tw-calculator-breakdown--inverse>li:after,
        .sequence.tw-calculator-breakdown--inverse>li:before {
            background-color: #253655;
            border-color: #253655;
        }

        .sequence>li:before {
            content: "";
            display: block;
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            z-index: 2;
            border: 4px solid;
            border-color: inherit;
            outline: 0;
        }

        .sequence.tw-calculator-breakdown--inverse .tw-calculator-breakdown-item__left,
        .sequence.tw-calculator-breakdown--inverse .tw-calculator-breakdown-item__right {
            color: #d3d5d8;
        }

        .sequence.tw-calculator-breakdown .tw-calculator-breakdown-item__left {
            display: inline-block;
            margin-right: 8px;
            color: #2e4369;
        }

        .sequence.tw-calculator-breakdown .tw-calculator-breakdown-item__right {
            display: inline-block;
            padding-top: 0;
            padding-bottom: 0;
        }

        .dropdown,
        .dropup {
            position: relative;
        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
        }

        .sequence.sequence-top>li:first-child:after {
            height: calc(100% + 16px);
        }

        .sequence.tw-calculator-breakdown--inverse>li:after,
        .sequence.tw-calculator-breakdown--inverse>li:before {
            background-color: #253655;
            border-color: #253655;
        }

        .sequence.tw-calculator-breakdown>li:after {
            background-color: #e2e6e8;
            left: -33px;
            height: 100px;
        }

        .sequence-top>li:first-child:after {
            top: 0;
        }

        .sequence>li:after {
            content: "";
            position: absolute;
            width: 2px;
            height: 100%;
            border: 0 solid;
            border-color: inherit;
            outline: 0;
            background-color: #d3d5d8;
            background-size: 200% 200%;
            background-position: 0 0;
        }

        .sequence.tw-calculator-breakdown>li:before {
            margin-top: -8px;
            margin-left: -36px;
            border-color: #e2e6e8;
        }

        .sequence>li:after {
            border-width: 0;
        }

        .sequence-icon {
            position: absolute;
            display: block;
            margin-left: -44px;
            background-color: #fff;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            line-height: 23px;
            z-index: 2;
            text-align: center;
            text-decoration: none !important;
            border: 1px solid #5d7079;
            top: 4px;
            font-size: 12px;
        }

        .sequence.tw-calculator-breakdown--inverse .tw-calculator-breakdown-item__left,
        .sequence.tw-calculator-breakdown--inverse .tw-calculator-breakdown-item__right {
            color: #8e8e8e;
        }


        .exchange-euro {
            position: absolute;
            right: 0px;
            min-height: 54px;
            top: 50%;
            transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            padding: 5px 8px;
            border-radius: 10px;
        }


        span.lock-amount {
            position: absolute;
            right: 14rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .input-group-prepend span {
            display: inline-block;
            float: left;
            background: transparent;
            border: none;
        }

        .input-group-prepend select {
            float: right;
            display: inline-block;
            width: auto;
            margin: 0;
            border: none;
            box-shadow: none;
        }

        .input-group-prepend {
            border: 1px solid #ddd;
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
        }

        .send-exaxtly {
            background: transparent;
            line-height: 42px;
            padding-left: 25px;
        }

        .send-exaxtly:after {
            position: absolute;
            content: "";
            height: 43px;
            background-color: #c2cce9;
            width: 2px;
            left: 0;
        }

        .notification-content.dropdown-menu.show {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(607px, 470px) !important;
        }

        td.list-dot:after {
            content: "";
            position: absolute;
            width: 2px;
            height: 100%;
            border: 0 solid;
            border-color: inherit;
            outline: 0;
            background-color: #d3d5d8;
            background-size: 200% 200%;
            background-position: 0 0;
        }

        td.list-dot:before {
            content: "";
            position: absolute;
            width: 8px;
            height: 100%;
            border: 0 solid;
            border-color: inherit;
            outline: 0;
            background-color: #d3d5d8;
            background-size: 200% 200%;
            background-position: 0 0;
            height: 8px;
            border-radius: 50px;
        }

        .ttt tr td:first-child {
            width: 30%;
            padding-right: 20px;
        }

        td.list-dot {
            position: relative;
        }

        td.list-dot:before {
            margin-top: -7px;
            margin-left: -3px;
            border-color: #e2e6e8;
        }

        td.list-dot:after {
            background-color: #e2e6e8;
            left: 1px;
        }

        table.ttt tr td {
            padding-bottom: 20px;
            vertical-align: top;
        }

        .modal-dialog .select-label {
            min-height: 36px;
        }

        .modal-dialog .input-group-prepend {
            padding: 5px;
        }

        .modal-dialog .input-group-prepend span.input-group-text {
            padding: 5px 0;
        }

        .accordion .accordion-item {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        @media (max-width: 991px) {
            .notification-content.dropdown-menu.show {
                position: absolute;
                top: 0;
                right: 0;
                transform: translate(416px, 690px) !important;
            }
        }

        @media (max-width: 767px) {
            .notification-content.dropdown-menu.show {
                width: auto;
                transform: translate3d(260px, 816px, 0px) !important;
            }
        }

        @media (max-width: 580px) {
            .notification-content.dropdown-menu.show {
                width: auto;
                transform: translate3d(0px, 895px, 0px) !important;
            }
        }
    </style>
@endpush
@section('content')
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
        <!--Menu Design-->
        <div class="seller-menu gap-6 gap-6 px-5 pt-5 pb-3">
            <ul>

                <li>
                    <a href="{{ route('dashboard.wallet.crypto-account') }}">
                        <img src="{{ asset('dist/images/crypto/menu-icon1.svg') }}">
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="{{ asset('dist/images/crypto/menu-icon2.svg') }}">
                    </a>
                </li>
                <li>
                    <a class="cryptoMenu-active" href="{{ route('dashboard.wallet.stellar-exchange') }}">
                        <img src="{{ asset('dist/images/crypto/menu-icon4.svg') }}">
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.wallet.buying-crypto') }}">
                        <img src="{{ asset('dist/images/crypto/menu-icon3.svg') }}">
                    </a>
                </li>

            </ul>
        </div>
        <!--Menu Design-->
    </div>
@endsection
