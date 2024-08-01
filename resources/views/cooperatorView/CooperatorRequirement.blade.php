

<style>
    .nav-tabs .nav-link.tab-Nav.active {
        background-color: #318791 !important;
        font-weight: bold;
        color: white;
        border-top: 6px solid;
        border-top-right-radius: 10px;
        /* Adjust the radius value as needed */
        border-top-left-radius: 10px;
    }

    .nav-tabs .nav-link.tab-Nav {
        background-color: white;
        /* Your desired color */
        color: black;
        /* Adjust text color accordingly */
        border: 1px solid #318791;
        /* Adjust border color */
        border-bottom: none;
    }

    .nav-tabs .nav-link.tab-Nav:hover {
        background-color: #318791;
        /* Hover state color */
        color: white;
    }

    .nav-link.tab-Nav:disabled {
        opacity: 0.5;
        /* Reduce opacity for disabled buttons */
        cursor: not-allowed;
        /* Change cursor to not-allowed */
        /* Add any other custom styles you want for disabled buttons */
    }

    /* Change the background color of the progress bar */
</style>
<div class="p-3">
    <h4>Requirements</h4>
</div>
{{-- Receipt modal --}}
<!-- Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Upload Receipt</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="receiptName">Receipt Name</label>
                            <input type="text" class="form-control" name="receiptName" id="receiptName" required>
                            <div class="form-text">
                                Name of the receipt 20 charater max
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="file" name="receipt_file" class="filepond-receipt-upload" id="">
                            <input type="hidden" name="unique_id">
                        </div>
                    </div>
                </form>
                <div id="successMessage" class="alert alert-success" style="display:none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="submitButton" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>

</div>

{{-- end modal --}}
<div class="m-0 m-md-3">
    <div class="row g-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Application Requirements Uploaded
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Data Uploaded</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td scope="3"></td>
                                    <td>Where the Application requirements are disp</td>
                                    <td></td>
                                </tr>
                                <tr class="">
                                    <td scope="row">Item</td>
                                    <td>Item</td>
                                    <td>Item</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Requirements Checklist
                </div>
                <div class="card-body">
                    <div class="p-3">
                        <div class="form-check form-check-lg">
                            <input class="form-check-input" type="checkbox" name="requirements[]" value="TNA"
                                id="tna">
                            <label class="form-check-label" for="tna">TNA</label>
                        </div>
                        <div class="form-check form-check-lg">
                            <input class="form-check-input" type="checkbox" name="requirements[]"
                                value="Project Deliberation Approval" id="pda">
                            <label class="form-check-label" for="pda">Project Deliberation Approval</label>
                        </div>
                        <div class="form-check form-check-lg">
                            <input class="form-check-input" type="checkbox" name="requirements[]"
                                value="PDC-post Dated Cheque" id="pdc">
                            <label class="form-check-label" for="pdc">PDC-post Dated Cheque</label>
                        </div>
                        <div class="form-check form-check-lg">
                            <input class="form-check-input" type="checkbox" name="requirements[]" value="Fund release"
                                id="fr">
                            <label class="form-check-label" for="fr">Fund release</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Expense Receipt
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Receipt Name</th>
                                <th scope="col">Receipt File</th>
                                <th scope="col">Date Uploaded</th>
                                <th scope="col">Remark</th>
                                <th scope="col">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Where the receipt infomation are displayed</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#receiptModal">Upload Receipt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

