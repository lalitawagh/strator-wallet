@extends('ledger-foundation::layouts.master')

@section('title', 'Wallet Deposit')

@section('content')
    <div class="grid grid-cols-12 gap-6 ">
        <div class="sm:col-span-3"></div>
        <div class="col-span-12 md:col-span-8 xl:col-span-6 sm:col-span-8">
            <div class="box">
                <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
                    <h2 class="font-medium text-base mr-auto">
                        Deposit
                    </h2>
                </div>
                <!-- BEGIN: Wizard Layout -->
                <div class="intro-y box py-10 sm:py-10 mt-0 clearfix">
                    @yield('deposit-content')
                </div>
                <!-- END: Wizard Layout -->
            </div>
        </div>
    </div>
@endsection
