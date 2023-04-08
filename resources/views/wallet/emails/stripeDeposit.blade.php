<x-mail::message>

Dear {{ $customerFirstName }} {{ $customerLastName }},
<br>
<br>

We are writing to confirm that your recent {{$depositFrom}} {{$amount}} to {{$depositTo}} using stripe was successfully processed and credited to your Dhigna wallet account.
<br>
<br>

If you have not received your funds by this time, please contact our support team at {{env('SUPPORT_EMAIL ')}} or {{env('SUPPORT_MOBLE_NO ')}} for further assistance.
<br>
 Please reach out to us for any queries.
<br>
<br>
Thank you for using Dhigna for your digital wallet requirements. We appreciate your support and look forward to continuing to serve you.
<br>
<br>


Best regards,<br>
{{ config('app.name') }}
</x-mail::message>
