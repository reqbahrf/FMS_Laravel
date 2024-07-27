<style>
    #smartwizard th {
        font-size: 13px;
    }

    #smartwizard th.theader {
        font-size: 15px;
    }
</style>
<div class="p-3">
    <h4>Quarterly Report</h4>
</div>
<div class="card m-0 m-md-3">
    <div class="card-header">
        <p class=" m-0">Quarterly Report for Quarter 1</p>
    </div>
    <div class="card-body">
        <div class="quarterly-Report-wrapper">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div id="smartwizard" class="my-4">
                    <ul class="nav nav-progress">
                        <li class="nav-item">
                            <a class="nav-link active z-3" href="#step-1">
                                <div class="num">1</div>
                                Assets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link z-3" href="#step-2">
                                <span class="num">2</span>
                                Total Employment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link z-3" href="#step-3">
                                <span class="num">3</span>
                                Production and Sales
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link z-3" href="#step-4">
                                <span class="num">4</span>
                                Market Outlets
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <h5>1.0 Assets</h5>
                            <div class="row ms-md-4 ms-sm-2 my-4">
                                <div class="col-12 col-md-4">
                                    <label for="BuildingAsset">Building: <span class="requiredFields">
                                            *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16"
                                                fill="none" stroke="#000000" stroke-linecap="round"
                                                stroke-linejoin="round" id="Currency-Peso--Streamline-Tabler"
                                                height="16" width="16">
                                                <desc>Currency Peso Streamline Icon: https://streamlinehq.com
                                                </desc>
                                                <path
                                                    d="M3.825 13.931249999999999V1.06875H7.040625C10.22325 1.06875 12.2124375 4.5140625 10.621125 7.2703125C9.8825 8.5495625 8.51775 9.337562499999999 7.040625 9.3375H3.825"
                                                    stroke-width="1"></path>
                                                <path d="M13.0125 3.825H1.9875" stroke-width="1"></path>
                                                <path d="M13.0125 6.58125H1.9875" stroke-width="1"></path>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" id="BuildingAsset" name="Building"
                                            placeholder="500,000">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <Label for="Equipment">Equipment <span class="requiredFields">
                                            *</span></Label>
                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16"
                                                fill="none" stroke="#000000" stroke-linecap="round"
                                                stroke-linejoin="round" id="Currency-Peso--Streamline-Tabler"
                                                height="16" width="16">
                                                <desc>Currency Peso Streamline Icon: https://streamlinehq.com
                                                </desc>
                                                <path
                                                    d="M3.825 13.931249999999999V1.06875H7.040625C10.22325 1.06875 12.2124375 4.5140625 10.621125 7.2703125C9.8825 8.5495625 8.51775 9.337562499999999 7.040625 9.3375H3.825"
                                                    stroke-width="1"></path>
                                                <path d="M13.0125 3.825H1.9875" stroke-width="1"></path>
                                                <path d="M13.0125 6.58125H1.9875" stroke-width="1"></path>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" id="Equipment" name="Equipment"
                                            placeholder="500,000">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="workingCapital">Working Capital <span class="requiredFields">
                                            *</span></label>
                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16"
                                                fill="none" stroke="#000000" stroke-linecap="round"
                                                stroke-linejoin="round" id="Currency-Peso--Streamline-Tabler"
                                                height="16" width="16">
                                                <desc>Currency Peso Streamline Icon: https://streamlinehq.com
                                                </desc>
                                                <path
                                                    d="M3.825 13.931249999999999V1.06875H7.040625C10.22325 1.06875 12.2124375 4.5140625 10.621125 7.2703125C9.8825 8.5495625 8.51775 9.337562499999999 7.040625 9.3375H3.825"
                                                    stroke-width="1"></path>
                                                <path d="M13.0125 3.825H1.9875" stroke-width="1"></path>
                                                <path d="M13.0125 6.58125H1.9875" stroke-width="1"></path>
                                            </svg>
                                        </span>
                                        <input type="text" class="form-control" id="WorkingCapital"
                                            name="WorkingCapital" placeholder="500,000">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <h5>2.0 Total Employment</h5>
                            <div class="card mb-0 mb-md-3">
                                <div class="card-header">
                                    2.1 Direct Labor(Production)
                                </div>
                                <div class="card-body">
                                    <div class="card my-2">
                                        <div class="card-header">
                                            2.1a Direct Labor
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="maleInput">Male: <span class="requiredFields">
                                                            *</span></label>
                                                    <input type="text" name="male_Dir_Regular"
                                                        class="form-control" id="maleInput">
                                                </div>
                                                <div class="col-12">
                                                    <label for="maleInput">Female: <span class="requiredFields">
                                                            *</span></label>
                                                    <input type="text" name="female_Dir_Regular"
                                                        class="form-control" id="femaleInput">
                                                </div>
                                                <div class="col-12">
                                                    <label for="maleInput">Workday: <span class="requiredFields">
                                                            *</span></label>
                                                    <input type="text" name="workday_Dir_Regular"
                                                        class="form-control" id="workdayInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card my-2">
                                        <div class="card-header">
                                            2.1b Part Time
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="maleInput">Male: <span class="requiredFields">
                                                            *</span></label>
                                                    <input type="text" name="male_Dir_PartT" class="form-control"
                                                        id="parttimeMaleInput">
                                                </div>
                                                <div class="col-12">
                                                    <label for="maleInput">Female: <span class="requiredFields">
                                                            *</span></label>
                                                    <input type="text" name="female_Dir_PartT"
                                                        class="form-control" id="parttimeFemaleInput">
                                                </div>
                                                <div class="col-12">
                                                    <label for="maleInput">workday: <span class="requiredFields">
                                                            *</span></label>
                                                    <input type="text" name="workday_Dir_PartT"
                                                        class="form-control" id="parttimeWorkdayInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0 mb-md-3">
                                <div class="card-header">
                                    2.2 Indirect Labor(Admin and Marketing)
                                </div>
                                <div class="card-body">
                                    <div class="card my-2">
                                        <div class="card-header">
                                            2.2a Direct Labor
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="regularMaleInput">Male: <span
                                                            class="requiredFields">*</span></label>
                                                    <input type="text" name="male_Indir_Regular"
                                                        class="form-control" id="regularMaleInput">
                                                </div>
                                                <div class="col-12">
                                                    <label for="regularFemaleInput">Female: <span
                                                            class="requiredFields">*</span></label>
                                                    <input type="text" name="female_Indir_Regular"
                                                        class="form-control" id="regularFemaleInput">
                                                </div>
                                                <div class="col-12">
                                                    <label for="regularWorkdayInput">Workday: <span
                                                            class="requiredFields">*</span></label>
                                                    <input type="text" name="workday_Indir_Regular"
                                                        class="form-control" id="regularWorkdayInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card my-2">
                                        <div class="card-header">
                                            2.2b Part Time
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="parttimeMaleInput">Male: <span
                                                            class="requiredFields">*</span></label>
                                                    <input type="text" name="male_Indir_PartT"
                                                        class="form-control" id="parttimeMaleInput">

                                                </div>
                                                <div class="col-12">
                                                    <label for="parttimeFemaleInput">Female: <span
                                                            class="requiredFields">*</span></label>
                                                    <input type="text" name="female_Indir_PartT"
                                                        class="form-control" id="parttimeFemaleInput">

                                                </div>
                                                <div class="col-12">
                                                    <label for="parttimeWorkdayInput">Workday: <span
                                                            class="requiredFields">*</span></label>
                                                    <input type="text" name="workday_Indir_PartT"
                                                        class="form-control" id="parttimeWorkdayInput">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <h5>3.0 PRODUCTION AND SALES DATA FOR THE QUARTER</h5>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                            <strong>3.1 Export Market</strong>
                                            <div id="productExport" class="productExport">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <div class="mt-2">

                                                            <div class="d-flex justify-content-end p-2">
                                                                <button type="button" id="addExportRow"
                                                                    class="btn btn-primary" data-toggle="tooltip"
                                                                    title="Add a new row">
                                                                    <i class="ri-add-box-fill"></i>

                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-danger deleteExportRow mx-2"
                                                                    data-toggle="tooltip" title="Delete row">
                                                                    <i class="ri-subtract-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table Export-Outlet">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Name of Product</th>
                                                                        <th scope="col">Packing Details</th>
                                                                        <th scope="col">Volume of Production</th>
                                                                        <th scope="col">Gross Sales</th>
                                                                        <th scope="col">Estimated Cost of Production
                                                                        </th>
                                                                        <th scope="col">Net Sales</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="ExportData table-group-divider">
                                                                    <tr>
                                                                        <td><input type="text" class="form-control"
                                                                                id="productName" name="productName"></td>
                                                                        <td>
                                                                            <textarea class="form-control" id="packingDetails" name="packingDetails"></textarea>
                                                                        </td>
                                                                        <td><input type="text" class="form-control"
                                                                                id="volumeOfProduction"
                                                                                name="volumeOfProduction"></td>
                                                                        <td><input type="text" class="form-control"
                                                                                id="grossSales" name="grossSales"></td>
                                                                        <td><input type="text" class="form-control"
                                                                                id="estimatedCostOfProduction"
                                                                                name="estimatedCostOfProduction"></td>
                                                                        <td><input type="text" class="form-control"
                                                                                id="netSales" name="netSales"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-12">
                                                <strong>3.2 Local Market</strong>
                                            <div id="productLocal" class="productLocal">
                                                <div class="row p-0">
                                                    <div class="col-12">
                                                        <div class="mt-2">
                                                            <div class="d-flex justify-content-end p-2">
                                                                <button type="button" id="addLocalRow"
                                                                    class="btn btn-primary" data-toggle="tooltip"
                                                                    title="Add a new row">
                                                                    <i class="ri-add-box-fill"></i>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-danger mx-2 deleteLocalRow"
                                                                    data-toggle="tooltip" title="Delete row">
                                                                    <i class="ri-subtract-fill"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <table class="table local-Outlet">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Name of Product</th>
                                                                    <th scope="col">Packing Details</th>
                                                                    <th scope="col">Volume of Production</th>
                                                                    <th scope="col">Gross Sales</th>
                                                                    <th scope="col">Estimated Cost of Production
                                                                    </th>
                                                                    <th scope="col">Net Sales</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="LocalData table-group-divider">
                                                                <tr>
                                                                    <td><input type="text" class="form-control"
                                                                            id="productName" name="productName"></td>
                                                                    <td>
                                                                        <textarea class="form-control" id="packingDetails" name="packingDetails"></textarea>
                                                                    </td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="volumeOfProduction"
                                                                            name="volumeOfProduction"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="grossSales" name="grossSales"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="estimatedCostOfProduction"
                                                                            name="estimatedCostOfProduction"></td>
                                                                    <td><input type="text" class="form-control"
                                                                            id="netSales" name="netSales"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                        </div>
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <h5>4.0 MARKET OUTLETS</h5>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <strong class="ms-2">4.1 Export</strong>
                                    <div class="form-floating ms-4">
                                        <textarea class="form-control h-100" name="Market_Export" placeholder="Export" id="exportTextarea"></textarea>
                                        <label for="exportTextarea">Export</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <strong class="ms-2">4.2 Local</strong>
                                    <div class="form-floating ms-4">
                                        <textarea class="form-control h-100" name="Market_local" placeholder="Local" id="localTextarea"></textarea>
                                        <label for="localTextarea">Local</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="module">
    $(document).ready(function() {
        // Select the input fields
        $('#BuildingAsset, #Equipment, #WorkingCapital').on('input', function() {
            // Remove any non-digit characters
            let value = $(this).val().replace(/[^0-9]/g, '');

            // Add commas every three digits
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Set the new value to the input field
            $(this).val(value);
        });

        $('#employment input').on('input', function() {
            // Remove any non-digit characters
            let value = $(this).val().replace(/[^0-9]/g, '');

            // Set the new value to the input field
            $(this).val(value);
        });

        $('.ExportData, .LocalData').on('input', 'tr td:nth-child(n+3):nth-child(-n+6) input', function() {
            // Remove any non-digit characters
            let value = $(this).val().replace(/[^0-9]/g, '');

            // Add commas every three digits
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Set the new value to the input field
            $(this).val(value);
        });

    });
