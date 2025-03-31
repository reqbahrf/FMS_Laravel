<x-mail::message>
# Welcome to **SETUP** 🎉

Hello **{{ $userName }}**,

We are thrilled to have you on board! To complete your application process, please click the button below to access your application form:

<x-mail::button :url="$applicationFormUrl" color="primary">
Access Application Form
</x-mail::button>

To proceed with your application, please ensure you complete the form.

## Login Credentials 🔐
@component('mail::panel')
- **Username:** `{{ $user->user_name }}`
- **Password:** `{{ $initial_password }}`
@endcomponent

⚠ **Important:** Please change your password after logging in for the first time to secure your account.

If you need any assistance, feel free to reach out to our support team.

Thanks & Regards,
**{{ config('app.name') }}**
</x-mail::message>