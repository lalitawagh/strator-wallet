@extends('ledger-foundation::layouts.master')

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 xl:col-span-12 mt-0">
            <div class="box dark-black">
                <div class="intro-y sm:p-20">
                    <div class="grid grid-cols-12 gap-10">
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal"
                            class="intro-y block col-span-12 sm:col-span-4 2xl:col-span-3">
                            <div class="p-0 relative zoom-in">
                                <div class="flex-none relative block before:block before:w-full before:pt-[100%]">
                                    <div class="absolute top-0 left-0 w-full h-full image-fit">
                                        <img class="rounded-lg" src="{{ asset('dist/images/crypto/1.png') }}">
                                    </div>
                                </div>
                                <div
                                    class="block font-medium text-center truncate mt-0 py-3 absolute bottom-0 left-0 right-0 m-auto buying-box">
                                    Pay With Bank</div>
                            </div>
                        </a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal"
                            class="intro-y block col-span-12 sm:col-span-4 2xl:col-span-3">
                            <div class="p-0 relative zoom-in">
                                <div class="flex-none relative block before:block before:w-full before:pt-[100%]">
                                    <div class="absolute top-0 left-0 w-full h-full image-fit">
                                        <img class="rounded-lg" src="{{ asset('dist/images/crypto/2.png') }}">
                                    </div>
                                </div>
                                <div
                                    class="block font-medium text-center truncate mt-0 py-3 absolute bottom-0 left-0 right-0 m-auto buying-box">
                                    Pay With Wallet</div>
                            </div>
                        </a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal"
                            class="intro-y block col-span-12 sm:col-span-4 2xl:col-span-3">
                            <div class="p-0 relative zoom-in">
                                <div class="flex-none relative block before:block before:w-full before:pt-[100%]">
                                    <div class="absolute top-0 left-0 w-full h-full image-fit">
                                        <img class="rounded-lg" src="{{ asset('dist/images/crypto/3.png') }}">
                                    </div>
                                </div>
                                <div
                                    class="block font-medium text-center truncate mt-0 py-3 absolute bottom-0 left-0 right-0 m-auto buying-box">
                                    Pay With Card</div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!--Menu Design-->
        <div class="seller-menu gap-6 gap-6 px-5 pt-5 pb-3">
            <ul>

                <li>
                    <a href="{{ route('dashboard.wallet.crypto-account') }}">
                        <img src="{{ asset('dist/images/crypto/menu-icon1.svg') }}">
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="{{ asset('dist/images/crypto/menu-icon2.svg') }}">
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.wallet.stellar-exchange') }}">
                        <img src="{{ asset('dist/images/crypto/menu-icon4.svg') }}">
                    </a>
                </li>
                <li>
                    <a class="cryptoMenu-active" href="{{ route('dashboard.wallet.buying-crypto') }}">
                        <img src="{{ asset('dist/images/crypto/menu-icon3.svg') }}">
                    </a>
                </li>

            </ul>
        </div>
        <!--Menu Design-->
    </div>
@endsection
