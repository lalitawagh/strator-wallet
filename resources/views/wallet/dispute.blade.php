@extends('ledger-foundation::layouts.master')

@section('title', 'Dispute')

@section('content')

    <!--S-Ticket-page-code-->
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
            <h2 class="intro-y text-lg font-medium mr-auto mt-2">
                View Ticket
                <div class="text-gray-600 text-xs mt-0.5">
                    <span class="event__days">Open a new ticket</span>
                </div>
            </h2>
        </div>
        <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
            <!-- BEGIN: File Manager Menu -->
            <div class="intro-y box p-5 mt-0">
                <div class="mt-1">
                    <div class="flex pr-0 border-b border-gray-200 dark:border-dark-5 pb-2 mt-0">
                        <div class="font-medium whitespace-nowrap mr-auto">Ticket ID</div>
                        <div class="text-gray-600 text-xs whitespace-nowrap"> <span class="event__days">TIC-FOPCTM</span></div>
                    </div>
                    <div class="flex pr-0 border-b border-gray-200 dark:border-dark-5 pb-2 mt-2">
                        <div class="font-medium whitespace-nowrap mr-auto">Subject</div>
                        <div class="text-gray-600 text-xs whitespace-nowrap"> <span class="event__days">New Tickets</span></div>
                    </div>
                    <div class="flex pr-0 border-b border-gray-200 dark:border-dark-5 pb-2 mt-2">
                        <div class="font-medium whitespace-nowrap mr-auto">Date </div>
                        <div class="text-gray-600 text-xs whitespace-nowrap"> <span class="event__days">22-10-2021 4:00 AM</span></div>
                    </div>
                    <div class="flex pr-0 border-b border-gray-200 dark:border-dark-5 pb-2 mt-2">
                        <div class="font-medium whitespace-nowrap mr-auto">Priority</div>
                        <div class="text-gray-600 text-xs whitespace-nowrap"> <span class="event__days">Normal</span></div>
                    </div>
                    <div class="flex pr-0 mt-2">
                        <div class="font-medium whitespace-nowrap mr-auto">Status</div>
                        <div class="text-gray-600 text-xs whitespace-nowrap">
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium w-16">Success</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: File Manager Menu -->
        </div>
        <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
            <!-- BEGIN: File Manager Filter -->
            <div class="intro-y flex flex-col-reverse sm:flex-row items-center">

                <div class="intro-x cursor-pointer relative flex items-center p-0">
                    <div class="box border-b border-gray-200 dark:border-dark-5 pb-2">
                        <div class="clearfix flex-col items-start px-5 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <form>
                                <div class="w-full">
                                    <div class="form-inline">
                                    <label for="regular-form-1" class="form-label sm:w-20">Input Text</label>
                                    <textarea id="" type="textarea" class="form-control" placeholder="Input text"></textarea>
                                    </div>
                                    <div class="md:flex mt-2">

                                            <div class="form-inline">
                                                <label for="beneficiary" class="form-label sm:w-20">Attachments</label>
                                                <input id="bic_swift_code" name="bic_swift_code" type="file" class="form-control w-full " placeholder="BIC Swift Code">
                                                <span class="text-theme-6 block mt-2"></span>
                                            </div>

                                    </div>
                                    <div class="col-span-12 float-right">
                                        <button class="btn btn-sm btn-primary w-24 mr-1 mt-2 mb-2 text-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END: File Manager Filter -->
        </div>
    </div>
    <!--E-Ticket-page-code-->

    <!--S-Ticket-reply-page-code-->
    <div class="grid grid-cols-12 gap-6">
        <div class="sm:flex col-span-12 lg:col-span-12 xxl:col-span-12">
            <h2 class="sm:flex intro-y text-lg font-medium mt-2 w-full">
                Subject New Ticket
                <div class="sm:flex text-gray-600 text-xs mt-0.5 ml-auto">
                    <span class="event__days py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium mr-2">Priority: Normal</span>
                    <span class="event__days py-1 px-2 rounded-full text-xs bg-theme-1 text-white cursor-pointer font-medium">Assignee: Admin Techvill</span>
                </div>
            </h2>
        </div>

        <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
            <!-- BEGIN: File Manager Filter -->
            <div class="intro-y items-center">

                <div class="intro-x cursor-pointer relative items-center p-0">
                    <div class="box border-b border-gray-200 dark:border-dark-5 pb-2">
                        <div class="clearfix flex-col items-start px-5 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <form>
                                <div class="md:flex mt-2">
                                    <div class="w-full px-4">
                                    <div class="form-inline mt-2">
                                        <label for="horizontal-form-5" class="form-label sm:w-20">Reply</label>
                                        <div class="form w-full ml-0">
                                        <div class="p-0" id="standard-editor">
                                            <div class="preview">
                                                <div class="editor">
                                                    <p>Content of the editor.</p>
                                                </div>
                                            </div>
                                            <div class="source-code hidden">
                                                <button data-target="#copy-standard-editor" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                                                <div class="overflow-y-auto mt-3 rounded-md">
                                                    <pre class="source-preview" id="copy-standard-editor"> <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10"> HTMLOpenTagdiv class=&quot;editor&quot;HTMLCloseTag HTMLOpenTagpHTMLCloseTagContent of the editor.HTMLOpenTag/pHTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="form-inline mt-2">
                                        <label for="regular-form-1" class="form-label sm:w-20">Status</label>
                                        <select data-search="true" class="tom-select w-full form-control">
                                            <option value="1">Open</option>
                                            <option value="2">Type and search field2</option>
                                        </select>
                                    </div>
                                    <div class="md:flex mt-2">

                                            <div class="form-inline">
                                                <label for="beneficiary" class="form-label sm:w-20">Attachments</label>
                                                <input id="bic_swift_code" name="bic_swift_code" type="file" class="form-control w-full " placeholder="BIC Swift Code">
                                                <span class="text-theme-6 block mt-2"></span>
                                            </div>

                                    </div>
                                    <div class="col-span-12 float-right">
                                        <button class="btn btn-sm btn-primary w-24 mr-1 mt-2 mb-2 text-right">Reply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                        <div class="flex flex-col items-start px-0 pt-5 border-b border-gray-200 dark:border-dark-5 pb-2 mx-5">
                            <div class="w-full flex flex-col lg:flex-row items-center">
                                <div class="w-16 h-16 image-fit">
                                    <img alt="" class="rounded-full" src="http://localhost:8000/dist/images/user.png">
                                </div>
                                <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium">Arnold Schwarzenegger</a>
                                    <div class="text-gray-600 text-xs mt-0.5">22-10-2021 4:00 AM</div>
                                </div>
                            </div>
                            <div class="text-center lg:text-left px-0 py-3">
                                <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END: File Manager Filter -->
        </div>
    </div>
    <!--E-Ticket-reply-page-code-->

@endsection
