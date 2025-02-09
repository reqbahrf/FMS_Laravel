
<!-- HTML -->
<div>
    <h4 class="p-3">Dashboard</h4>
</div>
<div class="container-fluid">
    <div class="row gy-3 gx-2">
        <div class="col-12 col-md-4 d-flex align-items-center">
            <h5 class="text-muted fw-medium me-2 w-auto">Statistics for Year:</h5>
            <select name="yearSelector" class="form-select w-50" id="yearSelector">
                <option value="">Select Year</option>
            </select>
        </div>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary">
                    <h6 class="text-white mb-0">Projects</h6>
                </div>
                <div class="card-body">
                    <div id="overallProjectGraph">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex align-items-center">
            <h5 class="text-muted fw-medium me-2">Locale and Enterprise Level</h5>
            <select name="filterBy" class="form-select w-25 me-2" id="filterBy">
                <option>Select Filter</option>
                <option>By Region</option>
                <option>By Province</option>
                <option>By City</option>
                <option>By Barangay</option>
            </select>
            <select name="specificLocation" class="form-select w-25" id="specificLocation" disabled>
                <option>Select Location</option>
            </select>
        </div>
        <div class="col-12 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="localeChart">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body h-100 d-flex justify-content-center align-items-center">
                    <div id="enterpriseLevelChart">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 py-2 py-sm-0">
            <div class="card shadow-sm">
                <div class="card-header bg-primary">
                    <h6 class="text-white mb-0">Handled Projects</h6>
                </div>
                <div class="card-body">
                    <div id="staffHandledB"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body text-end">
                    <button type="button" class="btn btn-primary" id="generateDashboardReport">Generate Report</button>
                </div>
            </div>
        </div>
    </div>
</div>
