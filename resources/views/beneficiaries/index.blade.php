@extends('cms::dashboard.layouts.default')

@section('title', 'Beneficiaries')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center py-2 px-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Beneficiaries
                    </h2>
                </div>
                <div class="px-5 py-3">

                    <div class="overflow-x-auto overflow-y-hidden">
                        <table class="shroting display table table-report -mt-2">
                            <thead class="short-wrp dark:bg-darkmode-400 dark:border-darkmode-400">
                                <tr>
                                    <th class="whitespace-nowrap text-left">#</th>
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
                                    <th class="whitespace-nowrap text-left">Email Address
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
                                    <th class="whitespace-nowrap text-left">Mobile No.
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
                                    <th class="whitespace-nowrap text-left">Bank Sort Code
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
                                    <th class="whitespace-nowrap text-left">Bank Account No.
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
                                    <th class="whitespace-nowrap text-left">Type
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
                                    <th class="whitespace-nowrap text-left">Category
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
                                    <th class="whitespace-nowrap text-left">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($beneficiaries as $index => $beneficiary)
                                    <tr @if ($index % 2 === 0) class="bg-gray-200 dark:bg-dark-1" @endif>
                                        <td class="whitespace-nowrap text-left">{{ $beneficiaries->firstItem() + $i }}</td>
                                        <td class="whitespace-nowrap text-left">{{ $beneficiary->getFullName() }} </td>
                                        <td class="whitespace-nowrap text-left">{{ $beneficiary->email }}</td>
                                        <td class="whitespace-nowrap text-left">{{ $beneficiary->mobile }}</td>
                                        <td class="whitespace-nowrap text-left">{{ @$beneficiary->meta['bank_code'] }}</td>
                                        <td class="whitespace-nowrap text-left">
                                            {{ @$beneficiary->meta['bank_account_number'] }}</td>
                                        <td class="whitespace-nowrap text-left capitalize">{{ $beneficiary->type }}</td>
                                        <td class="whitespace-nowrap text-left capitalize">
                                            @if ($beneficiary->ref_type == 'wrappex')
                                                Withdraw Wallet
                                            @else
                                                Wallet
                                            @endif
                                        </td>
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
                                                        @can(\Kanexy\PartnerFoundation\Cxrm\Policies\ContactPolicy::EDIT,
                                                            $beneficiary)
                                                            <li>
                                                                <a id="Edit"
                                                                    href="{{ route('dashboard.wallet.beneficiaries.edit', $beneficiary->id) }}"
                                                                    class="flex items-center block dropdown-item block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                                                    <i data-lucide="edit-2" class="w-4 h-4 mr-2"></i> Edit
                                                                </a>
                                                            </li>
                                                        @endcan

                                                        @can(\Kanexy\PartnerFoundation\Cxrm\Policies\ContactPolicy::DELETE,
                                                            $beneficiary)
                                                            <li>
                                                                <button type="button" x-data={}
                                                                    onclick="Livewire.emit('showModal','{{ route('dashboard.wallet.beneficiaries.destroy', $beneficiary->id) }}','DELETE', 'x-circle','Delete');"
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
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="my-2">
                        {{ $beneficiaries->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('confirmation-modal')
@endsection
