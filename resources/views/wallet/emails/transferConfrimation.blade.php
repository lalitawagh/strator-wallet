<x-mail::message>
    Dear {{ $transaction->meta['sender_name'] }},
    <br>
    <br>
    <p>
        We are writing to confirm that your recent transfer request for the amount from
        {{ $transaction->meta['sender_currency'] }} to the amount of {{ $transaction->meta['receiver_currency'] }}
        has been successfully processed to your {{ $transaction->meta['beneficiary_name'] }} wallet account.
        <br>
        <br>
        Reference Number: {{ $transaction->meta['reference'] }}
        <br>
        <br>
        The transfer was made within your wallet account and the funds should be immediately available for use. You can
        verify this transfer by checking your account balance.
        <br>
        <br>
        If you have any questions or concerns about this transfer, please do not hesitate to contact our customer
        support
        team at {{ env('SUPPORT_EMAIL ') }}. We are available at your convenience to assist you with any issues or
        questions
        you may
        have.
        <br>
        <br>
        Thank you for using {{ config('app.name') }} for your digital wallet needs. We appreciate your business and look
        forward to
        continuing to serve you.
        <br>
        <br>
    <p>
        Best regards,<br>{{ config('app.name') }}
</x-mail::message>
