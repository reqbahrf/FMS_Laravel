<x-mail::message>
# Payment {{ $status }}

Dear {{ $email }},

@switch($status)
@case('Upcoming')
We wanted to inform you that the payment for your SETUP project with ID **{{ $projectId }}** is approaching.
The payment is scheduled for **{{ $dueDate }}**.
@break

@case('Due')
This is a friendly reminder that the payment for your SETUP project with ID **{{ $projectId }}** is now due.
The payment deadline was **{{ $dueDate }}**.
@break

@case('Overdue')
We regret to inform you that the payment for your SETUP project with ID **{{ $projectId }}** is currently overdue.
The payment was originally due on **{{ $dueDate }}**.
@break
@endswitch

<x-mail::panel>
## Due Amount: ₱ {{ $dueAmount }}
</x-mail::panel>

@switch($status)
@case('Upcoming')
Please prepare for the upcoming payment to ensure timely processing.
@break

@case('Due')
We kindly request you to process the payment as soon as possible to avoid any service interruptions.
@break

@case('Overdue')
Immediate action is required. Please settle the outstanding amount to prevent further complications.
@break
@endswitch

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>
