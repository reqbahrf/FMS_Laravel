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
    #handledProject_wrapper > div:first-child {
    background-color: #318791;
    padding-top: 1rem;
    padding-bottom: 1rem;
    color: white;
}

</style>
<div class="modal fade" id="handleProjectModal" tabindex="-1" aria-labelledby="handleProjectModalLabel" aria-hidden="true" data-bs-backdrop="static">
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
                <button class="btn btn-primary" id="dashboardLink" onclick="loadPage('/org-access/viewCooperatorInfo.php','projectLink');" data-bs-dismiss="modal">View</button>
                <button class="btn btn-secondary">Edit</button>
            </div>
        </div>
    </div>
</div>
<div>
    <h4 class="p-3">Dashboard</h4>
</div>
<div class="bg-white py-2 rounded-5">
    <div class="row sparkboxes m-4">
        <div class="col-md-4">
            <div class="box box1 pt-2 bg-white shadow rounded-3">
                <div id="Applicant"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box2 pt-2  bg-white shadow rounded-3">
                <div id="Ongoing"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box3 pt-2 bg-white shadow rounded-3">
                <div id="Completed"></div>
            </div>
        </div>
    </div>
    <div class="m-4 p-3 shadow">
        <h5 class="p-2 text-center">Handled Projects</h5>
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
                        <p><strong>Business Address:</strong> tagum, Davao Del Norte <br> <strong>Type of Enterprise:</strong> Sole Proprietorship</p>
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
                        <p><strong class="p-2">Landline:</strong> 1234567 <br><Strong class="p-2">Mobile Phone:</Strong> 09123456789</p>
                    </td>
                    <td>500,000/1,000,000</td>
                    <td>On-going</td>
                    <td>
                        <button type="button" class="btn" id="modalButton" data-bs-toggle="modal" data-bs-target="#handleProjectModal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                                <path d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z" fill="#000000" />
                            </svg>
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