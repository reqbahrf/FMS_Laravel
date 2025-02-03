<div class="p-3">
    <h4>Requirements</h4>
</div>
{{-- Receipt modal --}}
<!-- Modal -->
<div
    class="modal fade"
    id="receiptModal"
    data-bs-backdrop="static"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title fs-5 text-white"
                    id="exampleModalLabel"
                >Upload Receipt</h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm">
                    @csrf
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="receiptName">Receipt Name:</label>
                            <input
                                class="form-control"
                                id="receiptName"
                                name="receiptName"
                                type="text"
                                required
                                maxlength="30"
                            >
                            <div class="form-text">
                                Name of the receipt 30 charater max
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="receiptShortDescription">Short Description:</label>
                            <textarea
                                class="form-control"
                                id="receiptShortDescription"
                                name="receiptShortDescription"
                                rows="5"
                                maxlength="255"
                            ></textarea>
                            <div class="form-text">
                                Kindly provide a short Desciption explaining the receipt that you want to upload. Max
                                255 charaters
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="receipt_file">Upload Receipt:</label>
                            <input
                                class="filepond-receipt-upload"
                                name="receipt_file"
                                type="file"
                            >
                            <input
                                name="unique_id"
                                type="hidden"
                            >
                        </div>
                    </div>
                </form>
                <div
                    class="alert alert-success"
                    id="successMessage"
                    style="display:none;"
                ></div>
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-primary"
                    form="uploadForm"
                    type="submit"
                >Save changes</button>
            </div>
        </div>
    </div>

</div>

{{-- end modal --}}
<div class="m-0 m-md-3">
    <div class="row g-3">
        <div class="col-12">
            <div class="card shadow-sm rounded-sm">
                <div class="card-header bg-primary">
                    <h6 class="text-white mb-0">Expense Receipt</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Receipt Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Receipt File</th>
                                    <th scope="col">Date Uploaded</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Comment</th>
                                </tr>
                            </thead>
                            <tbody id="expenseReceipt_tbody">
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
                    </div>
                    <div class="text-end">
                        <button
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#receiptModal"
                            type="button"
                        >Upload Receipt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
