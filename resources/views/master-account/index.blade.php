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

@section('title', 'Master Accounts')

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
                        <a id="MasterAccounts" href="" class="whitespace-nowrap text-left breadcrumb--active">Master
                            Accounts</a>
                    </div>
                    <div>
                        @can(\Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::CREATE,
                            \Kanexy\LedgerFoundation\Contracts\MasterAccount::class)
                            <a id="masterAccountsCreateNew" href="{{ route('dashboard.wallet.master-account.create') }}"
                                class="btn btn-sm btn-primary shadow-md sm:ml-2 sm:ml-2 sm:-mt-2 sm:mb-0 mb-2 py-2">Create
                                New</a>
                        @endcan
                    </div>

                </div>
                <div class="px-5 py-3">
                    <div class="intro-y mt-0">
                        <div
                            class="text-right flex-wrap sm:flex items-center justify-end sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <x-list-view-filters />

                        </div>
                    </div>
                    <div class="intro-y p-0 mt-0 overflow-x-auto overflow-y-hidden">
                        <table id="tableID" class="shroting display table table-report -mt-2">
                            <thead class="short-wrp dark:bg-darkmode-400 dark:border-darkmode-400">
                                <tr class="">
                                    <th class="w-16 whitespace-nowrap text-left">#</th>
                                    <th class="whitespace-nowrap text-left">Country
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
                                    <th class="whitespace-nowrap text-left">Account Holder Name
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
                                    <th class="whitespace-nowrap text-left">Account Number
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
                                    <th class="whitespace-nowrap text-left">Sort Code / IFSC Code
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
                                    <th class="whitespace-nowrap text-left">Account Branch
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
                                            \Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::EDIT,
                                            \Kanexy\LedgerFoundation\Contracts\MasterAccount::class) ||
                                            Gate::check(
                                                \Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::DELETE,
                                                \Kanexy\LedgerFoundation\Contracts\MasterAccount::class))
                                        <th class="whitespace-nowrap text-left">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($master_accounts as $index => $master_account)
                                    <tr>
                                        <td class="whitespace-nowrap text-left">{{ $index + 1 }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ \Kanexy\Cms\I18N\Models\Country::find($master_account['country'])?->name }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ $master_account['account_holder_name'] }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ $master_account['account_number'] }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ @$master_account['sort_code'] }}
                                            {{ @$master_account['ifsc_code'] }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">{{ $master_account['account_branch'] }}
                                        </td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ trans('ledger-foundation::configuration.' . $master_account['status']) }}
                                        </td>
                                        @if (Gate::check(
                                                \Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::EDIT,
                                                \Kanexy\LedgerFoundation\Contracts\MasterAccount::class) ||
                                                Gate::check(
                                                    \Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::DELETE,
                                                    \Kanexy\LedgerFoundation\Contracts\MasterAccount::class))
                                            <td class="whitespace-nowrap text-left">
                                                <div class="dropdown">
                                                    <button id="Setting" class="dropdown-toggle btn px-2 box"
                                                        aria-expanded="false" data-tw-toggle="dropdown">
                                                        <span class="w-5 h-5 flex items-center justify-center">
                                                            <i data-lucide="settings" class="w-5 h-5 text-gray-600"></i>
                                                        </span>
                                                    </button>
                                                    <div class="dropdown-menu w-40">
                                                        <ul class="dropdown-content">
                                                            @can(\Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::EDIT,
                                                                \Kanexy\LedgerFoundation\Contracts\MasterAccount::class)
                                                                <li>
                                                                    <a id="Edit"
                                                                        href="{{ route('dashboard.wallet.master-account.edit', $master_account['id']) }}"
                                                                        class="flex items-center block dropdown-item flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                        <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                                    </a>
                                                                </li>
                                                            @endcan

                                                            @can(\Kanexy\LedgerFoundation\Policies\MasterAccountPolicy::DELETE,
                                                                \Kanexy\LedgerFoundation\Contracts\MasterAccount::class)
                                                                <li>
                                                                    <button type="button" x-data={}
                                                                        onclick="Livewire.emit('showModal','{{ route('dashboard.wallet.master-account.destroy', $master_account['id']) }}','DELETE', 'x-circle','Delete');"
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
                        {{ $master_accounts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
