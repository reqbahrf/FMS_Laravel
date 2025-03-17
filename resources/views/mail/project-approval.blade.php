@component('mail::message')
# Project Proposal Approved

Dear Applicant,

We are pleased to inform you that your project proposal "**{{ $project->project_title }}**" has been approved.

Project Details:
- Project ID: **{{ $project->Project_id }}**
- Project Title: **{{ $project->project_title }}**
- Fund Amount: **₱{{ number_format($project->fund_amount, 2, '.', ',') }}**

@component('mail::button', ['url' => '/login'])
        View Project Details
@endcomponent

Thank you for your participation.

Best regards,<br>
{{ config('app.name') }}
@endcomponent
