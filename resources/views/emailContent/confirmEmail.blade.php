@component('mail::message')
# Hello, {{ $userName }}!

Thank you for signing up with {{ config('app.name') }}. We’re excited to have you on board!

To get started, please confirm your email address by clicking the button below:

@component('mail::button', ['url' => $verificationUrl])
Verify Email
@endcomponent

If the button above doesn't work, you can also verify your email by clicking the following link:
[{{ $verificationUrl }}]({{ $verificationUrl }})

Thank you for helping us keep your account secure!

Best regards,
The {{ config('app.name') }} Team
@endcomponent

