<style>
    div .cards {
        max-width: 24rem;
        min-width: 20rem;
        height: 15rem
    }

    .cards {
        transition: transform 0.3s ease-in-out;
    }

    .cards:hover {
        transform: scale(1.05);
        font-weight: bolder;
    }

    /* handleproject header color change */
    #handledProject_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
    }

    #handleProjectOff {
        width: 50vw;
        max-width: 100%;
    }
</style>
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="handleProjectOff"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white" id="staticBackdropLabel">
            Handled Project
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>I will not close if you click outside of me.</div>
    </div>
</div>

<div class="modal fade" id="handleProjectModal" tabindex="-1" aria-labelledby="handleProjectModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="handleProjectModalLabel">Handled Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Project title:</h6>
                <p class="ps-2">Imploving the Business.....</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="dashboardLink"
                    onclick="loadPage('/org-access/viewCooperatorInfo.php','projectLink');"
                    data-bs-dismiss="modal">View</button>
                <button class="btn btn-secondary">Edit</button>
            </div>
        </div>
    </div>
</div>
<div>
    <h4 class="p-3">Dashboard</h4>
</div>
<div class="">
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0 text-center"> Projects</p>
        </div>
        <div class="card-body">
            <div id="lineChart">
            </div>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0 text-center">Handled Project</p>
        </div>
        <div class="card-body">
            <table id="handledProject" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Title</th>
                        <th>Firm Name</th>
                        <th>Owner Name</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="handledProjectTableBody">
                    <tr>
                        <td>1</td>
                        <td>Imploving the Business.....</td>
                        <td>
                            <p class="firm_name">
                                XYZ Ltd.
                            </p>
                            <input type="hidden" class="business_enterprise_type">
                            <input type="hidden" class="business_address">
                            <input type="hidden" class="asset_land">
                            <input type="hidden" class="asset_building">
                            <input type="hidden" class="asset_equipment">
                        </td>
                        <td>
                            <p class="owner_name">Jorge Walt</p>
                            <input type="hidden" class="landline" value="1234567">
                            <input type="hidden" class="mobile_phone" value="09123456789">
                            <input type="hidden" class="email" value="">
                        </td>
                        <td>500,000/1,000,000</td>
                        <td>On-going</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Firm Info</th>
                        <th>Owner Info</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function() {

        fetchHandleProject();

        function fetchHandleProject(){
            fetch('{{ route('staff.Dashboard.getHandledProjects') }}', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            ).then(response => response.json())
            .then(data => {
                const handledProjectTableBody = $('#handledProjectTableBody');
                handledProjectTableBody.empty();
                data.forEach(project => {
                    handledProjectTableBody.append(`
                    <tr>
                        <td>${project.Project_id}</td>
                        <td>${project.project_title}</td>
                        <td>
                            <p class="firm_name">${project.firm_name}</p>
                            <input type="hidden" class="business_enterprise_type" value="${project.enterprise_type}">
                            <input type="hidden" class="business_address" value="${project.landMark + ', ' + project.barangay + ', ' + project.city + ', ' + project.province + ', ' + project.region}">
                            <input type="hidden" class="building_value" value="${project.building_value}">
                            <input type="hidden" class="equipment_value" value="${project.equipment_value}">
                            <input type="hidden" class="working_capital" value="${project.working_capital}">
                        </td>
                        <td>
                            <p class="owner_name">${project.f_name + ' ' + project.l_name}</p>
                            <input type="hidden" class="landline" value="${project.landline}">
                            <input type="hidden" class="mobile_phone" value="${project.mobile_number}">
                            <input type="hidden" class="email" value="${project.email}">
                        </td>
                        <td>${parseFloat(project.fund_amount).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                        <td>${project.application_status}</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>
                        </td>
                    </tr>
                    `);
                });
            });
        }

    })

</script>
