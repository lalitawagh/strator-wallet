<x-mail::message>

    Dear {{ $customerFirstName }} {{ $customerLastName }},
    <br>
    <br>
    We have received your manual deposit of {{ $amount }} to your {{ $walletName }} wallet. Your account has
    been credited with
    the amount deposited.<br><br>
    Please note that it may take up to 24 hours for the deposit to reflect in your account. If you do not see the
    funds
    credited to your account after this time, please contact our support team at {{ env('SUPPORT_EMAIL ') }} or
    {{ env('SUPPORT_MOBLE_NO ') }} for
    further assistance.<br><br>
    Thank you for using our {{ $walletName }} wallet. If you have any further questions or concerns, please do not
    hesitate
    to reach out to us.<br>
    <br>

    Best regards,<br>
    {{ config('app.name') }}
</x-mail::message>
