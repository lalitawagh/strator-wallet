@extends('ledger-foundation::config-skeleton')

@section('title', 'Asset Type')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div
                    class="overflow-x-auto overflow-y-hidden sm:flex gap-2 gap-2 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5 text-right">
                    <div class="breadcrumb mr-auto sm:flex justify-around">
                        <a id="Wallet" class="whitespace-nowrap text-left " href="">Wallet</a><svg
                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a id="Configuration" class="whitespace-nowrap text-left " href=""
                            class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px"
                            height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a id="Asset" href="" class="whitespace-nowrap text-left breadcrumb--active">Asset
                            Type</a>
                    </div>
                    <div>
                        @can(\Kanexy\LedgerFoundation\Policies\AssetTypePolicy::CREATE,
                            \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class)
                            <a id="assetTypeCreateNew" href="{{ route('dashboard.wallet.asset-type.create') }}"
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
                                    <th class="whitespace-nowrap text-left">Name
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
                                    <th class="whitespace-nowrap text-left">Asset Category
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
                                    <th class="whitespace-nowrap text-left">Image
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
                                    <th class="whitespace-nowrap text-left">Status
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
                                            \Kanexy\LedgerFoundation\Policies\AssetTypePolicy::EDIT,
                                            \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class) ||
                                            Gate::check(
                                                \Kanexy\LedgerFoundation\Policies\AssetTypePolicy::DELETE,
                                                \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class))
                                        <th class="whitespace-nowrap text-left w-20">Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($asset_type_lists as $index => $asset_type_list)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $asset_type_lists->firstItem() + $i }}
                                        </td>
                                        <td class="border-b dark:border-dark-5">{{ $asset_type_list['name'] }}</td>
                                        <td class="border-b dark:border-dark-5">
                                            {{ ucwords(strtolower(str_replace('_', ' ', $asset_type_list['asset_category']))) }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">
                                            @isset($asset_type_list['image'])
                                                <img class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default"
                                                    src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($asset_type_list['image'], now()->addMinutes(5)) }}">
                                            @endisset
                                        </td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ trans('ledger-foundation::configuration.' . $asset_type_list['status']) }}
                                        </td>
                                        @if (Gate::check(
                                                \Kanexy\LedgerFoundation\Policies\AssetTypePolicy::EDIT,
                                                \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class) ||
                                                Gate::check(
                                                    \Kanexy\LedgerFoundation\Policies\AssetTypePolicy::DELETE,
                                                    \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class))
                                            <td class="whitespace-nowrap text-left">
                                                <div class="dropdown">
                                                    <button id="Settings" class="dropdown-toggle btn px-2 box"
                                                        aria-expanded="false" data-tw-toggle="dropdown">
                                                        <span class="w-5 h-5 flex items-center justify-center">
                                                            <i data-lucide="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </span>
                                                    </button>
                                                    <div class="dropdown-menu w-40">
                                                        <ul class="dropdown-content">
                                                            @can(\Kanexy\LedgerFoundation\Policies\AssetTypePolicy::EDIT,
                                                                \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class)
                                                                <li>
                                                                    <a id="Edit"
                                                                        href="{{ route('dashboard.wallet.asset-type.edit', $asset_type_list['id']) }}"
                                                                        class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                                    </a>
                                                                </li>
                                                            @endcan
                                                            @can(\Kanexy\LedgerFoundation\Policies\AssetTypePolicy::DELETE,
                                                                \Kanexy\LedgerFoundation\Contracts\AssetTypeConfiguration::class)
                                                                <li>
                                                                    <button type="button" x-data={}
                                                                        onclick="Livewire.emit('showModal','{{ route('dashboard.wallet.asset-type.destroy', $asset_type_list['id']) }}','DELETE', 'x-circle','Delete');"
                                                                        class="w-full flex items-center block p-2 transition duration-300 ease-in-out dark:bg-dark-1 hover:bg-red-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-lucide="trash" class="w-4 h-4 mr-2"></i>
                                                                        Delete
                                                                    </button>
                                                                </li>
                                                            @endcan
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-2">
                    {{ $asset_type_lists->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
