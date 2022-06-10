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
@extends("ledger-foundation::config-skeleton")

@section('title', 'Master Accounts')

@section("config-content")
<div class="configuration-container w-screen">
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y box col-span-12 xxl:col-span-12">
            <div class="asset-create sm:flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <div class="breadcrumb mr-auto hidden sm:flex">
                    <a href="">Wallet</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    <a href="" class="">Configuration</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    <a href="" class="breadcrumb--active">Master Accounts</a>
                </div>
                <div>
                    <a href="{{ route('dashboard.wallet.master-account.create') }}" class="btn btn-sm btn-primary shadow-md">Create New</a>
                </div>
            </div>
            <div class="p-5">
                <div class="overflow-x-auto box">
                    <table class="table">
                        <thead>
                            <tr class="bg-gray-300 dark:bg-dark-1">
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Country</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Account Holder Name</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Account Number</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Sort Code / IFSC Code</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Account Branchtry</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Status</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($master_accounts as $index => $master_account)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $master_account['country'] }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $master_account['account_holder_name'] }}
                                    </td>
                                    <td class="border-b dark:border-dark-5">{{ $master_account['account_number'] }}
                                    </td>
                                    <td class="border-b dark:border-dark-5">{{ $master_account['sort_code'] }}
                                    </td>
                                    <td class="border-b dark:border-dark-5">{{ $master_account['account_branch'] }}
                                    </td>
                                    <td class="border-b dark:border-dark-5">{{ $master_account['status'] }}
                                    </td>
                                   
                                    <td class="border-b dark:border-dark-5">
                                        <div class="dropdown">
                                            <button class="dropdown-toggle btn btn-sm" aria-expanded="false">
                                                <i data-feather="settings" class="w-5 h-5 text-gray-600"></i>
                                            </button>

                                            <div class="dropdown-menu w-48">
                                                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                    <a href="{{ route('dashboard.wallet.master-account.edit', $master_account['id']) }}"
                                                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                        <i data-feather="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('dashboard.wallet.master-account.destroy', $master_account['id']) }}"
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
                    {{ $master_accounts->links() }}
                </div>
             </div>
        </div>
    </div>
</div>
@endsection
