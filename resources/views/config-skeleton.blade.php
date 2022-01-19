@extends('ledger-foundation::layouts.master')

@push('styles')
    <style>
        .configuration-nav {
            width: 270px;
            overflow-x: hidden;
            padding-right: 1.25rem;
            padding-bottom: 4rem;
            padding-top: 0;
        }

        .configuration-nav.side-nav--simple {
            width: 86px;
        }

        .configuration-nav .side-nav .side-menu {
            padding-left: 0.8rem;
        }

        .configuration-nav.side-nav--simple a {
            display: none;
        }

        .configuration-nav .side-nav {
            width: auto;
            color: #333;
        }

        .configuration-nav .side-nav .side-menu__title {
            color: #333;
        }

        .configuration-nav .side-nav .side-menu__icon {
            color: #333;
        }

        .configuration-nav .side-nav>ul>li>.side-menu:hover:not(.side-menu--active):not(.side-menu--open) .side-menu__icon:before {
            background-color: #f1f5f8;
            width: 100%;
            border-radius: 9999px;
        }

        .configuration-nav .side-nav ul.side-menu__sub-open {
            --tw-bg-opacity: 1;
            background-color: rgba(241, 245, 248, var(--tw-bg-opacity)) !important;
        }

        .configuration-nav.side-nav--simple .configarrow-toggle {
            top: 13px;
        }

        .configarrow-toggle {
            position: absolute;
            right: 18px;
            z-index: 10000000;
            top: 18px;
            cursor: pointer;
        }

        .configuration-nav.side-nav--simple .configarrow-toggle span {
            transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
        }

        .configuration-nav.side-nav--simple a {
            display: flex;
        }

        .configuration-nav.side-nav--simple .breadcrumb {
            display: none;
        }

        .configuration-nav.side-nav--simple .side-nav {
            padding-left: 10px;
        }

        .configuration-nav.side-nav--simple .side-nav .side-menu__title {
            opacity: 0;
        }

        .configuration-nav.side-nav--simple .side-nav>ul>li>.side-menu.side-menu--active {
            background-color: transparent;
        }

        .configuration-container {
            width: calc(100% - 305px);
            position: absolute;
            padding-left: 270px;
        }

        .configuration-container.active {
            width: calc(100% - 305px);
            position: absolute;
            padding-left: 86px;
        }

    </style>
@endpush

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="flex lg:block flex-col-reverse configuration-nav configuration-layout-sidebar">
            <div class="intro-y box mt-5 lg:mt-0" x-data="toggleConfigurationSidebarMenu()">
                <div class="relative flex items-center p-5">
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                        <a href="">Wallets</a><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon breadcrumb__icon">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                        <a href="" class="">Configuration</a>
                    </div>
                </div>
                <div class="side-nav p-5 border-t border-gray-200 dark:border-dark-5">
                    <ul>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> General </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.ledger-foundation.ledger.index') }}"
                                class="side-menu @if (Route::current()->getName() == 'dashboard.ledger-foundation.ledger.index' || Route::current()->getName() == 'dashboard.ledger-foundation.ledger.create' || Route::current()->getName() == 'dashboard.ledger-foundation.ledger.edit') side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Ledgers </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;.html"
                                class="side-menu
                                @if (Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.index' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.create' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.edit' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.index' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.create' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.edit' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.index' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.create' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.edit')
                                    side-menu--active side-menu--open
                                @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">
                                    Config Fields
                                    <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                                </div>
                            </a>
                            @if (Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.index' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.create' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.edit' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.index' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.create' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.edit' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.index' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.create' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.edit')
                                <ul class="xl:pl-6 sm:pl-6 side-menu__sub-open" style="display: block;">
                                @else
                                    <ul class="xl:pl-6 sm:pl-6">
                            @endif
                        <li>
                            <a href="{{ route('dashboard.ledger-foundation.asset-type.index') }}"
                                class="side-menu  @if (Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.index' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.create' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-type.edit')
                                         side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Asset Type </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.ledger-foundation.asset-class.index') }}"
                                class="side-menu
                                    @if (Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.index' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.create' || Route::current()->getName() == 'dashboard.ledger-foundation.asset-class.edit')
                                         side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Asset Class </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.ledger-foundation.commodity-type.index') }}"
                                class="side-menu @if (Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.index' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.create' || Route::current()->getName() == 'dashboard.ledger-foundation.commodity-type.edit')  side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Commodity Type </div>
                            </a>
                        </li>
                    </ul>
                    </li>
                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Notifications </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> ForEx </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Fees Setup </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Payment Methods </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="side-menu">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Preferences </div>
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="configarrow-toggle">
                    <span x-on:click="toggle" class="w-5 h-5 block" href="javascript:;" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-arrow-left block mx-auto block mx-auto">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                    </span>
                </div>
            </div>

        </div>
        @yield('config-content')
    </div>
@endsection

@push('scripts')
    <script>
        function toggleConfigurationSidebarMenu() {
            return {
                toggle() {
                    $(".configuration-layout-sidebar").toggleClass("side-nav--simple");
                    $(".configuration-container").toggleClass("active");
                }
            }
        }
    </script>
@endpush
