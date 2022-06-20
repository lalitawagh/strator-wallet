@extends('ledger-foundation::layouts.master')

@push('styles')
    <style>
        .configuration-nav {
            width: 405px;
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
            /* width: calc(100% - 305px);
            position: absolute;
            padding-left: 250px; */
        }

        .configuration-container.active {
            /* width: calc(100% - 305px);
            position: absolute;
            padding-left: 80px; */
        }


        /* New */
        .configuration-nav {
    /* width: 235px; */
    overflow-x: hidden;
    padding-right: 0;
    padding-bottom: 4rem;
    padding-top: 0;
}
.configuration-nav.side-nav--simple {
    width: 65px;
}
.configuration-nav .side-nav .side-menu{
    padding-left: 0.8rem;
    height: 32px;
}
.configuration-nav.side-nav--simple a {
    display: none;
}
.configuration-nav .side-nav {width: auto;color: #333;}

.configuration-nav .side-nav .side-menu__title {
    color: #333;
    display:flex !important;
}
.configuration-nav .side-nav .side-menu.side-menu--active .side-menu__title,
.configuration-nav .side-nav .side-menu.side-menu--active .side-menu__icon {
    color: rgba(112, 41, 125, var(--tw-text-opacity)) !important;
}
.configuration-nav .side-nav .side-menu__icon {
    color: #333;
}
.configuration-nav .side-nav>ul>li>.side-menu.side-menu--active {
    --tw-bg-opacity: 1;
    background-color:transparent !important;
}
.configuration-nav .side-nav>ul>li>.side-menu:hover:not(.side-menu--active):not(.side-menu--open) .side-menu__icon:before {
    background-color: transparent;
    width: 100%;
    color: rgba(112, 41, 125, var(--tw-text-opacity)) !important;
    border-radius: 9999px;
}
.configuration-nav .side-nav ul.side-menu__sub-open {
    --tw-bg-opacity: 1;
    background-color: transparent !important;
}
.configuration-nav .side-nav>ul ul {
    --tw-bg-opacity: 0;
    background-color: transparent !important;
}
.configuration-nav.side-nav--simple .configarrow-toggle {
    top: 14px;
    right: 20px;
}
.configarrow-toggle {
    position: absolute;
    right: 18px;
    z-index: 10000000;
    top: 10px;
    cursor: pointer;
}
.configarrow-toggle svg {
    width: 20px;
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
    padding-top:40px;
}
.configuration-nav.side-nav--simple .side-nav .side-menu__title {
    opacity: 0;
}
.configuration-nav .side-nav>ul>li>.side-menu.side-menu--active:before{
    display: none;
}

.configuration-nav.side-nav--simple .side-nav>ul>li>.side-menu.side-menu--active{
    background-color: transparent !important;
}
.configuration-container {
    /* width: calc(100% - 305px);
    position: absolute;
    padding-left: 405px; */
}
.configuration-container.active {
    /* width: calc(100% - 305px);
    position: absolute;
    padding-left: 86px; */
}
.configuration-nav .side-nav .side-menu__icon svg {
    width: 20px;
}
/* .configuration-nav .side-nav, .configuration-nav .side-nav .side-menu__title {
    display: block;
} */
.configuration-nav.side-nav--simple .side-menu__sub-open {
display: contents !important;
}

/* .valid_date_show
{
    display: flex;
} */

@media (max-width:767px) {
    .configarrow-toggle{
        display: none;
    }
    body .configuration-nav {
        width: 100%;
        margin-bottom: 10px;
        padding-bottom: 0;
        padding-right: 0;
    }
    .configuration-nav .side-nav {
        display: block;
    }
    .configuration-nav .side-nav .side-menu .side-menu__title,
    .configuration-nav .side-nav .side-menu .side-menu__title .side-menu__sub-icon {
        display: inherit;
    }
    .configuration-nav .side-nav ul.side-menu__sub-open {
        --tw-bg-opacity: 1;
        background-color: transparent !important;
        padding-left: 30px;
    }
    .configuration-nav.side-nav--simple .side-menu__sub-open {
        display: contents !important;
    }
    .breadcrumb{
        display: flex;
    }
    .configuration-container{
        width: 100%;
        position: inherit;
        padding-left: 0;
    }
}
        /* New */

    </style>
@endpush

@section('content')
    <div class="md:flex w-full gap-3 mt-0">
        <div class="intro-y box sm:w-1/4 configuration-nav configuration-layout-sidebar">
            <div class="mt-0 lg:mt-0" x-data="toggleConfigurationSidebarMenu()">
                <div class="relative flex items-center p-3">
                    <div class="breadcrumb mr-auto hidden sm:flex">
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
                            <a href="{{ route('dashboard.wallet.ledger.index') }}"
                                class="side-menu @if (Route::current()->getName() == 'dashboard.wallet.ledger.index' || Route::current()->getName() == 'dashboard.wallet.ledger.create' || Route::current()->getName() == 'dashboard.wallet.ledger.edit') side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Ledgers </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;.html"
                                class="side-menu
                                @if (Route::current()->getName() == 'dashboard.wallet.asset-type.index' || Route::current()->getName() == 'dashboard.wallet.asset-type.create' || Route::current()->getName() == 'dashboard.wallet.asset-type.edit' || Route::current()->getName() == 'dashboard.wallet.asset-class.index' || Route::current()->getName() == 'dashboard.wallet.asset-class.create' || Route::current()->getName() == 'dashboard.wallet.asset-class.edit' || Route::current()->getName() == 'dashboard.wallet.commodity-type.index' || Route::current()->getName() == 'dashboard.wallet.commodity-type.create' || Route::current()->getName() == 'dashboard.wallet.commodity-type.edit')
                                    side-menu--active side-menu--open
                                @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title">
                                    Config Fields
                                    <div class="side-menu__sub-icon"> <i data-feather="chevron-down"></i> </div>
                                </div>
                            </a>
                            @if (Route::current()->getName() == 'dashboard.wallet.asset-type.index' || Route::current()->getName() == 'dashboard.wallet.asset-type.create' || Route::current()->getName() == 'dashboard.wallet.asset-type.edit' || Route::current()->getName() == 'dashboard.wallet.asset-class.index' || Route::current()->getName() == 'dashboard.wallet.asset-class.create' || Route::current()->getName() == 'dashboard.wallet.asset-class.edit' || Route::current()->getName() == 'dashboard.wallet.commodity-type.index' || Route::current()->getName() == 'dashboard.wallet.commodity-type.create' || Route::current()->getName() == 'dashboard.wallet.commodity-type.edit')
                                <ul class="xl:pl-6 sm:pl-6 side-menu__sub-open" style="display: block;">
                                @else
                                    <ul class="xl:pl-6 sm:pl-6">
                            @endif
                        <li>
                            <a href="{{ route('dashboard.wallet.asset-type.index') }}"
                                class="side-menu  @if (Route::current()->getName() == 'dashboard.wallet.asset-type.index' || Route::current()->getName() == 'dashboard.wallet.asset-type.create' || Route::current()->getName() == 'dashboard.wallet.asset-type.edit')
                                         side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Asset Type </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.wallet.asset-class.index') }}"
                                class="side-menu
                                    @if (Route::current()->getName() == 'dashboard.wallet.asset-class.index' || Route::current()->getName() == 'dashboard.wallet.asset-class.create' || Route::current()->getName() == 'dashboard.wallet.asset-class.edit')
                                         side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Asset Class </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.wallet.commodity-type.index') }}"
                                class="side-menu @if (Route::current()->getName() == 'dashboard.wallet.commodity-type.index' || Route::current()->getName() == 'dashboard.wallet.commodity-type.create' || Route::current()->getName() == 'dashboard.wallet.commodity-type.edit')  side-menu--active @endif">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Commodity Type </div>
                            </a>
                        </li>
                    </ul>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.wallet.exchange-rate.index') }}"
                            class="side-menu @if (Route::current()->getName() == 'dashboard.wallet.exchange-rate.index' || Route::current()->getName() == 'dashboard.wallet.exchange-rate.create' || Route::current()->getName() == 'dashboard.wallet.exchange-rate.edit') side-menu--active @endif">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Exchange Rate </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.wallet.master-account.index') }}"
                            class="side-menu @if (Route::current()->getName() == 'dashboard.wallet.master-account.index' || Route::current()->getName() == 'dashboard.wallet.master-account.create' || Route::current()->getName() == 'dashboard.wallet.master-account.edit') side-menu--active @endif">
                            <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="side-menu__title"> Master Account </div>
                        </a>
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

        function toggleHardStop(the) {
            var value = $(the).val();
            if($(the).prop("checked"))
            {
                $(".valid_date").removeClass("hidden");
                $(".valid_date").toggleClass("valid_date_show");
            }else{
                $(".valid_date").removeClass("valid_date_show");
                $(".valid_date").toggleClass("hidden");
            }

        }
    </script>
@endpush
