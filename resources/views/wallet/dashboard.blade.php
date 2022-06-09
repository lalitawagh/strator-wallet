@extends('concepts::layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('dist/css/wallet.css') }}" />
@endpush

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12">

            <div class="grid grid-cols-12 gap-3">
                <div class="col-span-12 md:col-span-8 lg:col-span-8 mt-3">

                    <div class="intro-y shadow-lg p-3 rounded-2xl bg-white p-5  h-full">
                        <div class="flex flex-col xl:flex-row xl:items-center">
                            <div class="flex">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Transactions
                                </h2>
                            </div>
                            <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                                <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700 dark:text-gray-300">
                                    <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                                    <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-12 md:col-span-12 lg:col-span-8 mt-3">
                                <div class="report-chart">
                                    <canvas id="report-line-chart" height="250" class="mt-6"></canvas>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-12 lg:col-span-4 mt-3">
                                <div class="grid grid-cols-12 gap-0">
                                    <div class="col-span-12 lg:col-span-12 mt-8">
                                        <div>
                                            <div class="mt-0.5 text-gray-600 dark:text-gray-600">Paid In</div>
                                            <div class="text-lg xl:text-xl font-bold">
                                                £33.00
                                                <div class="progress">
                                                    <div class="progress-bar w-1/2 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-12 mt-8">
                                        <div>
                                            <div class="mt-0.5 text-gray-600 dark:text-gray-600">Paid Out</div>
                                            <div class="text-lg xl:text-xl font-bold">
                                                £3.36
                                                <div class="progress">
                                                    <div class="progress-bar w-1/2 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-lg p-3 rounded-2xl bg-white col-span-12 md:col-span-4 lg:col-span-4 mt-3">
                    <div class="mt-2">
                        <h2 class="text-lg font-medium truncate mb-3">
                            Latest Transactions
                        </h2>
                        <div class="intro-x">
                            <div class="rounded-xl btn-secondary hover:bg-theme-1 hover:text-white px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="" src="https://dev.kanexy.com/dist/images/user.png">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Al Pacino</div>
                                    <div class="text-xs mt-0.5">17 January 2021</div>
                                </div>
                                <div class="">+$35</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="rounded-xl btn-secondary hover:bg-theme-1 hover:text-white px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="" src="https://dev.kanexy.com/dist/images/user.png">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Russell Crowe</div>
                                    <div class="text-xs mt-0.5">24 May 2021</div>
                                </div>
                                <div class="">+$48</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="rounded-xl btn-secondary hover:bg-theme-1 hover:text-white px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="" src="https://dev.kanexy.com/dist/images/user.png">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Leonardo DiCaprio</div>
                                    <div class="text-xs mt-0.5">21 June 2022</div>
                                </div>
                                <div class="">+$61</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="rounded-xl btn-secondary hover:bg-theme-1 hover:text-white px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="" src="https://dev.kanexy.com/dist/images/user.png">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Keanu Reeves</div>
                                    <div class="text-xs mt-0.5">17 January 2021</div>
                                </div>
                                <div class="">-$37</div>
                            </div>
                        </div>
                        <div class="intro-x">
                            <div class="rounded-xl btn-secondary hover:bg-theme-1 hover:text-white px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="" src="https://dev.kanexy.com/dist/images/user.png">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">Will Smith</div>
                                    <div class="text-xs mt-0.5">26 April 2020</div>
                                </div>
                                <div class="">-$24</div>
                            </div>
                        </div>
                        <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">View More</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
