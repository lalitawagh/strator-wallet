@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Recieves')

@section('content')
    <div class="grid grid-cols-12 gap-6 mb-3">
        <div class="col-span-12">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Receive/Request payment
                    </h2>
                    {{-- <div>
                        <a class="btn btn-sm btn-primary shadow-md" data-toggle="modal"
                            data-target="#WalletPayout-modal">Payout</a>
                    </div> --}}
                </div>
                <!--S Payout list-->
                <div class="p-5">
                    <form action="" method="">
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Wallet <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="currency">

                                        <option>Paypal</option>
                                        <option>Stripe</option>
                                        <option>Bank</option>
                                    </select>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Balance </label>
                                <div class="sm:w-5/6">
                                    <input id="" disabled type="text" class="form-control" value="" placeholder="£ 1,320.00">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0 relative">
                                <label for="" class="form-label sm:w-28"> Beneficiary <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="currency">
                                        <option>Paypal</option>
                                        <option>Stripe</option>
                                        <option>Bank</option>
                                    </select>
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                                <a data-toggle="modal" data-target="#walletbenificary-modal" class="absolute top-0 right-0 plus" style="cursor: pointer;right: -18px;top: 0;margin-top: 20px;">
                                    <i data-feather="plus-circle" class="w-4 h-4 ml-4"></i>
                                </a>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Mobile </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Amount to Pay <span class="text-theme-6">*</span></label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Remaining </label>
                                <div class="sm:w-5/6">
                                    <input id="" disabled type="text" class="form-control" value="" placeholder="£ 120.00">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0" style="align-items: center;">
                                <label for="" class="form-label sm:w-28"> Note </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Attachment </label>
                                <div class="sm:w-5/6">
                                    <input id="" name="" type="file" class="form-control w-full " placeholder="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 md:gap-10 mt-0">
                            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                                <label for="" class="form-label sm:w-28"> Reason </label>
                                <div class="sm:w-5/6">
                                    <input id="" type="text" class="form-control" value="">
                                    <span class="block text-theme-6 mt-2"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-right mt-5">
                        <a data-toggle="modal" data-target="#wsave-preview-modal" class="btn btn-primary w-24">Save</a>
                    </div>
                </div>

                <!--E payout list-->

            </div>
        </div>
    </div>

    <div id="walletbenificary-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h2 class="font-medium text-base mr-auto">Beneficiary</h2>
                </div>

                <div class="modal-body">
                    <div class="grid grid-cols-12 md:gap-0 mt-0">
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                            <label for="" class="form-label sm:w-28"> Name <span class="text-theme-6">*</span></label>
                            <div class="sm:w-5/6">
                                <input id="" type="text" class="form-control" value="">
                                <span class="block text-theme-6 mt-2"></span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                            <label for="" class="form-label sm:w-28"> Email <span class="text-theme-6">*</span></label>
                            <div class="sm:w-5/6">
                                <input id="" type="text" class="form-control" value="">
                                <span class="block text-theme-6 mt-2"></span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                            <label for="" class="form-label sm:w-28"> Mobile <span class="text-theme-6">*</span></label>
                            <div class="sm:w-5/6">
                                <input id="" type="text" class="form-control" value="">
                                <span class="block text-theme-6 mt-2"></span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-0">
                            <label for="" class="form-label sm:w-28"> Notes </label>
                            <div class="sm:w-5/6">
                                <input id="" type="text" class="form-control" value="">
                                <span class="block text-theme-6 mt-2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--pauout wallet detail popup-->
    <div id="pauoutwalletdetailpopup-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h2 class="font-medium text-base mr-auto">Receive/Request payment Details</h2>
                    <button class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Change Plan </button>
                </div>

                <div class="modal-body">
                    <div>
                            <div>
                                <div class="flex flex-col lg:flex-row px-1 sm:px-2 py-0 mb-2">
                                    <div class="dark:text-theme-10">
                                        <h2 class="text-theme-1 dark:text-theme-10 font-semibold text-2xl">$110/y</h2>
                                        <p class="text-sm font-medium text-gray-700">t1</p>
                                    </div>
                                </div>
                                <div class="mt-5 border-b border-dashed pb-3">
                                    <p class="text-sm tracking-wide font-medium uppercase">Sender Account</p>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Next Payment
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                23 Jun, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Subscription plan
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                Gold
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Payment Due Date
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                25 Agust, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Subscription Start Date
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                12 Jun, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Subscription End Date
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                25 Jun, 2021
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Bill
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                1,25,846
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 border-b border-dashed pb-3">

                                    <div class="flex text-sm tracking-wide font-medium uppercase"><h4 class="font-medium text-base mr-auto">Billing Information </h4> <button class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Edit </button></div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Company Name
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                Kanexy
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Email Address
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                kanexy@gmail.co
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                VAT number
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                RF845762158762
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 border-b border-dashed pb-3">
                                    <div class="flex text-sm tracking-wide font-medium uppercase"><h4 class="font-medium text-base mr-auto">Payment Method </h4> <button class="btn btn-sm btn-elevated-secondary w-24 mr-0 mb-2"> Edit </button></div>

                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Credit Card
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                Ending in 5845
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col lg:flex-row mt-3">
                                        <div class="truncate sm:whitespace-normal sm:w-4/5 w-auto flex items-center">
                                            <span>
                                                Expiring
                                            </span>
                                        </div>
                                        <div class="sm:whitespace-normal items-center text-right sm:w-2/6 sm:ml-auto">
                                            <span class="font-medium">
                                                09/28
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--payout wallet detail popup-->
@endsection
