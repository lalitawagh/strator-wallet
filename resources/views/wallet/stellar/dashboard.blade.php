    @extends('ledger-foundation::wallet.stellar.skeleton')

    @section('stellar-content')
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
                                        @foreach ($stellarCurrencies as $stellarCurrency)
                                            <div class="h-24 px-2" style="height: 9rem;">
                                                <div class="h-full bg-slate-100 dark:bg-darkmode-400 rounded-md">
                                                    <div class="h-full font-medium items-center justify-center text-2xl">
                                                        <div class="sellerSlide-box">
                                                            <div class="box p-3">
                                                                <div class="flex">
                                                                    <div
                                                                        class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                                        <img
                                                                            src="{{ asset('dist/images/crypto/Ethereum.png') }}">
                                                                    </div>
                                                                    <div class="ml-4 mr-auto">
                                                                        <div class="text-xl 2xl:text-2xl font-medium">
                                                                            {{ $stellarCurrency }}
                                                                        </div>
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            {{ date('D d M Y') }}
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="flex flex-col sm:flex-row">
                                                                    <div class="text-left pt-3 mr-auto">
                                                                        <div class="text-xl 2xl:text-2xl font-medium">
                                                                            @if (@$stellarBalance['balance'][0]['asset_code'] == $stellarCurrency)
                                                                                {{ @$stellarBalance['balance'][0]['balance'] }}
                                                                            @else
                                                                                0.00
                                                                            @endif
                                                                            {{ $stellarCurrency }}
                                                                        </div>
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            $90,510.00
                                                                        </div>
                                                                    </div>
                                                                    <div class="ml-auto pt-3">
                                                                        <div
                                                                            class="bg-success/20 text-success rounded text-xs px-2 mt-1.5">
                                                                            {{ \Kanexy\LedgerFoundation\Http\Helper::getStellarCurrentRate($stellarCurrency) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                                            data-lucide="chevron-down" class="w-4 h-4 ml-2"></i></button>
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
                {{-- <div class="intro-y box mb-3 p-5">
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
                                        <th class="whitespace-nowrap">24 Volume</th>
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
                </div> --}}
                <!-- END: Weekly Top Products -->
            </div>
            <!-- BEGIN: Weekly Best Sellers -->
            <div class="col-span-12 xl:col-span-4 mt-0">
                @if (!is_null($stellarAccount))
                    <div class="intro-y box p-3">
                        <div class="intro-y flex items-center pb-3">
                            <h2 class="text-lg font-medium mr-auto">Stellar Account
                            </h2>
                            {{ $stellarAccount->urn }}
                        </div>
                        <div class="intro-y flex items-center pb-3">
                            <h4 class="text-sm font-medium mr-auto">Public Key
                            </h4>
                        </div>
                        <span class="text-xs">{{ @$stellarAccount?->meta['publicKey'] }}</span>
                        {{-- <div class="intro-y flex items-center pt-2 ">
                            <span class="text-sm text-success font-medium mr-auto">
                                + {{ $stellarAccount?->balance }}
                            </span>
                        </div> --}}
                    </div>
                @endif
                <div class="intro-y box p-3 mt-3">
                    <div class="intro-y flex items-center pb-3">
                        <h2 class="text-lg font-medium mr-auto">
                            Transactions
                        </h2>
                        @if (is_null($stellarAccount))
                            <a class="block" href="{{ route('dashboard.wallet.crypto-account') }}">
                                <button class="btn btn-sm org-clr py-1 px-2 mr-0 col">Create an Crypto Account</button>
                            </a>
                        @endif
                    </div>
                    <div class="mt-0">
                        @foreach ($transactions as $transaction)
                            <div class="intro-y">
                                <div class="box px-2 py-2 mb-2 flex items-center zoom-in">
                                    <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                        <img src="{{ asset('dist/images/crypto/Ethereum.png') }}">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{ $transaction->meta['beneficiary_name'] }}</div>
                                        <div class="text-success text-xs mt-0.5">
                                            {{ date('d M Y', strtotime($transaction->created_at)) }}</div>
                                    </div>

                                    <div class="text-right">
                                        <div class="font-medium">{{ $transaction->amount }}
                                            {{ $transaction->meta['receiver_currency'] }}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{ $transaction->amount }}
                                            {{ $transaction->meta['sender_currency'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END: Weekly Best Sellers -->
        </div>
    @endsection

    @push('scripts')
        <script>
            $url = window.location.pathname.split('/');
            if ($url[3] == 'crypto-portfolio') {
                $('#color-scheme-content').addClass('dark');
            }
        </script>
    @endpush
