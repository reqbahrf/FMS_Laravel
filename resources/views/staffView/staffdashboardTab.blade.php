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
            <p class="fw-bold fs-5 m-0"> Projects</p>
        </div>
        <div class="card-body">
            <div id="lineChart">
            </div>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0">Handled Project</p>
        </div>
        <div class="card-body">
            <table id="handledProject" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Firm Name</th>
                        <th>Firm Info</th>
                        <th>Owner Info</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Imploving the Business.....</td>
                        <td>XYZ Company</td>
                        <td>
                            <p><strong>Business Address:</strong> tagum, Davao Del Norte <br> <strong>Type of
                                    Enterprise:</strong> Sole Proprietorship</p>
                            <p>
                                <Strong>
                                    Assets:
                                </Strong> <br>
                                <span class="ps-2">Land: 100,000</span><br>
                                <span class="ps-2">Building: 100,000</span> <br>
                                <span class="ps-2">Equipment: 100,000</span>
                            </p>

                        </td>
                        <td>
                            <p><strong>Name:</strong> Jorge Walt</p>
                            <strong>Contact Details:</strong>
                            <p><strong class="p-2">Landline:</strong> 1234567 <br><Strong class="p-2">Mobile
                                    Phone:</Strong> 09123456789</p>
                        </td>
                        <td>500,000/1,000,000</td>
                        <td>On-going</td>
                        <td>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#handleProjectOff" aria-controls="handleProjectOff">
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>
                            </button>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Firm Name</th>
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
