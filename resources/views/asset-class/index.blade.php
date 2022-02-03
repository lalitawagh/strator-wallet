@extends("ledger-foundation::config-skeleton")

@section('title', 'Asset Class')

@section("config-content")
<div class="configuration-container">
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 xxl:col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                    <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    <a href="" class="breadcrumb--active">Asset Class</a>
                </div>
                <div>
                    <a href="{{ route('dashboard.ledger-foundation.asset-class.create') }}" class="btn btn-sm btn-primary shadow-md">Create New</a>
                </div>
            </div>
            <div>
                <div id="1" class="tab-pane grid grid-cols-12 gap-3 pt-0 active" role="tabpanel" aria-labelledby="1-tab">
                    <div class="active col-span-12 mt-0 w-full" role="tabpanel" id="k-wallet" aria-labelledby="k-wallet-tab">
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
                                    @foreach ($asset_class_lists as $index => $asset_class_list)
                                        <tr>
                                            <td class="border-b dark:border-dark-5">{{ $i }}</td>
                                            <td class="border-b dark:border-dark-5">{{ $asset_class_list['name'] }}</td>
                                            <td class="border-b dark:border-dark-5">
                                                @isset($asset_class_list['image'])
                                                <img class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default" alt="" src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->url($asset_class_list['image']) }}">
                                                @endisset
                                            </td>
                                            <td class="border-b dark:border-dark-5"> {{ trans('ledger-foundation::configuration.'.$asset_class_list['status']) }}
                                            </td>
                                            <td class="border-b dark:border-dark-5">
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                        <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                                    </button>

                                                    <div class="dropdown-menu w-48">
                                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                            <a href="{{ route('dashboard.ledger-foundation.asset-class.edit', $asset_class_list['id']) }}"
                                                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('dashboard.ledger-foundation.asset-class.destroy', $asset_class_list['id']) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
