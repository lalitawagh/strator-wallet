@extends('ledger-foundation::layouts.master')
@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 xl:col-span-2 mt-0"></div>
        <div class="col-span-12 xl:col-span-8 m-auto w-full mt-0">
            <div class="intro-y col-span-12 md:col-span-12">
                <div class="box">
                    <div class="flex-col lg:flex-row items-center p-3 border-b border-slate-200/60 dark:border-darkmode-400">

                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <h3 class="text-lg font-medium truncate mr-5">Create an Crypto Portfolio</h3>
                        </div>

                    </div>
                    <div class="flex-wrap lg:flex-nowrap items-center justify-center p-5">
                        <h3 class="text-md font-medium pb-3">Terms & Conditions</h3>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book.
                        </p>
                        <div class="form-check mt-5">
                            <input id="vertical-form-3" class="form-check-input" type="checkbox" value="">
                            <label class="form-check-label" for="vertical-form-3">Iagree to the <a href="">Terms and
                                    conditions & Privacy Policy</a></label>
                        </div>
                        <div class="text-right mt-4">
                            <button class="btn org-clr py-1 px-2 mr-2" data-tw-toggle="modal"
                                data-tw-target="#copyModal">Setup an account</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 xl:col-span-2 mt-0"></div>
    </div>

    <!--Copy modal-->
    <!-- BEGIN: Modal Toggle -->

    <!-- BEGIN: Modal Content -->
    <div id="copyModal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x"
                        class="w-8 h-8 text-slate-400"></i> </a>
                <div class="modal-body p-0">
                    <div class="p-5 text-center"> <i data-lucide="check-circle"
                            class="w-16 h-16 text-success mx-auto mt-3"></i>
                        <div class="text-2xl mt-5">Your account created successfully</div>
                    </div>

                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="col-span-12 sm:col-span-12">
                            <label for="modal-form-1" class="form-label mr-auto w-full flex gap-2">Public Key <a
                                    href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" icon-name="copy" data-lucide="copy"
                                        class="lucide lucide-copy block mx-auto">
                                        <rect x="9" y="9" width="13" height="13" rx="2"
                                            ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>
                                    </svg></a></label>
                            <input id="modal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                        </div>
                        <div class="col-span-12 sm:col-span-12">
                            <label for="modal-form-2" class="form-label mr-auto w-full flex gap-2">Secret Key <a
                                    href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" icon-name="copy" data-lucide="copy"
                                        class="lucide lucide-copy block mx-auto">
                                        <rect x="9" y="9" width="13" height="13" rx="2"
                                            ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>
                                    </svg></a></label>
                            <input id="modal-form-2" type="text" class="form-control" placeholder="example@gmail.com">
                        </div>
                    </div>

                    <div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal"
                            class="btn w-24 org-clr" data-tw-toggle="modal" data-tw-target="#keyQmodal">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END: Modal Content -->
    <!--Copy modal-->
    <div id="keyQmodal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <div class="text-slate-100 mt-2 font-medium text-lg xl:text-xl">
                            Have you saved your secret key? because it will be visible for first time only
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal"
                            class="btn recive-outer w-24 mr-1">No</button>
                        <a href="{{ route('dashboard.wallet.stellar-dashboard') }}" type="button"
                            class="btn org-clr w-24">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
