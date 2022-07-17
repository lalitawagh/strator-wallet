@extends("ledger-foundation::config-skeleton")

@section('title', 'Fee Setup')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="sm:flex gap-2 sm:gap-0 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="breadcrumb--active">Fee Setup</a>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.wallet.fee.create') }}"
                            class="btn btn-sm btn-primary shadow-md">Create New</a>
                    </div>
                </div>
                <div class="p-5">
                    <div class="intro-y p-0 mt-0 overflow-x-auto overflow-y-hidden">
                        <table id="tableID" class="shroting display table table-report -mt-2">
                            <thead class="short-wrp">
                                <tr class="">
                                    <th class="w-16 whitespace-nowrap text-left">#</th>
                                    <th class="whitespace-nowrap text-left">Exchange From
                                        <span class="flex short-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th class="whitespace-nowrap text-left">Exchange To
                                        <span class="flex short-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th class="whitespace-nowrap text-left">Payment Type
                                        <span class="flex short-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th class="whitespace-nowrap text-left">Amount
                                        <span class="flex short-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th class="whitespace-nowrap text-left">Percentage
                                        <span class="flex short-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 up" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 down" fill="#c1c4c9"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                                            </svg>
                                        </span>
                                    </th>

                                    <th class="whitespace-nowrap text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($fees as $index => $fee)
                                    @php
                                        $exchangeCurrency = \Kanexy\LedgerFoundation\Model\Ledger::whereId($fee['exchange_currency'])->first();
                                        $baseCurrency = \Kanexy\LedgerFoundation\Model\Ledger::whereId($fee['base_currency'])->first();
                                    @endphp
                                    <tr>
                                        <td class="whitespace-nowrap text-left">
                                            {{ $fees->firstItem() + $i }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            @isset($baseCurrency['name'])
                                                {{ $baseCurrency['name'] }}
                                            @endisset
                                        </td>
                                        <td class="whitespace-nowrap text-left"> @isset($exchangeCurrency['name']){{ $exchangeCurrency['name'] }}@endisset</td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ ucfirst($fee['payment_type']) }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ $fee['amount'] }}</td>
                                        <td class="whitespace-nowrap text-left">{{ $fee['percentage'] }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            <div class="dropdown">
                                                <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                    <i data-lucide="settings" class="w-5 h-5 text-gray-600"></i>
                                                </button>

                                                <div class="dropdown-menu w-48">
                                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                        <a href="{{ route('dashboard.wallet.fee.edit', $fee['id']) }}"
                                                            class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                            <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('dashboard.wallet.fee.destroy', $fee['id']) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="w-full flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-red-200 dark:hover:bg-dark-2 rounded-md">
                                                                <i data-lucide="trash" class="w-4 h-4 mr-2"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-2">
                        {{-- {{ $exchange_rates->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
