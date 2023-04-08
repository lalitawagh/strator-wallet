<x-mail::message>
    Dear {{ $transaction->meta['sender_name'] }},
    <br>
    <br>
    <p>
        We are writing to confirm that your recent withdrawal request for {{ $transaction->meta['settled_amount'] }} has
        been processed and transferred to the
        beneficiary's bank account.
        <br>
        <br>
        Reference Number: {{ $transaction->meta['reference'] }}
        <br>
        <br>
        Please contact our support team if you do not receive the funds, or if you have any questions or concerns about
        this
        withdrawal. We are here to help you with any problems or questions you may have.
        <br>
        <br>
        Thank you for using {{ config('app.name') }} for your digital wallet needs. We appreciate your business and look
        forward to
        continuing to serve you.
    </p>
    Best regards,<br>{{ config('app.name') }}
</x-mail::message>
