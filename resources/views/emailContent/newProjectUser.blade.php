@component('mail::message')
# Welcome to the Project Registration System!

Your account has been successfully created. You can now log in to the system using the following credentials:

@component('mail::panel')
- **Username:** {{ $user->user_name }}
- **Email:** {{ $user->email }}
- **Password:** {{ $password }}
@endcomponent

Please make sure to change your password after logging in for the first time.

@component('mail::button', ['url' => '/login'])
Login Now
@endcomponent

Best regards,
{{ config('app.name') }}
@endcomponent
