<style>
  .increase_in::before {
    content: "";
    display: inline-block;
    width: 10px;
    height: 10px;
    background-color: #25A0FC;
    margin-right: 5px;
  }

  .decrease_in::before {
    content: "";
    display: inline-block;
    width: 10px;
    height: 10px;
    background-color: #FEB019;
    margin-right: 5px;
  }

  th {
    font-size: 12px;
  }
</style>
<div class="row g-3 mt-3 mb-2">
  <fieldset>
    <legend class="w-auto">
      <h4>Cooperator Info:</h4>
    </legend>
    <div class="p-3">
      <div class="form-group row mt-2">
        <label for="project_title" class="col-12 col-sm-2"><strong>Project Title:</strong></label>
        <div class="col-12 col-sm-10">
          <input type="text" class="form-control" id="project_title" value="[Project Title Value]" readonly>
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="firm_name" class="col-12 col-sm-2"><strong>Name of Firm:</strong></label>
        <div class="col-12 col-sm-10">
          <input type="text" class="form-control" id="firm_name" value="[Firm Name Value]" readonly>
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="address" class="col-12 col-sm-2"><strong>Address:</strong></label>
        <div class="col-12 col-sm-10">
          <input type="text" class="form-control" id="address" value="[Address Value]" readonly>
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="contact_person" class="col-12 col-sm-2"><strong>Contact Person:</strong></label>
        <div class="col-12 col-sm-4">
          <input type="text" class="form-control" id="contact_person" value="[Contact Person Value]" readonly>
        </div>
        <label for="designation" class="col-12 col-sm-2"><strong>Designation:</strong></label>
        <div class="col-12 col-sm-4">
          <input type="text" class="form-control" id="designation" value="[Designation Value]" readonly>
        </div>
      </div>
      <div class="form-group row mt-2">
        <label for="landline" class="col-12 col-sm-2"><strong>Landline:</strong></label>
        <div class="col-12 col-sm-2">
          <input type="text" class="form-control" id="landline" value="[Landline Value]" readonly>
        </div>
        <label for="mobile_phone" class="col-12 col-sm-2"><strong>Mobile Phone:</strong></label>
        <div class="col-12 col-sm-2">
          <input type="text" class="form-control" id="mobile_phone" value="[Mobile Phone Value]" readonly>
        </div>
        <label for="email" class="col-12 col-sm-2"><strong>Email Address:</strong></label>
        <div class="col-12 col-sm-2">
          <input type="text" class="form-control" id="email" value="[Email Address Value]" readonly>
        </div>
      </div>
  </fieldset>
  <fieldset>
    <legend class="w-auto">
      <h4>Refund Progress:</h4>
    </legend>
    <div class="row mb-4">
      <div class="col d-flex flex-column align-items-center">
        <!-- Add content for ProgressPer div here -->
        <!-- Assuming your ApexChart is here -->
        <div id="progressBar" class="mx-auto" style="order: 1;"></div>
        <div class="text-center" style="order: 2;">
          <h5>750,000/1,000,000</h5>
        </div>
      </div>
      <div class="col">
        <div>

        </div>
        <div>
          <fieldset class="w-auto">
            <legend class="w-auto">
              <h6><strong>Refund History:</strong></h6>
            </legend>
            <table class="table">
              <thead>
                <tr>
                  <th>Amount</th>
                  <th>Due For</th>
                  <th>Remark</th>
                </tr>
              </thead>
              <tbody>
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
              </tbody>
            </table>
          </fieldset>
        </div>
      </div>
    </div>
    <div class="row px-2">
      <div class="col-md-6">
        <fieldset>
          <legend>
            <h6>Production Generated:</h6>
          </legend>
          <div class="text-center">
            <span class="increase_in px-3">Increased in Production</span>
            <span class="decrease_in">Decreased in Production</span>
          </div>
          <div id="productionGeneChart">
          </div>
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset>
          <legend>
            <h6>Employment Generated</h6>
          </legend>
          <div class="text-center">
            <span class="increase_in px-3">Increased in Employment</span>
            <span class="decrease_in">Decreased in Employment</span>
          </div>
          <div id="employmentGeneChart">
          </div>
        </fieldset>
      </div>
    </div>

  </fieldset>
  <fieldset class="px-4">
    <legend class="w-auto">
      <h4>Requirements:</h4>
    </legend>
    <fieldset class="mt-4">
      <!-- Your first fieldset content goes here -->
      <legend class="w-auto">
        <h5>Application requirements</h5>
      </legend>
      <div>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input me-1" type="checkbox" value="" id="letterOfIntentCheckbox">
              <label class="form-check-label" for="letterOfIntentCheckbox">Letter of Intent</label>
              <a href="path/to/letter_of_intent.pdf" target="_blank">view file</a>
            </div>
            <span class="badge bg-success">Reviewed</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input me-1" type="checkbox" value="" id="dtiSecCdaCheckbox">
              <label class="form-check-label" for="dtiSecCdaCheckbox">DTI/SEC/CDA</label>
              <a href="path/to/dti_sec_cda.pdf" target="_blank">view file</a>
            </div>
            <span class="badge bg-success">Reviewed</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input me-1" type="checkbox" value="" id="businessPermitCheckbox">
              <label class="form-check-label" for="businessPermitCheckbox">Business Permit</label>
              <a href="path/to/business_permit.pdf" target="_blank">view file</a>
            </div>
            <span class="badge bg-success">Reviewed</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input me-1" type="checkbox" value="" id="fdaLtoCheckbox">
              <label class="form-check-label" for="fdaLtoCheckbox">FDA/LTO</label>
              <a href="path/to/fda_lto.pdf" target="_blank">view file</a>
            </div>
            <span class="badge bg-success">Reviewed</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input me-1" type="checkbox" value="" id="officialReceiptCheckbox">
              <label class="form-check-label" for="officialReceiptCheckbox">Official Receipt of the Business</label>
              <a href="path/to/official_receipt.pdf" target="_blank">view file</a>
            </div>
            <span class="badge bg-success">Reviewed</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input me-1" type="checkbox" value="" id="govValidIdCheckbox">
              <label class="form-check-label" for="govValidIdCheckbox">Copy of Government Valid ID</label>
              <a href="path/to/government_id.pdf" target="_blank">view file</a>
            </div>
            <span class="badge bg-success">Reviewed</span>
          </li>
        </ul>
      </div>
    </fieldset>
    <fieldset class="mt-4">
      <legend>
        <h5>Uploaded Receipt</h5>
      </legend>
      <table class="table">
        <thead>
          <tr class="table-primary">
            <th scope="col">ID</th>
            <th scope="col">File Name</th>
            <th scope="col">Date Uploaded</th>
            <th scope="col">For the Quarter</th>
            <th scope="col">Remark</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table data will go here -->
        </tbody>
      </table>
    </fieldset>
    <fieldset class="mt-4">
      <legend>
        <h5>Quarterly Report</h5>
      </legend>
      <!-- drop down for quarter selection -->
      <div class="d-flex justify-content-end">
        <div class="btn-group mb-3">
          <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Quarter of
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">1</a></li>
            <li><a class="dropdown-item" href="#">2</a></li>
            <li><a class="dropdown-item" href="#">3</a></li>
            <li><a class="dropdown-item" href="#">4</a></li>
          </ul>
        </div>
      </div>
      <div class="tab-content p-0">
        <fieldset class="">
          <legend class="w-auto">1.0 ASSETS</legend>
          <div class="row ms-md-4 ms-sm-2 my-4">
            <div class="col-12 col-sm-6 col-md-4">
              <label for="BuildingAsset">Building:</label>
              <input type="text" class="form-control" id="BuildingAsset" name="Building" placeholder="" readonly>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <label for="Equipment">Equipment:</label>
              <input type="text" class="form-control" id="Equipment" name="Equipment" placeholder="" readonly>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
              <label for="WorkingCapital">Working Capital:</label>
              <input type="text" class="form-control" id="WorkingCapital" name="WorkingCapital" placeholder="" readonly>
            </div>
          </div>
        </fieldset>
        <fieldset class="mt-4 p-0">
          <legend class="w-auto">2.0 EMPLOYMENT FOR THE QUARTER</legend>
          <div class="row mb-3 my-4">
            <div class="col-sm-12">
              <strong class="ps-2">2.1 Direct Labor(Production)</strong>
              <div class="row p-0">
                <div class="col-sm-12 mt-3">
                  <p class="ps-4">2.1a Direct Labor</p>
                  <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Male</th>
                        <th scope="col">Female</th>
                        <th scope="col">Workday</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" class="form-control" id="maleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="femaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="workdayInput" placeholder="" readonly></td>
                        <td>{Total}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-sm-12 mt-3">
                  <p class="ps-4">2.1b Part-time</p>
                  <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Male</th>
                        <th scope="col">Female</th>
                        <th scope="col">Workday</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" class="form-control" id="parttimeMaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="parttimeFemaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="parttimeWorkdayInput" placeholder="" readonly></td>
                        <td>{Total}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <strong class="ps-2">2.2 Indirect Labor(Admin and Marketing)</strong>
              <div class="row">
                <div class="col-sm-12 mt-3">
                  <p class="ps-4">2.2a Regular</p>
                  <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Male</th>
                        <th scope="col">Female</th>
                        <th scope="col">Workday</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" class="form-control" id="regularMaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="regularFemaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="regularWorkdayInput" placeholder="" readonly></td>
                        <td>{Total}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-sm-12 mt-3">
                  <p class="ps-4">2.2b Part-time</p>
                  <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Male</th>
                        <th scope="col">Female</th>
                        <th scope="col">Workday</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" class="form-control" id="parttimeMaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="parttimeFemaleInput" placeholder="" readonly></td>
                        <td><input type="text" class="form-control" id="parttimeWorkdayInput" placeholder="" readonly></td>
                        <td>{Total}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
    </fieldset>
    <fieldset class="mt-4">
      <legend class="w-auto">3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</legend>
      <div class="row align-items-center">
        <div class="col-sm-12">
          <fieldset class="mt-md-4 mt-sm-2 p-0">
            <legend class="w-auto px-2"><strong>3.1 Export Market</strong></legend>
            <div id="productExport" class="productExport my-4">
              <div class="row">
                <div class="col-12">
                  <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Name of Product</th>
                        <th scope="col">Packing Details</th>
                        <th scope="col">Volume of Production</th>
                        <th scope="col">Gross Sales</th>
                        <th scope="col">Estimated Cost of Production</th>
                        <th scope="col">Net Sales</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" class="form-control" id="productName" name="productName" readonly></td>
                        <td><textarea class="form-control" id="packingDetails" name="packingDetails" readonly></textarea></td>
                        <td><input type="text" class="form-control" id="volumeOfProduction" name="volumeOfProduction" readonly></td>
                        <td><input type="text" class="form-control" id="grossSales" name="grossSales" readonly></td>
                        <td><input type="text" class="form-control" id="estimatedCostOfProduction" name="estimatedCostOfProduction" readonly></td>
                        <td><input type="text" class="form-control" id="netSales" name="netSales" readonly></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="col-sm-12">
          <fieldset class="mt-md-4 mt-sm-2 p-0">
            <legend class="w-auto px-2"><strong>3.2 Local Market</strong></legend>
            <div id="productLocal" class="productLocal my-4">
              <div class="row">
                <div class="col-12">
                  <table class="table">
                    <thead>
                      <tr class="table-primary">
                        <th scope="col">Name of Product</th>
                        <th scope="col">Packing Details</th>
                        <th scope="col">Volume of Production</th>
                        <th scope="col">Gross Sales</th>
                        <th scope="col">Estimated Cost of Production</th>
                        <th scope="col">Net Sales</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="text" class="form-control" id="productName" name="productName" readonly></td>
                        <td><textarea class="form-control" id="packingDetails" name="packingDetails" readonly></textarea></td>
                        <td><input type="text" class="form-control" id="volumeOfProduction" name="volumeOfProduction" readonly></td>
                        <td><input type="text" class="form-control" id="grossSales" name="grossSales" readonly></td>
                        <td><input type="text" class="form-control" id="estimatedCostOfProduction" name="estimatedCostOfProduction" readonly></td>
                        <td><input type="text" class="form-control" id="netSales" name="netSales" readonly></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </fieldset>
    <fieldset class="mt-4 h-100">
      <legend class="w-auto">4.0 MARKET OUTLETS</legend>
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <strong class="ms-2">4.1 Export</strong>
          <div class="form-floating ms-4">
            <textarea class="form-control h-100" placeholder="Export" id="exportTextarea" readonly></textarea>
            <label for="exportTextarea">Export</label>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <strong class="ms-2">4.2 Local</strong>
          <div class="form-floating ms-4">
            <textarea class="form-control h-100" placeholder="Local" id="localTextarea" readonly></textarea>
            <label for="localTextarea">Local</label>
          </div>
        </div>
      </div>
    </fieldset>
</div>
</fieldset>
</fieldset>
</div>
<script>
  $(document).ready(function() {
    const checkboxes = document.querySelectorAll('.form-check-input');
    const reviewedSpans = document.querySelectorAll('.badge.bg-success');

    // Hide all 'Reviewed' spans initially
    reviewedSpans.forEach(span => {
      span.style.display = 'none';
    });

    // Add event listener to each checkbox
    checkboxes.forEach((checkbox, index) => {
      checkbox.addEventListener('change', function() {
        if (this.checked) {
          // Show confirmation modal
          // You can customize the modal content and appearance based on your requirements
          $('#myModal').modal('show');

          // Show 'Reviewed' span if checkbox is checked
          reviewedSpans[index].style.display = 'inline';
        } else {
          reviewedSpans[index].style.display = 'none'; // Hide 'Reviewed' span if checkbox is unchecked
        }
      });
    });
  });
</script>