<div>
    <h4 class="p-3">Add Applicant Info</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a
                href="#"
                onclick="loadPage('{{ route('staff.Project') }}', 'projectLink')"
            >Projects</a></li>
        <li class="breadcrumb-item active">Add Applicant Info</li>
    </ol>
</nav>
<div class="form-container">
    <x-applicant-form />
</div>
