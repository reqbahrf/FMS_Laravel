@component('mail::message')
# Hello {{ $notifiable->name }},

We’re reaching out to let you know that your evaluation has been scheduled. Here are the details:

@component('mail::panel')
**Scheduled Date**: {{ $evaluationDate }}
@endcomponent

Please ensure you’re prepared for the scheduled evaluation. If you need to reschedule or have any questions, feel free to reach out to us.

Thank you for choosing {{ config('app.name') }}. We look forward to your evaluation!

Best regards,
The {{ config('app.name') }} Team

@endcomponent
