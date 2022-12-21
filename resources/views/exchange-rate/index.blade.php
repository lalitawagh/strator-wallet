@extends('ledger-foundation::config-skeleton')

@section('title', 'Exchange Rate')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div
                    class="overflow-x-auto overflow-y-hidden sm:flex gap-2 gap-2 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5 text-right">

                    <div class="breadcrumb mr-auto sm:flex justify-around">
                        <a class="whitespace-nowrap text-left " href="">Wallet</a><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a class="whitespace-nowrap text-left " href="">Configuration</a><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="whitespace-nowrap text-left breadcrumb--active">Exchange Rate</a>
                    </div>
                    <div>
                        @can(\Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::CREATE,
                            \Kanexy\LedgerFoundation\Models\ExchangeRate::class)
                            <a id="exchangeRateCreateNew" href="{{ route('dashboard.wallet.exchange-rate.create') }}"
                                class="btn btn-sm btn-primary shadow-md">Create New</a>
                        @endcan
                    </div>
                </div>
                <div class="p-5">
                    <div class="intro-y p-0 mt-0 overflow-x-auto overflow-y-hidden">
                        <table id="tableID" class="shroting display table table-report -mt-2">
                            <thead class="short-wrp dark:bg-darkmode-400 dark:border-darkmode-400">
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
                                    <th class="whitespace-nowrap text-left">Frequency
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
                                    <th class="whitespace-nowrap text-left">Valid Date
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
                                    <th class="whitespace-nowrap text-left">Exchange Rate
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
                                    @if (Gate::check(
                                        \Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::EDIT,
                                        \Kanexy\LedgerFoundation\Models\ExchangeRate::class) ||
                                        Gate::check(
                                            \Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::DELETE,
                                            \Kanexy\LedgerFoundation\Models\ExchangeRate::class))
                                        <th class="whitespace-nowrap text-left">Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($exchange_rates as $index => $exchange_rate)
                                    @php
                                        $exchangeCurrency = \Kanexy\LedgerFoundation\Model\Ledger::whereId($exchange_rate->exchange_currency)->first();
                                    @endphp
                                    <tr>
                                        <td class="whitespace-nowrap text-left">
                                            {{ $exchange_rates->firstItem() + $index }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            @isset($exchange_rate->ledger?->name)
                                                {{ $exchange_rate->ledger?->name }}
                                            @endisset
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ $exchangeCurrency?->name }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ trans('ledger-foundation::configuration.' . $exchange_rate?->frequency) }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ $exchange_rate?->valid_date }}</td>
                                        <td class="whitespace-nowrap text-left">{{ $exchange_rate?->exchange_rate }}</td>
                                        @if (Gate::check(
                                            \Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::EDIT,
                                            \Kanexy\LedgerFoundation\Models\ExchangeRate::class) ||
                                            Gate::check(
                                                \Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::DELETE,
                                                \Kanexy\LedgerFoundation\Models\ExchangeRate::class))
                                            <td class="whitespace-nowrap text-left">
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false"
                                                        data-tw-toggle="dropdown">
                                                        <span class="w-5 h-5 flex items-center justify-center">
                                                            <i data-lucide="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </span>
                                                    </button>
                                                    <div class="dropdown-menu w-40">
                                                        <ul class="dropdown-content">
                                                            @can(\Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::EDIT,
                                                                \Kanexy\LedgerFoundation\Models\ExchangeRate::class)
                                                                <li>
                                                                    <a href="{{ route('dashboard.wallet.exchange-rate.edit', $exchange_rate?->id) }}"
                                                                        class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                                    </a>
                                                                </li>
                                                            @endcan

                                                            @can(\Kanexy\LedgerFoundation\Policies\ExchangeRatePolicy::DELETE,
                                                                \Kanexy\LedgerFoundation\Models\ExchangeRate::class)
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dashboard.wallet.exchange-rate.destroy', $exchange_rate?->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <input type="hidden" name="count"
                                                                            value="{{ $exchange_rates->count() }}" />
                                                                        <input type="hidden" name="previousPage"
                                                                            value="{{ $exchange_rates->previousPageUrl() }}" />

                                                                        <button type="submit"
                                                                            class="w-full flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                            <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-2">
                        {{ $exchange_rates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
