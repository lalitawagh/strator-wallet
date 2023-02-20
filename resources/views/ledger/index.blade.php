@extends('ledger-foundation::config-skeleton')

@section('title', 'Ledger')

@section('config-content')
    <div class="configuration-container w-screen">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Daily Sales -->
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
                        <a id="Ledger" href="" class="whitespace-nowrap text-left breadcrumb--active">Ledger</a>
                    </div>
                    <div>
                        @can(\Kanexy\LedgerFoundation\Policies\LedgerPolicy::CREATE,
                            \Kanexy\LedgerFoundation\Models\Ledger::class)
                            <a id="ledgerCreateNew" href="{{ route('dashboard.wallet.ledger.create') }}"
                                class="btn btn-sm btn-primary shadow-md">Create New</a>
                        @endcan
                    </div>
                </div>
                <div class="Livewire-datatable-modal pb-3">
                    <livewire:data-table model='Kanexy\LedgerFoundation\Model\Ledger' params="" type="ledger" />
                </div>
            </div>
        </div>
        <!-- END: Daily Sales -->
    </div>

@endsection
