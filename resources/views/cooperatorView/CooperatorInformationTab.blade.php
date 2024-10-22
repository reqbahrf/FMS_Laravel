<div class="p-3">
    <h4>Dashboard</h4>
</div>
<div class="row m-0 m-md-2">
    <div class="col-12 col-md-12">
        <div class="card p-0 ">
            <div class="card-header">
                Project Info
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-8">
                        <label for="project_title"><strong>Project Title:</strong></label>
                        <input type="text" class="form-control" id="project_title" value="{{ $row->project_title }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="firm_name"><strong>Name of Firm:</strong></label>
                        <input type="text" class="form-control" id="firm_name" value="{{ $row->firm_name }}"
                            readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="address"><strong>Address:</strong></label>
                        <input type="text" class="form-control" id="address"
                            value="{{ $row->landMark }}, {{ $row->barangay }} , {{ $row->city }}, {{ $row->province }}, {{ $row->region }}"
                            readonly>
                    </div>
                    <div class="col-md-8">
                        <label for="contact_person"><strong>Contact Person:</strong></label>
                        <input type="text" class="form-control" id="contact_person"
                            value="{{ $row->f_name }} {{ $row->l_name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="designation"><strong>Designation:</strong></label>
                        <input type="text" class="form-control" id="designation" value="{{ $row->designation }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="landline"><strong>Landline:</strong></label>
                        <input type="text" class="form-control" id="landline" value="{{ $row->landline }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="mobile_phone"><strong>Mobile Phone:</strong></label>
                        <input type="text" class="form-control" id="mobile_phone" value="{{ $row->mobile_number }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="email"><strong>Email Address:</strong></label>
                        <input type="text" class="form-control" id="email" value="{{ $row->email }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add more content as needed -->
    <div class="col-12 col-md-4">
        <div class="card mt-4">
            <div class="card-header">
                Refund Progress
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-column align-items-center">
                            <!-- Add content for ProgressPer div here -->
                            <!-- Assuming your ApexChart is here -->
                            <div id="ProgressPer" class="mx-auto" style="order: 1;"></div>
                            <div class="text-center" id="ProgressPerText" style="order: 2;">
                                <h5>750,000/1,000,000</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card mt-4">
            <div class="card-header">
                Refund History:
            </div>
            <div class="card-body">
                <table class="table" id="PaymentTable">
                    <thead>
                        <tr>
                            <th width="20%" class="text-center">Amount</th>
                            <th width="20%" class="text-center">Payment Method</th>
                            <th width="20%" class="text-center">Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

