<div id="transaction-detail-modal" class="modal modal-slide-over z-50" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-5">
                <h2 class="font-medium text-base mr-auto">Transaction Details</h2>
                <div class="edit-transaction cursor-pointer intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 ml-2 tooltip" title="Edit"> <i data-feather="edit" class="w-3 h-3"></i> </div>
                <a class="save-transaction cursor-pointer hidden intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-2 tooltip" title="Save"> <i data-feather="save" class="w-3 h-3"></i> </a>
                <a class="close intro-x cursor-pointer w-8 h-8 flex items-center justify-center rounded-full bg-theme-6 text-white ml-2 tooltip" title="Close" data-dismiss="modal"> <i data-feather="x" class="w-3 h-3"></i> </a>
                <!--<a href="" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 ml-2 tooltip" title="Share"> <i data-feather="share-2" class="w-3 h-3"></i> </a>
                <a href="" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-2 tooltip" title="Download PDF"> <i data-feather="share" class="w-3 h-3"></i> </a>-->
            </div>

            <div class="modal-body">
                @livewire('wallet-transaction-detail-component')
            </div>
        </div>
    </div>
</div>