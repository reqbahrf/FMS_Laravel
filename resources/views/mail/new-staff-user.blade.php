@component('mail::message')
# Welcome, {{ $orgUserInfo->f_name }}!

We are excited to have you on board. You can now log in to the system using the following details:

@component('mail::panel')
- **Username:** {{ $user->user_name }}
- **Email:** {{ $user->email }}
- **Password:** Your password is your last name and birth date (without space in between).
@endcomponent

For example, if your birthdate is February 1, 1990, and your last name is **Smith**, your password will be:
**Smith19900201**

Please make sure to change your password after logging in for the first time.

Please also note that upon logging in, you might encounter a **401 Unauthorized**. If this is the case, you may contact the System Administrator to get authorized.

@component('mail::button', ['url' => '/login'])
Login Now
@endcomponent

Best regards,
{{ config('app.name') }}
@endcomponent
