<x-mail::message>
# Project Registration Confirmation

Dear {{ $user->name }},

We are pleased to inform you that you have been successfully registered for the following project:

<x-mail::panel>
**Project Name:** {{ $project->name }}
**Project ID:** {{ $project->id }}
**Project Description:** {{ $project->description }}
</x-mail::panel>

## Your Login Credentials
Please use the credentials below to access the system:

<x-mail::panel>
    **Email:** {{ $user->email }}
    **Temporary Password:** {{ $password }}
</x-mail::panel>

For security reasons, we strongly recommend changing your password upon your first login.

<x-mail::button :url="$loginUrl">
Access Your Account
</x-mail::button>

If you have any questions or require assistance, please do not hesitate to contact our support team.

Thank you for your participation in this project. We look forward to your valuable contributions.

Best regards,
{{ config('app.name') }}
</x-mail::message>
