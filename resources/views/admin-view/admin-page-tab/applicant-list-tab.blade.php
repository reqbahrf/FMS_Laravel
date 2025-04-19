<div class="p-3">
    <h1>Applicant</h1>
</div>
<div
    class="offcanvas offcanvas-end"
    id="applicantDetails"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary">
        <h1
            class="offcanvas-title text-white fs-4"
            id="staticBackdropLabel"
        >
            <i class="ri-id-card-fill ri-lg"></i>
            Applicant Details
        </h1>
        <button
            class="btn-close"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
    </div>
    <x-org-user-view.applicant-detail :withProgress="false" />
</div>
<div class="card p-0 m-0 m-md-3">
    <div class="card-body">
        <div class="py-4">
            <div class="mx-2 table-responsive-xl">
                <table
                    class="table table-hover mx-2"
                    id="applicant"
                    style="width:100%"
                >
                    <tbody
                        class="table-group-divider"
                        id="ApplicantTableBody"
                    >
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
