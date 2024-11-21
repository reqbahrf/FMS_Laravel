<div>
    <h4 class="p-3">Add Projects</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a href="#" onclick="loadPage('{{ route('staff.Project') }}', 'projectLink')">Projects</a></li>
        <li class="breadcrumb-item active">Add Projects</li>
    </ol>
</nav>
<div class="form-container">
    <x-applicant-form />
</div>
