<x-mail::message>
    Dear {{ $firstName }} {{ $lastName }},
    <br>
    We are writing to confirm that a debit transaction has been successfully processed on your account with
    {{ config('app.name') }}.The details of the transaction are as follows:
    <br>
    <br>
    Transaction Date: {{ $transactionDate }}
    <br>
    Transaction From: {{ $payoutFrom }}
    <br>
    Transaction Amount: {{ $transactionAmount }}
    <br>
    Transaction Type: Debit
    <br>
    Transaction Reference Number: {{ $transactionRefferenceNo }}
    <br>
    <br>
    <br>
    If you have any questions or concerns regarding this transaction, please do not hesitate to contact our customer
    support team at {{ env('SUPPORT_EMAIL') }}.
    <br>
    <br>
    Thank you for using {{ config('app.name') }} for your financial needs. We look forward to continuing to serve you in
    the future.
    <br>
    <br>

    Best regards,<br>{{ config('app.name') }}
</x-mail::message>
