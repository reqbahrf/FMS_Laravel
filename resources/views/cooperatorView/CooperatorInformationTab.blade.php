
<div class="p-3">
    <h4>Dashboard</h4>
</div>
<div class="row ms-0 ms-sm-2 ms-md-2 mb-0 mb-sm-2 mb-md-4 p-0 p-sm-1 p-md-1 w-100">
    <div class="card p-0 mt-1">
        <div class="card-header">
            <h5>Project Info:</h5>
        </div>
        <div class="card-body">
            <div class="row gy-4">
                <div class="col-md-8">
                    <label for="project_title" ><strong>Project Title:</strong></label>
                        <input type="text" class="form-control" id="project_title" value="{{ $row->project_title }}" readonly>
                </div>
                <div class="col-md-4">
                    <label for="firm_name" ><strong>Name of Firm:</strong></label>
                        <input type="text" class="form-control" id="firm_name" value="{{ $row->firm_name }}" readonly>
                </div>
                <div class="col-md-12">
                    <label for="address" ><strong>Address:</strong></label>
                        <input type="text" class="form-control" id="address" value="{{ $row->landMark }}, {{ $row->barangay }} , {{ $row->city }}, {{ $row->province }}, {{ $row->region }}" readonly>
                </div>
                <div class="col-md-8">
                    <label for="contact_person" ><strong>Contact Person:</strong></label>
                        <input type="text" class="form-control" id="contact_person" value="{{ $row->f_name }} {{ $row->l_name }}" readonly>
                </div>
                <div class="col-md-4">
                    <label for="designation" ><strong>Designation:</strong></label>
                    <input type="text" class="form-control" id="designation" value="{{ $row->designation }}" readonly>
                </div>
                    <div class="col-md-4">
                        <label for="landline" ><strong>Landline:</strong></label>
                        <input type="text" class="form-control" id="landline" value="{{ $row->landline }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="mobile_phone" ><strong>Mobile Phone:</strong></label>
                        <input type="text" class="form-control" id="mobile_phone" value="{{ $row->mobile_number }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="email" ><strong>Email Address:</strong></label>
                        <input type="text" class="form-control" id="email" value="{{ $row->email }}" readonly>
                    </div>
            </div>
        </div>
    </div>
    <!-- Add more content as needed -->
    <div class="row p-0">
        <div class="col-12 col-md-6">
          <div class="card mt-4">
            <div class="card-header">
              <h5>Refund Progress:</h5>
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col d-flex flex-column align-items-center">
                    <!-- Add content for ProgressPer div here -->
                    <!-- Assuming your ApexChart is here -->
                    <div id="ProgressPer" class="mx-auto" style="order: 1;"></div>
                    <div class="text-center" style="order: 2;">
                      <h5>750,000/1,000,000</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card mt-4">
            <div class="card-header">
              <h6><strong>Refund History:</strong></h6>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Amount</th>
                    <th>Due For</th>
                    <th>Remark</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- ... -->
                  <tr>
                    <td>₱83,000.33</td>
                    <td>1/15/2022</td> <!-- First quarter -->
                    <td><span class="badge rounded-pill text-bg-success">Refunded</span></td>
                  </tr>
                  <tr>
                    <td>₱83,000.33</td>
                    <td>4/15/2022</td> <!-- Second quarter -->
                    <td><span class="badge rounded-pill text-bg-success">Refunded</span></td>
                  </tr>
                  <tr>
                    <td>₱83,000.33</td>
                    <td>7/15/2022</td> <!-- Third quarter -->
                    <td><span class="badge rounded-pill text-bg-success">Refunded</span></td>
                  </tr>
                  <tr>
                    <td>₱83,000.33</td>
                    <td>10/15/2022</td> <!-- Fourth quarter -->
                    <td><span class="badge rounded-pill text-bg-success">Refunded</span></td>
                  </tr>
                  <!-- ... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>

