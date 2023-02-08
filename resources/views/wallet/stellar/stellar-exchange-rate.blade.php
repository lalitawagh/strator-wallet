@extends('ledger-foundation::wallet.stellar.skeleton')
   
@section('stellar-content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="col-span-12 xl:col-span-12 mt-0">
        <div class="intro-y mb-3 p-0 sellerTabs">
            <ul class="nav nav-link-tabs pt-2" role="tablist">
                <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                    <button
                        class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#seller-detail1"
                        type="button" role="tab" aria-controls="seller-detail1" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" icon-name="filter" data-lucide="filter"
                             class="lucide lucide-filter inline-block">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                    </button>
                </li>
                @foreach ($stellarCurrencies as $key =>  $stellarCurrency)
                    <li id="example-{{$key}}-tab" class="nav-item flex-1" role="presentation">
                        <button
                            class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#seller-detail{{$key}}"
                            type="button" role="tab" aria-controls="seller-detail2" aria-selected="false">
                            <img src="{{ asset('dist/images/crypto/5.png') }}"> {{ $stellarCurrency }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-0 p-5">
                @foreach ($stellarCurrencies as $key =>  $stellarCurrency)
                <div id="seller-detail{{$key}}" class="tab-pane leading-relaxed @if($key == 0) active @endif" role="tabpanel"
                     aria-labelledby="example-6-tab">
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="box dark-black">
                                <div class="items-start px-5 py-5">
                                    <div class="w-full flex-col lg:flex-row items-center">
                                        <div class="flex w-full">
                                            <div class="ml-0 mr-auto">
                                                <div class="text-xl 2xl:text-2xl font-medium text-warning">
                                                    @if($stellarCurrency == 'XLM')
                                                        {{ @$stellarBalance['balance'][0]['balance'] }} 
                                                        {{ @$stellarBalance['balance'][0]['asset_code'] }} 
                                                    @else 
                                                        0
                                                        {{ $stellarCurrency }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="w-8 h-8 flex-none image-fit rounded-md overflow-hidden">
                                                <img alt="rounded-md border border-white"
                                                     src=" {{ asset('dist/images/crypto/5.png') }} ">
                                            </div>
                                        </div>
                                        {{-- <div class="flex-col sm:flex-row">
                                            <div class="text-left pt-3 mr-auto">
                                                <div class="text-xl 2xl:text-2xl font-medium text-white">&#163;
                                                    2456.00
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div
                                        class="text-center p-0 md:mt-10 mb-4 border-slate-200/60 dark:border-darkmode-400 usdc-wrapper">
                                        <a href="{{ route('dashboard.wallet.stellar-payouts.create', ['filter' => ['workspace_id' => \Kanexy\PartnerFoundation\Core\Helper::activeWorkspaceId()]]) }}" class="btn btn-send py-1 px-2 mr-2 mt-3 col">Send</a>
                                        <button class="btn btn-flip py-1 px-2 mr-2 col-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 icon-name="repeat" data-lucide="repeat"
                                                 class="lucide lucide-repeat block mx-auto">
                                                <path d="M17 2l4 4-4 4"></path>
                                                <path d="M3 11v-1a4 4 0 014-4h14"></path>
                                                <path d="M7 22l-4-4 4-4"></path>
                                                <path d="M21 13v1a4 4 0 01-4 4H3"></path>
                                            </svg>
                                        </button>
                                        <a class="btn btn-recive py-1 px-2  mt-3 col">Receive</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="box dark-black">
                                <div class="items-start px-5 py-5">
                                    <div class="w-full flex-col lg:flex-row items-center">
                                        <div class="flex w-full">
                                            <div class="ml-0 mr-auto">
                                                <div class="ml-4 mr-auto">
                                                    <div class="font-medium">Price Chart</div>
                                                    <div class="text-success text-xs mt-0.5">&#163; 2456.00</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <img src="{{ asset('dist/images/crypto/pinchart-img.png') }}"
                                         style="max-width: 100%;height: 144px;width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-12 mt-5">
                        <!-- BEGIN: Horizontal Form -->
                        <div class="intro-y box dark-black mt-0 pt-10">
                           
                            
                            <div class="grid rounded-lg w-12/12 md:w-6/12 lg:w-6/12 m-auto p-0">
                                <h3 class="text-lg font-medium mb-4 text-white">Enter The Amount To Transfer</h3>
                                @livewire('stellar-exchange-rate-convert')
                            </div>

                            @if(!is_null($exchangedAmount))
                            <div class="text-right">
                            <h4 class="text-xl 2xl:text-2xl font-medium text-white">{{ $amount }} {{ $currency}} =</h4>
                            <h6 class="text-xl 2xl:text-2xl font-medium text-white">{{ $exchangedAmount}} {{ $conversionCurrency}}</h6>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
        <script>
            $url = window.location.pathname.split('/');
            if ($url[3] == 'stellar-exchange-rate') {
                $('#color-scheme-content').addClass('dark');
            }
        </script>
@endpush