@extends("cms::dashboard.layouts.default")

@section("title", "Exchange Rate")

@section("content")
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center py-2 px-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Exchange Rate
                    </h2>


                    <div>
                        <a href="{{ route('dashboard.ledger-foundation.exchange-rate.create') }}" class="btn btn-sm btn-primary shadow-md">Create New</a>
                    </div>

                </div>

                <div class="p-5">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Base Currency</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange Currency</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Frequency</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Valid Date</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange Rate</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Exchange Fee</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($exchange_rates as $index => $exchange_rate)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate->ledger->name }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate->assetType->name }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate->frequency }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate->valid_date }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate->exchange_rate }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $exchange_rate->exchange_fee }}</td>
                                    <td class="border-b dark:border-dark-5">
                                        <div class="dropdown">
                                            <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                            </button>

                                            <div class="dropdown-menu w-48">
                                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                    <a href="{{ route('dashboard.ledger-foundation.exchange-rate.edit', $exchange_rate->id) }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                        <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.ledger-foundation.exchange-rate.destroy', $exchange_rate->id) }}" method="POST">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
