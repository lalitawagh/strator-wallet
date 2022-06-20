@php
$totalAmount = $transaction->amount;
@endphp
@if(isset($transaction->transaction_fee) && $transaction->transaction_fee != 0)
    @php
        $totalAmount = $transaction->amount + $transaction->transaction_fee;
    @endphp
@endif
<div class="border-2 border-dashed border-gray-200 dark:border-dark-5 rounded-md sm:p-5 sm:m-3">
    <div class=" p-3 bg-gray-200 sm:flex text-lg text-theme-1 dark:text-theme-10 font-medium mb-3">
        <h3 class="text-lg font-medium mr-auto mb-0">Deposit Account Details</h3>
        <div class="text-xs text-right sm:ml-auto flex mb-0">
            <a target="_blank" href="https://mail.google.com/mail/u/0/?fs=1&tf=cm&subject=Manual Deposit Account Details&body= Payee Name :- {{  $transaction?->meta['sender_name'] }} %0D%0A Payment reference :- {{ @$transaction?->meta['reference_no'] }} %0D%0A Amount To Send:- {{ $totalAmount }} {{ $transaction?->settled_currency }}
                    %0D%0A Bank Account Name:- {{ $depositMasterAccountDetails['account_holder_name'] }} %0D%0A Account Number :- {{ $depositMasterAccountDetails['account_number'] }} %0D%0A  @isset($depositMasterAccountDetails['sort_code']) Sort Number:- {{ @$depositMasterAccountDetails['sort_code'] }} @else IFSC Code:- {{ @$depositMasterAccountDetails['ifsc_code'] }} @endisset ">
                <i data-feather="share-2" class="dark:text-gray-300 block mx-auto mr-2"></i>
            </a>
            <a href="javascript:void(0);" onclick="get_pdf('manual')"><i data-feather="download" class="dark:text-gray-300 block mx-auto mr-2"></i></a>
            <a onclick="copyData(this)"
                data-copy="Manual Deposit Account Details- Payee Name :- {{  $transaction?->meta['sender_name'] }}  Payment reference :- {{ @$transaction?->meta['reference_no'] }}  Amount To Send:- {{ $totalAmount }} {{ $transaction?->settled_currency }}
                    Bank Account Name:- {{ $depositMasterAccountDetails['account_holder_name'] }}  Account Number :- {{ $depositMasterAccountDetails['account_number'] }}  @isset($depositMasterAccountDetails['sort_code']) Sort Number:- {{ @$depositMasterAccountDetails['sort_code'] }} @else   IFSC Code:- {{ @$depositMasterAccountDetails['ifsc_code'] }} @endisset  "
                href="javascript:void(0);">
                <i data-feather="copy" class="dark:text-gray-300 block mx-auto mr-2"></i>
            </a>
        </div>
    </div>

    <div class="px-5 mt-5 sm:px-0 flex flex-col-reverse sm:flex-row grid grid-cols-12 gap-2">
            <div
            class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
            <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Payee Name</div>
            <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                {{ $transaction?->meta['sender_name'] }}
            </div>
        </div>
        <div
            class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
            <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Payment Reference </div>
            <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                {{ @$transaction?->meta['reference_no'] }}
            </div>
        </div>
        <div
            class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
            <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Amount to Send </div>
            <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                {{ $totalAmount }}
                {{ $transaction?->settled_currency }}
            </div>
        </div>
        <div
            class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
            <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Bank Account Name </div>
            <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                {{ $depositMasterAccountDetails['account_holder_name'] }}</div>
        </div>
        <div
            class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
            <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Bank Account Number </div>
            <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                {{ $depositMasterAccountDetails['account_number'] }}</div>
        </div>
        @isset($depositMasterAccountDetails['sort_code'])
            <div
                class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
                <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Bank Account Sort Code </div>
                <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                    {{ $depositMasterAccountDetails['sort_code'] }}</div>
            </div>
        @else
            <div
                class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 sm:flex sm:px-4">
                <div class="font-medium sm:w-3/4 text-base text-gray-600 mr-2 mr-auto">Bank Account IFSC Code </div>
                <div class="text-base text-theme-1 dark:text-theme-10 font-medium mt-0 sm:w-2/3 text-sm text-left">
                    {{ $depositMasterAccountDetails['ifsc_code'] }}</div>
            </div>
        @endisset

    </div>

</div>
<div class="text-right mt-5 form-inline text-right mt-5 float-right">
<a href="{{ route('dashboard.wallet.deposit-final-detail', ['filter' => ['workspace_id' => $transaction?->workspace_id]]) }}"
class="btn btn-primary w-24">Continue</a>
</div>


@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

    <script>
        function get_pdf(type) {
            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function(element, renderer) {
                    return true;
                }
            };
            if (type == 'manual') {
                doc.fromHTML(
                    '<h2>Manual Deposit Account Details</h2><div><div class="text-lg font-medium text-theme-1 dark:text-theme-10 mt-2"> Payee Name :- {{ $transaction?->meta['sender_name'] }} </br></div><div class="mt-1">Payment reference :- @isset($transaction?->meta['reference_no']) {{ @$transaction?->meta['reference_no'] }} @endisset</br></div><div class="mt-1">Amount to send :- @isset($totalAmount) {{ $totalAmount }} {{ $transaction?->settled_currency }} @endisset </br></div><div class="mt-1">Bank Account Name :- {{ $depositMasterAccountDetails['account_holder_name'] }} </br></div><div class="mt-1">Bank Account Number :- {{ $depositMasterAccountDetails['account_number'] }} </br></div><div class="mt-1"> @isset($depositMasterAccountDetails['sort_code']) Sort Number:- {{ @$depositMasterAccountDetails['sort_code'] }} @else   IFSC Code:- {{ @$depositMasterAccountDetails['ifsc_code'] }} @endisset </br></div></div>',
                    15, 15, {
                        'width': 170,
                        'elementHandlers': specialElementHandlers
                    });
                doc.save('manual-transfer-bank-detail.pdf');
            }
        }

        function copyToClipboard(text, el) {
            var copyTest = document.queryCommandSupported('copy');
            var elOriginalText = el.attr('data-original-title');

            if (copyTest === true) {
                var copyTextArea = document.createElement("textarea");
                copyTextArea.value = text;
                document.body.appendChild(copyTextArea);
                copyTextArea.select();
                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'Copied!' : 'Whoops, not copied!';
                    el.attr('data-original-title', msg).tooltip('show');
                } catch (err) {
                    console.log('Oops, unable to copy');
                }
                document.body.removeChild(copyTextArea);
                el.attr('data-original-title', elOriginalText);
            } else {
                // Fallback if browser doesn't support .execCommand('copy')
                window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
            }
        }

        function copyData(the) {
            var text = $(the).attr('data-copy');
            var el = $(the);
            copyToClipboard(text, el);
        }
    </script>
@endpush