</script>
<script type="module">
    $(document).ready(function() {
        let counters = {
            export: 0,
            local: 0
        };

        window.addRow = function(buttonSelector, tableSelector, identifier) {
            $(buttonSelector).click(function() {
                counters[identifier]++;

                let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="${identifier}ProductName${counters[identifier]}"></td>
                <td><textarea class="form-control" name="${identifier}PackingDetails${counters[identifier]}"></textarea></td>
                <td><input type="text" class="form-control" name="${identifier}VolumeOfProduction${counters[identifier]}"></td>
                <td><input type="text" class="form-control" name="${identifier}GrossSales${counters[identifier]}"></td>
                <td><input type="text" class="form-control" name="${identifier}EstimatedCostOfProduction${counters[identifier]}"></td>
                <td><input type="text" class="form-control" name="${identifier}NetSales${counters[identifier]}"></td>
            </tr>
            `;

                $(tableSelector).append(newRow);
                updateDeleteButtonState();
            });
        }

        window.deleteRow = function(buttonSelector, identifier, tableSelector) {
            $(document).on('click', buttonSelector, function() {
                if ($(tableSelector + ' tr').length > 1) {
                    $(tableSelector + ' tr:last').remove();
                    updateDeleteButtonState();
                }
                counters[identifier]--;
            });
        }

        window.updateDeleteButtonState = function() {
            ['.deleteExportRow', '.deleteLocalRow'].forEach(function(buttonSelector) {
                let tableSelector = buttonSelector === '.deleteExportRow' ? '.Export-Outlet tbody' :
                    '.local-Outlet tbody';
                if ($(tableSelector + ' tr').length <= 1) {
                    $(buttonSelector).prop('disabled', true);
                } else {
                    $(buttonSelector).prop('disabled', false);
                }
            });
        }

        addRow('#addExportRow', '.Export-Outlet tbody', 'export');
        deleteRow('.deleteExportRow', 'export', '.Export-Outlet tbody');

        addRow('#addLocalRow', '.local-Outlet tbody', 'local');
        deleteRow('.deleteLocalRow', 'local', '.local-Outlet tbody');

        updateDeleteButtonState();
    });
</script>
<script type="module">
    $(document).ready(function() {
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transition: {
                animation: 'slideHorizontal'
            },
            toolbar: {
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                position: 'both buttom', // none/ top/ both bottom
                extraHtml: `<button class="btn btn-success" onclick="">Submit</button>
                              <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
            },
        });
        $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            let totalSteps = $('#smartwizard').find('ul li').length;
            // console.log("Step: ", stepNumber);
            console.log("Total Steps:", totalSteps);

            if (stepIndex === totalSteps - 1 && stepPosition === 'last') {
                console.log("Arriving at Last Step - Showing Buttons");
                $('.btn-success, .btn-secondary').show();
            } else {
                console.log("Not Arriving at Last Step - Hiding Buttons");
                $('.btn-success, .btn-secondary').hide();
            }
        });
        $('#smartwizard').on('click', 'button', function() {
            // Your function goes here
            $('#smartwizard').smartWizard('fixHeight');
        });
    });
</script>
<script type="module">
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Convert form data to JSON
            let formData = $(this).serializeArray();
            let dataObject = {};
            $.each(formData, function(i, v) {
                dataObject[v.name] = v.value;
            });

            // Send form data using AJAX
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: JSON.stringify(dataObject), // Send the new data object
                contentType: 'application/json', // Set content type to JSON
                success: function(response) {
                    // Handle the response if needed
                    $('#qReport').removeClass('d-none');
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                }
            });
        });
    });
</script>
