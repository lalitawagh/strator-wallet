@extends("ledger-foundation::config-skeleton")

@section("title", "Exchange Rate")

@section("config-content")
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="sm:flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        <a href="" class="breadcrumb--active">Exchange Rate</a>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.wallet.exchange-rate.create') }}"
                            class="btn btn-sm btn-primary shadow-md">Create New</a>
                    </div>
                </div>
                <div class="p-5">
                    <div class="overflow-x-auto box">
                        <table class="table">
                            <thead>
                            <tr class="bg-gray-300 dark:bg-dark-1">
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange From</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange To</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Frequency</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Valid Date</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange Rate</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange Fee</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($exchange_rates as $index => $exchange_rate)
                                @php
                                    $assetType  = collect(\Kanexy\Cms\Setting\Models\Setting::getValue('asset_types',[]))->firstWhere('id', $exchange_rate?->exchange_currency);
                                @endphp
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rates->firstItem() + $index }}</td>
                                    <td class="border-b dark:border-dark-5">@isset($exchange_rate->ledger?->name) {{ $exchange_rate->ledger?->name }} @endisset</td>
                                    <td class="border-b dark:border-dark-5">{{ @$assetType['name'] }}</td>
                                    <td class="border-b dark:border-dark-5">{{ trans('ledger-foundation::configuration.'.$exchange_rate?->frequency) }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate?->valid_date }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate?->exchange_rate }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate?->exchange_fee }}</td>
                                    <td class="border-b dark:border-dark-5">
                                        <div class="dropdown">
                                            <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                            </button>

                                            <div class="dropdown-menu w-48">
                                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                    <a href="{{ route('dashboard.wallet.exchange-rate.edit', $exchange_rate?->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                        <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.wallet.exchange-rate.destroy', $exchange_rate?->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="w-full flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-red-200 dark:hover:bg-dark-2 rounded-md">
                                                            <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
