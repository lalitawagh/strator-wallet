@extends('ledger-foundation::layouts.master')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <div class="intro-y box">


                        <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                            <a
                                class="flex items-center @if (\Illuminate\Support\Facades\Route::currentRouteName() === 'dashboard.ledger-foundation.asset-type.index' || \Illuminate\Support\Facades\Route::currentRouteName() === 'dashboard.ledger-foundation.asset-type.create') text-theme-1 dark:text-theme-10 font-medium @endif"
                                href="{{ route('dashboard.ledger-foundation.asset-type.index') }}"
                            >
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i> Asset Type
                            </a>

                            <a
                                class="flex items-center mt-5 @if (\Illuminate\Support\Facades\Route::currentRouteName() === 'dashboard.ledger-foundation.asset-class.index' || \Illuminate\Support\Facades\Route::currentRouteName() === 'dashboard.ledger-foundation.asset-class.create') text-theme-1 dark:text-theme-10 font-medium @endif"
                                href="{{ route('dashboard.ledger-foundation.asset-class.index') }}"
                            >
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i> Asset Class
                            </a>

                            <a
                                class="flex items-center mt-5 @if (\Illuminate\Support\Facades\Route::currentRouteName() === 'dashboard.ledger-foundation.commodity-type.index' || \Illuminate\Support\Facades\Route::currentRouteName() === 'dashboard.ledger-foundation.commodity-type.create') text-theme-1 dark:text-theme-10 font-medium @endif"
                                href="{{ route('dashboard.ledger-foundation.commodity-type.index') }}"
                            >
                                <i data-feather="activity" class="w-4 h-4 mr-2"></i> Commodity type
                            </a>
                        </div>
                    </div>
                </div>


                @yield('config-content')
            </div>
        </div>
    </div>
@endsection
