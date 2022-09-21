@push('styles')
    <style>
        @media (max-width: 580px) {
            .asset-create {
                display: flex;
            }
        }

        @media (max-width: 579px) {
            .asset-create {
                display: block;
                margin-top: 10px;
            }
        }
    </style>
@endpush
@extends('ledger-foundation::config-skeleton')

@section('title', 'Asset Class')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 xxl:col-span-12">
                <div
                    class="overflow-x-auto overflow-y-hidden sm:flex gap-2 gap-2 flex-wrap items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5 text-right">
                    <div class="breadcrumb mr-auto sm:flex justify-around">
                        <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="whitespace-nowrap text-left feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg"
                            width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="whitespace-nowrap text-left breadcrumb--active">Asset Class</a>
                    </div>
                    <div>
                        @can(\Kanexy\LedgerFoundation\Policies\AssetClassPolicy::CREATE,
                            \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class)
                            <a href="{{ route('dashboard.wallet.asset-class.create') }}"
                                class="btn btn-sm btn-primary shadow-md">Create New</a>
                        @endcan
                    </div>
                </div>
                <div class="p-5">
                    <div class="intro-y p-0 mt-0 overflow-x-auto overflow-y-hidden">
                        <table class="shroting display table table-report -mt-2">
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
                                        \Kanexy\LedgerFoundation\Policies\AssetClassPolicy::EDIT,
                                        \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class) ||
                                        Gate::check(
                                            \Kanexy\LedgerFoundation\Policies\AssetClassPolicy::DELETE,
                                            \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class))
                                        <th class="whitespace-nowrap text-left w-20">Action
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($asset_class_lists as $index => $asset_class_list)
                                    <tr>
                                        <td class="whitespace-nowrap text-left">{{ $asset_class_lists->firstItem() + $i }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ $asset_class_list['name'] }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            @isset($asset_class_list['image'])
                                                <img class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden rounded-md proof-default"
                                                    alt=""
                                                    src="{{ \Illuminate\Support\Facades\Storage::disk('azure')->temporaryUrl($asset_class_list['image'], now()->addMinutes(5)) }}">
                                            @endisset
                                        </td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ trans('ledger-foundation::configuration.' . $asset_class_list['status']) }}
                                        </td>
                                        @if (Gate::check(
                                            \Kanexy\LedgerFoundation\Policies\AssetClassPolicy::EDIT,
                                            \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class) ||
                                            Gate::check(
                                                \Kanexy\LedgerFoundation\Policies\AssetClassPolicy::DELETE,
                                                \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class))
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
                                                            @can(\Kanexy\LedgerFoundation\Policies\AssetClassPolicy::EDIT,
                                                                \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class)
                                                                <li>
                                                                    <a href="{{ route('dashboard.wallet.asset-class.edit', $asset_class_list['id']) }}"
                                                                        class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                                    </a>
                                                                </li>
                                                            @endcan
                                                            @can(\Kanexy\LedgerFoundation\Policies\AssetClassPolicy::DELETE,
                                                                \Kanexy\LedgerFoundation\Contracts\AssetClassConfiguration::class)
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dashboard.wallet.asset-class.destroy', $asset_class_list['id']) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <input type="hidden" name="count"
                                                                            value="{{ $asset_class_lists->count() }}" />
                                                                        <input type="hidden" name="previousPage"
                                                                            value="{{ $asset_class_lists->previousPageUrl() }}" />

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
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-2">
                        {{ $asset_class_lists->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
