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



        .cuntery-in {
            background-color: #f15151;
            width: auto;
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
        <div class="col-span-12 xl:col-span-8 mt-0">
            <!-- BEGIN: Single Item -->
            <div class="intro-y mb-3">
                <!-- BEGIN: Multiple Item -->
                <div class="mt-0">

                    <div id="multiple-item-slider" class="p-0">
                        <div class="preview">
                            <div class="mx-0">
                                <div class="multiple-items">
                                    <div class="h-24 px-2" style="height: 9rem;">
                                        <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                            <div class="h-full font-medium items-center justify-center text-2xl">
                                                <div class="sellerSlide-box">
                                                    <div class="box p-3">
                                                        <div class="flex">
                                                            <div
                                                                class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                                <img src="{{ asset('dist/images/crypto/Ethereum.png') }}">
                                                            </div>
                                                            <div class="ml-4 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">Ethereum
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">4 November 2022
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="flex flex-col sm:flex-row">
                                                            <div class="text-left pt-3 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">+ 0.84756 BTC
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                                                            </div>
                                                            <div class="ml-auto pt-3">
                                                                <div
                                                                    class="bg-success/20 text-success rounded text-xs px-2 mt-1.5">
                                                                    +150
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="h-24 px-2" style="height: 9rem;">
                                        <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                            <div class="h-full font-medium items-center justify-center text-2xl">
                                                <div class="sellerSlide-box">
                                                    <div class="box p-3">
                                                        <div class="flex">
                                                            <div
                                                                class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                                <img src="{{ asset('dist/images/crypto/Solana.png') }}">
                                                            </div>
                                                            <div class="ml-4 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">Solana
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">4 November 2022
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="flex flex-col sm:flex-row">
                                                            <div class="text-left pt-3 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">+ 0.84756 BTC
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                                                            </div>
                                                            <div class="ml-auto pt-3">
                                                                <div
                                                                    class="bg-pending/10 text-success rounded text-xs px-2 mt-1.5">
                                                                    +150
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-24 px-2" style="height: 9rem;">
                                        <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                            <div class="h-full font-medium items-center justify-center text-2xl">
                                                <div class="sellerSlide-box">
                                                    <div class="box p-3">
                                                        <div class="flex">
                                                            <div
                                                                class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                                <img src="{{ asset('dist/images/crypto/EOSIO.png') }}">
                                                            </div>
                                                            <div class="ml-4 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">EOSIO
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">4 November 2022
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="flex flex-col sm:flex-row">
                                                            <div class="text-left pt-3 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">+ 0.84756 BTC
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                                                            </div>
                                                            <div class="ml-auto pt-3">
                                                                <div
                                                                    class="bg-primary/10 text-success rounded text-xs px-2 mt-1.5">
                                                                    +150
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-24 px-2" style="height: 9rem;">
                                        <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                            <div class="h-full font-medium items-center justify-center text-2xl">
                                                <div class="sellerSlide-box">
                                                    <div class="box p-3">
                                                        <div class="flex">
                                                            <div
                                                                class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                                <img src="{{ asset('dist/images/crypto/Cardano.png') }}">
                                                            </div>
                                                            <div class="ml-4 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">Cardano
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">4 November 2022
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="flex flex-col sm:flex-row">
                                                            <div class="text-left pt-3 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">+ 0.84756 BTC
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                                                            </div>
                                                            <div class="ml-auto pt-3">
                                                                <div
                                                                    class="bg-success/20 text-success rounded text-xs px-2 mt-1.5">
                                                                    +150
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-24 px-2" style="height: 9rem;">
                                        <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                            <div class="h-full font-medium items-center justify-center text-2xl">
                                                <div class="sellerSlide-box">
                                                    <div class="box p-3">
                                                        <div class="flex">
                                                            <div
                                                                class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                                <img src="{{ asset('dist/images/crypto/Monero.png') }}">
                                                            </div>
                                                            <div class="ml-4 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">Monero
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">4 November 2022
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="flex flex-col sm:flex-row">
                                                            <div class="text-left pt-3 mr-auto">
                                                                <div class="text-xl 2xl:text-2xl font-medium">+ 0.84756 BTC
                                                                </div>
                                                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                                                            </div>
                                                            <div class="ml-auto pt-3">
                                                                <div
                                                                    class="bg-primary/10 text-success rounded text-xs px-2 mt-1.5">
                                                                    +150
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

                    </div>
                </div>
                <!-- END: Multiple Item -->


            </div>
            <!-- END: Single Item -->
            <div class="intro-y mb-3">
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 lg:col-span-6 mt-0">

                    <div class="intro-y box p-5 mt-12 sm:mt-0">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="flex">
                                <div>
                                    <div class="mt-0.5 text-slate-500">Portfolio Balance</div>
                                    <div class="text-primary dark:text-slate-300 text-lg xl:text-xl font-medium">
                                        $354.451.02
                                    </div>

                                </div>

                                <div>
                                    <div class="text-success text-slate-500 text-xs mt-0.5">+$104</div>

                                </div>
                            </div>
                            <div class="dropdown md:ml-auto mt-5 md:mt-0">
                                <button class="dropdown-toggle btn btn-outline-secondary font-normal"
                                    aria-expanded="false" data-tw-toggle="dropdown"> Monthaly <i
                                        data-lucide="chevron-down" class="w-4 h-4 ml-2"></i> </button>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content overflow-y-auto h-32">
                                        <li><a href="" class="dropdown-item">PC & Laptop</a></li>
                                        <li><a href="" class="dropdown-item">Smartphone</a></li>
                                        <li><a href="" class="dropdown-item">Electronic</a></li>
                                        <li><a href="" class="dropdown-item">Photography</a></li>
                                        <li><a href="" class="dropdown-item">Sport</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="report-chart">
                            <div class="h-[275px]">
                                <canvas id="report-line-chart" class="mt-6 -mb-6"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
            </div>

            <!-- BEGIN: Weekly Top Products -->
            <div class="intro-y box mb-3 p-5">
                <div class="col-span-12 mt-0">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            My Portfolio
                        </h2>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">

                        </div>
                    </div>
                    <div class="intro-y overflow-x-auto overflow-y-hidden mt-8 sm:mt-0">
                        <table class="table table-report sm:mt-2 seller-list">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Coin</th>
                                    <th class="whitespace-nowrap">Price</th>
                                    <th class="whitespace-nowrap">In</th>
                                    <th class="whitespace-nowrap">24 Volume </th>
                                    <th class="whitespace-nowrap">Market Cop</th>
                                    <th class="whitespace-nowrap">Last 7 Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 flex-none rounded-md overflow-hidden mr-2">
                                                <img alt="rounded-md border border-white"
                                                    src=" https://kanexydevstorage.blob.core.windows.net/kanexy/walletImages/UGqLTzYltFjuNredUZ2l7JHZ0MUNgvWND6jf80LA.jpg?sv=2017-11-09&amp;sr=b&amp;se=2023-01-16T13:45:42Z&amp;sp=r&amp;spr=https&amp;sig=VkNEFk%2FUr5D4POZ2n%2FfzSv6w4RoXT9CXwAq1JuSZBWE%3D ">
                                            </div>
                                            <div class="">
                                                <div class="font-medium">Bitcoin</div>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="text-success">+$98</div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="px-10 sm:px-0">
                                            <div class="">
                                                <canvas class="simple-line-chart-3"></canvas>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 flex-none rounded-md overflow-hidden mr-2">
                                                <img alt="rounded-md border border-white"
                                                    src=" https://kanexydevstorage.blob.core.windows.net/kanexy/walletImages/UGqLTzYltFjuNredUZ2l7JHZ0MUNgvWND6jf80LA.jpg?sv=2017-11-09&amp;sr=b&amp;se=2023-01-16T13:45:42Z&amp;sp=r&amp;spr=https&amp;sig=VkNEFk%2FUr5D4POZ2n%2FfzSv6w4RoXT9CXwAq1JuSZBWE%3D ">
                                            </div>
                                            <div class="">
                                                <div class="font-medium">Bitcoin</div>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="text-danger">+$98</div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="px-10 sm:px-0">
                                            <div class="">
                                                <canvas class="simple-line-chart-4"></canvas>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 flex-none rounded-md overflow-hidden mr-2">
                                                <img alt="rounded-md border border-white"
                                                    src=" https://kanexydevstorage.blob.core.windows.net/kanexy/walletImages/UGqLTzYltFjuNredUZ2l7JHZ0MUNgvWND6jf80LA.jpg?sv=2017-11-09&amp;sr=b&amp;se=2023-01-16T13:45:42Z&amp;sp=r&amp;spr=https&amp;sig=VkNEFk%2FUr5D4POZ2n%2FfzSv6w4RoXT9CXwAq1JuSZBWE%3D ">
                                            </div>
                                            <div class="">
                                                <div class="font-medium">Bitcoin</div>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="text-info">+$98</div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        + 0.84756 BTC
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="px-10 sm:px-0">
                                            <div class="">
                                                <canvas class="simple-line-chart-3"></canvas>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- END: Weekly Top Products -->
        </div>
        <!-- BEGIN: Weekly Best Sellers -->
        <div class="col-span-12 xl:col-span-4 mt-0">
            <div class="intro-y box p-3">
                <div class="intro-y flex items-center pb-3">
                    <h2 class="text-lg font-medium mr-auto">
                        Transactions
                    </h2>
                    <a class="block" href="{{ route('dashboard.wallet.crypto-account') }}">
                        <button class="btn btn-sm org-clr py-1 px-2 mr-0 col">Create an Crypto Account</button>
                    </a>
                </div>
                <div class="mt-0">
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/Ethereum.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Bruce Willis</div>
                                <div class="text-success text-xs mt-0.5">4 November 2022</div>
                            </div>

                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/Solana.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Angelina Jolie</div>
                                <div class="text-success text-xs mt-0.5">8 October 2022</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/EOSIO.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Denzel Washington</div>
                                <div class="text-success text-xs mt-0.5">14 March 2021</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/Cardano.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Al Pacino</div>
                                <div class="text-success text-xs mt-0.5">20 July 2022</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/Monero.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Angelina Jolie</div>
                                <div class="text-success text-xs mt-0.5">8 October 2022</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/Tether.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Denzel Washington</div>
                                <div class="text-success text-xs mt-0.5">14 March 2021</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                <img src="{{ asset('dist/images/crypto/Ethereum.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Al Pacino</div>
                                <div class="text-success text-xs mt-0.5">20 July 2022</div>
                            </div>
                            <div class="text-right">
                                <div class="font-medium">+ 0.84756 BTC</div>
                                <div class="text-slate-500 text-xs mt-0.5">$90,510.00</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Weekly Best Sellers -->
    </div>

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
                <a href="{{ route('dashboard.wallet.stellar-exchange') }}">
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


    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 xl:col-span-12 mt-0">
            <div class="intro-y mb-3 p-0 sellerTabs">
                <ul class="nav nav-link-tabs pt-2" role="tablist">
                    <li id="example-5-tab" class="nav-item flex-1" role="presentation"> <button
                            class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail1"
                            type="button" role="tab" aria-controls="seller-detail1" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" icon-name="filter" data-lucide="filter"
                                class="lucide lucide-filter inline-block">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                        </button> </li>
                    <li id="example-6-tab" class="nav-item flex-1" role="presentation"> <button
                            class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#seller-detail2"
                            type="button" role="tab" aria-controls="seller-detail2" aria-selected="false">
                            <img src="{{ asset('dist/images/crypto/7.png') }}"> USDC</button> </li>
                    <li id="example-6-tab" class="nav-item flex-1" role="presentation"> <button
                            class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail3"
                            type="button" role="tab" aria-controls="seller-detail3" aria-selected="false">
                            <img src="{{ asset('dist/images/crypto/5.png') }}"> XLM </button> </li>
                    <li id="example-6-tab" class="nav-item flex-1" role="presentation"> <button
                            class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail4"
                            type="button" role="tab" aria-controls="seller-detail4" aria-selected="false">
                            <img src="{{ asset('dist/images/crypto/6.png') }}"> ETH </button> </li>
                    <li id="example-6-tab" class="nav-item flex-1" role="presentation"> <button
                            class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail5"
                            type="button" role="tab" aria-controls="seller-detail5" aria-selected="false">
                            <img src="{{ asset('dist/images/crypto/6.png') }}"> YUSDC </button> </li>
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
                                                    <div class="text-xl 2xl:text-2xl font-medium text-warning">0.0637 USDC
                                                    </div>
                                                </div>
                                                <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                    <img alt="rounded-md border border-white"
                                                        src=" https://kanexydevstorage.blob.core.windows.net/kanexy/walletImages/UGqLTzYltFjuNredUZ2l7JHZ0MUNgvWND6jf80LA.jpg?sv=2017-11-09&sr=b&se=2023-01-16T13:45:42Z&sp=r&spr=https&sig=VkNEFk%2FUr5D4POZ2n%2FfzSv6w4RoXT9CXwAq1JuSZBWE%3D ">
                                                </div>
                                            </div>
                                            <div class="flex-col sm:flex-row">
                                                <div class="text-left pt-3 mr-auto">
                                                    <div class="text-xl 2xl:text-2xl font-medium text-white">&#163; 2456.00
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
                                <div class="grid rounded-lg w-12/12 md:w-6/12 lg:w-6/12 m-auto p-0">
                                    <h3 class="text-lg font-medium mb-4 text-white">Enter The Amount To Transfer</h3>
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
                                                class="flex" name="country_code" onchange="getFlagImg(this)"></select>
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
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M19 9l-7 7-7-7" />
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-6 w-6" fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke="currentColor">
                                                                                            <path stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                stroke-width="2"
                                                                                                d="M5 13l4 4L19 7" />
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-6 w-6" fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke="currentColor">
                                                                                            <path stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                stroke-width="2"
                                                                                                d="M5 13l4 4L19 7" />
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-6 w-6" fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke="currentColor">
                                                                                            <path stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                stroke-width="2"
                                                                                                d="M5 13l4 4L19 7" />
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            class="h-6 w-6" fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke="currentColor">
                                                                                            <path stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                stroke-width="2"
                                                                                                d="M5 13l4 4L19 7" />
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
                                                {{-- <span
                                                                    class="px-3 border-2 cursor-pointer border-dashed dark:border-dark-5 rounded-md tw-calculator-breakdown-item__right tooltip"
                                                                    data-theme="light"
                                                                    data-tooltip-content="#custom-content-tooltip"
                                                                    data-trigger="click"
                                                                    title="This is awesome tooltip example!">Guaranteed
                                                                    Rate</span> --}}

                                                <!-- BEGIN: Custom Tooltip Content -->
                                                {{-- <div class="tooltip-content">
                                                                    <div id="custom-content-tooltip"
                                                                        class="relative flex items-center py-1">
                                                                        <div class="ml-4 mr-auto">
                                                                            <div class="text-gray-500 ">You'll get this
                                                                                rate
                                                                                as long as we receive your 1,000 GBP within
                                                                                the Next 2 hours.</div>
                                                                            <a href=""
                                                                                class="btn btn-secondary btn-sm block w-40 mx-auto mt-3">Learn
                                                                                More</a>
                                                                        </div>
                                                                    </div>
                                                                </div> --}}
                                                <!-- END: Custom Tooltip Content -->

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
                                        {{-- <span class="lock-amount tooltip" data-theme="light"
                                                            data-tooltip-content="#custom-content-tooltip1"
                                                            data-trigger="click" title="This is awesome tooltip example!">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                            </svg>
                                                        </span> --}}
                                        <!-- BEGIN: Custom Tooltip Content -->
                                        {{-- <div class="tooltip-content">
                                                            <div id="custom-content-tooltip1"
                                                                class="relative flex items-center py-1">
                                                                <div class="ml-4 mr-auto">
                                                                    <div class="text-gray-500 ">
                                                                        If you need more than 2 houre to pay, click the cock
                                                                        to make sure your recipient gets exactly
                                                                        <strong>1.162.03 GBP</strong>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div> --}}
                                        <!-- END: Custom Tooltip Content -->
                                    </div>
                                    {{-- <p class="py-3">
                                                        You could save up to <strong>20.59 GBP</strong> vs tha average bank
                                                        should arrive in <strong>4 hours</strong>
                                                    </p> --}}

                                    <div class="text-right mt-5 py-4">
                                        <a data-tw-toggle="modal" data-tw-target="#large-slide-over-size-preview"
                                            class="btn btn-secondary">Compare Price</a>

                                        <button class="btn btn-primary w-24 ml-2" @click="step++">Continue</button>
                                    </div>
                                </div>

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
@endsection
