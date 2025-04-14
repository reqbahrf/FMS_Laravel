@component('mail::message')
# Hello, {{ $email }}!

Thank you for signing up with {{ config('app.name') }}. We're excited to have you on board!

To get started, please confirm your email address by using the following One-Time Password (OTP):

@component('mail::panel')
## Your Verification OTP: {{ $otp }}
@endcomponent

This OTP will expire in 30 minutes. Please enter this code on the verification page to complete your email verification.

Thank you for helping us keep your account secure!

Best regards,
The {{ config('app.name') }} Team
@endcomponent
