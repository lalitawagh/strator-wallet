@extends("ledger-foundation::config-skeleton")

@section('title', 'Commodity Type')

@section('config-content')
    <div class="configuration-container">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">

                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg"
                            width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="breadcrumb--active">Commodity Type</a>
                    </div>
                    <div>
                        <a href="{{ route('dashboard.wallet.commodity-type.create') }}"
                            class="btn btn-sm btn-primary shadow-md">Create New</a>
                    </div>
                </div>
                <div class="p-5">
                    <div class="overflow-x-auto box">
                        <table class="table">
                            <thead>
                                <tr class="bg-gray-300 dark:bg-dark-1">
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Name</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Image</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($commodity_type_lists as $index => $commodity_type_list)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $commodity_type_list['name'] }}</td>
                                        <td class="border-b dark:border-dark-5">
                                            @isset($commodity_type_list['image'])
                                            <img class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default" src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->url($commodity_type_list['image']) }}">
                                            @endisset
                                        </td>
                                        <td class="border-b dark:border-dark-5">
                                            {{ trans('ledger-foundation::configuration.' . $commodity_type_list['status']) }}
                                        </td>
                                        <td class="border-b dark:border-dark-5">
                                            <div class="dropdown">
                                                <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                    <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                </button>

                                                    <div class="dropdown-menu w-48">
                                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                            <a href="{{ route('dashboard.wallet.commodity-type.edit', $commodity_type_list['id']) }}"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('dashboard.wallet.commodity-type.destroy', $commodity_type_list['id']) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                            <button type="submit"
                                                                class="w-full flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-red-200 dark:hover:bg-dark-2 rounded-md">
                                                                <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete
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
                        {{ $commodity_type_lists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
