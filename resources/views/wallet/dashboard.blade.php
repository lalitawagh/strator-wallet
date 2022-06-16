@extends('ledger-foundation::layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('dist/css/wallet.css') }}" />
@endpush

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12">

            <div class="grid grid-cols-12 gap-3">
                <div class="col-span-12 md:col-span-8 lg:col-span-8 mt-3">
                    <div class="hidden" id="updateCredit">{{ @$creditTransactionGraphData }}</div>
                    <div class="hidden" id="updateDebit">{{ @$debitTransactionGraphData }}</div>
                    <div class="intro-y shadow-lg p-3 rounded-2xl bg-white p-5  h-full">
                        <div class="flex flex-col xl:flex-row xl:items-center">
                            <div class="flex">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Transactions
                                </h2>
                            </div>
                            <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                                <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                                    <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                    <input type="text" class="form-control sm:w-56 box pl-10" value="2022" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-12 md:col-span-12 lg:col-span-10 mt-3">
                                <div class="report-chart">
                                    <canvas id="chartLine" height="150" class="mt-6"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="shadow-lg p-3 rounded-2xl bg-white col-span-12 md:col-span-4 lg:col-span-4 mt-3">
                    <div class="mt-2">
                        <h2 class="text-lg font-medium truncate mb-3">
                            Latest Transactions
                        </h2>
                        @foreach ($transactions as $transaction)
                        @if(isset($transaction->meta['transaction_type']) && $transaction->meta['transaction_type'] == 'deposit' || $transaction->meta['transaction_type'] == 'payout')
                            @php $wallet = \Kanexy\LedgerFoundation\Model\Wallet::whereId($transaction->ref_id)->first(); @endphp
                        @else
                            @php $wallet = \Kanexy\LedgerFoundation\Model\Wallet::whereId($transaction->meta['sender_wallet_account_id'])->first(); @endphp
                        @endif
                        @php
                            $ledger = \Kanexy\LedgerFoundation\Model\Ledger::whereId($wallet?->ledger_id)->first();
                        @endphp
                            <div class="intro-x">
                                <div class="rounded-xl btn-secondary hover:bg-theme-1 hover:text-white px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                        <img alt="" src="https://dev.kanexy.com/dist/images/user.png">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">
                                            @if (isset($transaction->meta['transaction_type']) && $transaction->meta['transaction_type'] == 'wallet-withdraw' ||  $transaction->meta['transaction_type'] == 'withdraw')
                                            {{ $wallet->name }}
                                            @else
                                                {{ @$transaction->meta['sender_name'] }}
                                            @endif
                                        </div>
                                        <div class="text-xs mt-0.5">{{ date('d M Y',strtotime($transaction->created_at))}}</div>
                                    </div>
                                    <div @if($transaction->type === 'debit') class="text-theme-6" @else class="text-theme-9" @endif>
                                        @if($transaction->type === 'debit') - @else + @endif
                                        @if($ledger?->exchange_type == \Kanexy\LedgerFoundation\Enums\ExchangeType::FIAT)
                                            {{ \Kanexy\PartnerFoundation\Core\Helper::getFormatAmountWithCurrency($transaction->amount, $ledger?->name) }}
                                        @else
                                            {{ $ledger?->symbol }} {{ number_format((float)$transaction->amount, 2, '.', '') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <a href="{{ route('dashboard.wallet.transaction.index',['filter' => ['workspace_id' => $workspace->getKey()]])}}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            var creditChartTransaction = document.getElementById("updateCredit").innerHTML;
            var debitChartTransaction = document.getElementById("updateDebit").innerHTML;

            const data = {
                labels: labels,
                datasets: [{
                    label: 'PAID IN',
                    fill: false,
                    borderColor: '#002366', // Add custom color border (Line)
                    data: JSON.parse(creditChartTransaction),
                },
                {
                    label: 'PAID OUT',
                    fill: false,
                    borderColor: '#4baef1', // Add custom color border (Line)
                    data: JSON.parse(debitChartTransaction),
                }]
            };

            const configLineChart = {
                type: 'line',
                data,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5,
                                maxTicksLimit: 11
                            },
                            responsive: true, // Instruct chart js to respond nicely.
                            maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height

                        }],
                    },
                    y: {
                        suggestedMin: 50,
                        suggestedMax: 100
                    },
                    parsing: {
                        xAxisKey: "month",
                        yAxisKey: "total"
                    },
                    responsive: true, // Instruct chart js to respond nicely.
                    maintainAspectRatio: true // Add to prevent default behaviour of full-width/height
                }
            };

            var report_line_chart_data = document.getElementById("chartLine").getContext('2d');
            var chartLine = new Chart(
                report_line_chart_data,
                configLineChart
            );


    </script>
@endpush
