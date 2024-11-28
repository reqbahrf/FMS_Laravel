@component('mail::message')
# Application Status Update

Hi {{ $recipientEmail }},

We regret to inform you that your application has been rejected for the following reason(s):

@foreach ($reasons as $reason)
- {{ $reason }}
@endforeach

@if ($additionalComments)
Additional Comments:
{{ $additionalComments }}
@endif

If you have any questions, please don't hesitate to contact us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
