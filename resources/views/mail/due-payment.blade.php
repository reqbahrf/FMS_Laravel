<x-mail::message>
# Payment Due

Dear {{ $email }},

Your SETUP project with ID **{{ $projectId }}** is due on **{{ $dueDate }}**.
<x-mail::panel>
## Due Amount: ₱ {{ $dueAmount }}
</x-mail::panel>
Please make the payment as soon as possible to avoid any delays.

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>
