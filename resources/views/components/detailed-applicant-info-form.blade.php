@props(['ownerId', 'draft_type', 'withAction' => false])
<div>
    <h4 class="p-3">Fill Applicant Information</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a
                href="#"
                onclick="loadTab('{{ route('staff.Project') }}', 'projectLink')"
            >Projects</a></li>
        <li class="breadcrumb-item active">Fill Applicant Information</li>
    </ol>
</nav>
<x-application-form.form
    :$ownerId
    :$draft_type
    :$withAction
>
    <x-application-form.personal-info />
    <x-application-form.business-info :withFileInput="false" />
</x-application-form.form>
