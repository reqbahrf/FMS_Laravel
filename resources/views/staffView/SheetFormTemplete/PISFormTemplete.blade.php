 <div id="PISFormContainer" class="h-100 mt-2">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="#" class="revertToSelectDoc">Select Document</a></li>
             <li class="breadcrumb-item active" aria-current="page">Project Information Sheet</li>
         </ol>
     </nav>
     <div class="row gy-3 p-0">
         <div class="col-12">
             <div class="card p-0">
                 <div class="card-header">
                     Project Information
                 </div>
                 <div class="card-body">
                     <form id="projectInfoForm">
                         <div class="row gy-2">
                             <div class="col-12">
                                 <label for="projectTitle" class="form-label">Project Title</label>
                                 <input type="text" class="bottom_border ms-2" name="projectTitle" id="projectTitle"
                                     value="{{ $projectData->project_title }}">
                             </div>
                             <div class="col-12">
                                 <label for="projectTitle">Firm Name</label>
                                 <input type="text" class="bottom_border ms-2" name="firmName" id="firmName"
                                     value="{{ $projectData->firm_name }}">
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Contact Person:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="projectTitle">Name</label>
                                 <input type="text" class="bottom_border ms-2" name="name" id="name"
                                     value="{{ $projectData->f_name . ' ' . $projectData->mid_name . ' ' . $projectData->l_name . ' ' . $projectData->suffix }}">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="projectTitle">Gender</label>
                                 <input type="text" class="bottom_border ms-2" name="gender" id="gender"
                                     value="{{ $projectData->gender }}">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="projectTitle">Age</label>
                                 <input type="text" class="bottom_border ms-2" name="age" id="age"
                                     value="{{ \Carbon\Carbon::parse($projectData->birth_date)->age }}">
                             </div>
                             <div class="col-12">
                                 <label for="typeOfOrganization" class="form-label">Type of Organiztion
                                     Enterprize</label>
                                 <input type="text" class="bottom_border ms-2" name="typeOfOrganization" id="typeOfOrganization"
                                     value="{{ $projectData->enterprise_type }}">
                             </div>
                             <div class="col-12">
                                 <label for="businessAddress" class="form-label">Business Address</label>
                                 <input type="text" class="bottom_border ms-2" name="businessAddress" id="businessAddress"
                                     value="{{ $projectData->landMark . ', ' . $projectData->barangay . ', ' . $projectData->city . ', ' . $projectData->province . ', ' . $projectData->region }}">
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Contact Datails:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="landline" class="form-label">Landline:</label>
                                 <input type="text" class="bottom_border ms-2" name="landline"
                                     id="landline"="{{ $projectData->landline }}">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="fax" class="form-label">Fax:</label>
                                 <input type="text" class="bottom_border ms-2" name="fax" id="fax">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="mobile_phone" class="form-label">Mobile Phone:</label>
                                 <input type="text" class="bottom_border ms-2" name="mobile_phone" id="mobile_phone"
                                     value="{{ $projectData->mobile_number }}">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="email" class="form-label">Email Address:</label>
                                 <input type="text" class="bottom_border ms-2" name="email" id="email"
                                     value="{{ $projectData->email }}">
                             </div>
                             <div class="col-12 mt-3">
                                 <h6>
                                     Total Assets:
                                 </h6>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="land" class="form-label">Land:</label>
                                 <input type="text" class="bottom_border ms-2" id="land" name="land">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="building" class="form-label">Building:</label>
                                 <input type="text" class="bottom_border ms-2" id="building" name="building">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="equipment" class="form-label">Equipment:</label>
                                 <input type="text" class="bottom_border ms-2" id="equipment" name="equipment">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="workingCapital" class="form-label">Working Capital:</label>
                                 <input type="text" class="bottom_border ms-2" id="workingCapital"
                                     name="workingCapital">
                             </div>
                             <div class="col-12  mt-3">
                                 <h6>
                                     Total Employment Generated
                                 </h6>
                             </div>
                             <div class="col-12">
                                 <span class="fw-semibold">Company Hire:</span>
                             </div>
                             <div class="col-2">
                                 <span class="fw-light">Regular:</span>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="maleInput" class="form-label">Male</label>
                                 <input type="text" class="bottom_border ms-2" id="Regular_male" name="Regular_male">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="femaleInput" class="form-label">Female</label>
                                 <input type="text" class="bottom_border ms-2" id="Regular_female"
                                     name="Regular_female">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="subtotalInput" class="form-label">Sub-total</label>
                                 <input type="text" class="bottom_border ms-2" id="Regular_subtotal"
                                     name="Regular_subtotal">
                             </div>
                             <div class="col-2">
                                 <span class="fw-light">Part-time</span>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="maleInput" class="form-label">Male</label>
                                 <input type="text" class="bottom_border ms-2" id="Parttime_male"
                                     name="Parttime_male">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="femaleInput" class="form-label">Female</label>
                                 <input type="text" class="bottom_border ms-2" id="Parttime_female"
                                     name="Parttime_female">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="subtotalInput" class="form-label">Sub-total</label>
                                 <input type="text" class="bottom_border ms-2" id="Parttime_subtotal"
                                     name="Parttime_subtotal">
                             </div>
                             <div class="col-12">
                                 <span class="fw-semibold">Sub-contractor Hire:</span>
                             </div>
                             <div class="col-2">
                                 <span class="fw-light">Regular:</span>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="maleInput" class="form-label">Male</label>
                                 <input type="text" class="bottom_border ms-2" id="Regu_Subcont_male"
                                     name="Regu_Subcont_male">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="femaleInput" class="form-label">Female</label>
                                 <input type="text" class="bottom_border ms-2" id="Regu_Subcont_female"
                                     name="Regu_Subcont_female">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="subtotalInput" class="form-label">Sub-total</label>
                                 <input type="text" class="bottom_border ms-2" id="Regu_Subcont_subtotal"
                                     name="Regu_Subcont_subtotal">
                             </div>
                             <div class="col-2">
                                 <span class="fw-light">Part-time:</span>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="maleInput" class="form-label">Male</label>
                                 <input type="text" class="bottom_border ms-2" id="Subcont_Parttime_male"
                                     name="Subcont_Parttime_male">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="femaleInput" class="form-label">Female</label>
                                 <input type="text" class="bottom_border ms-2" id="Subcont_Parttime_female"
                                     name="Subcont_Parttime_female">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="subtotalInput" class="form-label">Sub-total</label>
                                 <input type="text" class="bottom_border ms-2" id="Subcont_Parttime_subtotal"
                                     name="Subcont_Parttime_subtotal">
                             </div>
                             <div class="col-12">
                                 <h6>
                                     Indirect Employment
                                 </h6>
                             </div>
                             <div class="col-2">
                                 <span class="fw-light">Regular:</span>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="maleInput" class="form-label">Male</label>
                                 <input type="text" class="bottom_border ms-2" id="Indirect_Regular_male"
                                     name="Indirect_Regular_male">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="femaleInput" class="form-label">Female</label>
                                 <input type="text" class="bottom_border ms-2" id="Indirect_Regular_female"
                                     name="Indirect_Regular_female">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="subtotalInput" class="form-label">Sub-total</label>
                                 <input type="text" class="bottom_border ms-2" id="Indirect_Regular_subtotal"
                                     name="Indirect_Regular_subtotal">
                             </div>
                             <div class="col-2">
                                 <span class="fw-light">Part-time:</span>
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="maleInput" class="form-label">Male</label>
                                 <input type="text" class="bottom_border ms-2" id="Indirect_Parttime_male"
                                     name="Indirect_Parttime_male">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="femaleInput" class="form-label">Female</label>
                                 <input type="text" class="bottom_border ms-2" id="Indirect_Parttime_female"
                                     name="Indirect_Parttime_female">
                             </div>
                             <div class="col-12 col-md-3">
                                 <label for="subtotalInput" class="form-label">Sub-total</label>
                                 <input type="text" class="bottom_border ms-2" id="Indirect_Parttime_subtotal"
                                     name="Indirect_Parttime_subtotal">
                             </div>
                             <div class="col-12">
                                 <h6>Production Volume</h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <div class="mb-3">
                                     <label for="exportProduct" class="form-label">Export Product</label>
                                     <input type="text" class="form-control" id="exportProduct"
                                         name="exportProduct">
                                 </div>
                             </div>
                             <div class="col-12 col-md-6">
                                 <div class="mb-3">
                                     <label for="localProduct" class="form-label">Local Product</label>
                                     <input type="text" class="form-control" id="localProduct"
                                         name="localProduct">
                                 </div>
                             </div>
                             <div class="col-12">
                                 <h6>Total Gross Sales ₱</h6>
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="localProductValue">Local</label>
                                 <input type="text" class="form-control" id="localProductValue"
                                     name="localProductValue">
                             </div>
                             <div class="col-12 col-md-6">
                                 <label for="exportProductValue">Export</label>
                                 <input type="text" class="form-control" id="exportProductValue"
                                     name="exportProductValue">
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
         <div class="col-12">
             <div class="card p-0">
                 <div class="card-header">
                     Assistance obtained from DOST (please check)
                 </div>
                 <div class="card-body">
                     <form id="PIS_checklistsForm">
                         <div class="row">
                             <div class="col-12 ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="productionTechnology" name="productionTechnology">
                                     <label class="form-check-label" for="productionTechnology">
                                         A1 Production Technology
                                     </label>
                                 </div>
                             </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="process" name="process">
                                     <label class="form-check-label " for="process">
                                         A.1.1 Process
                                     </label>
                                 </div>
                                </div>
                                <div class="col-12 col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2" name="processDefinition">
                                </div>
                             <div class="col-12 col-md-3 ps-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="equipment"
                                         name="equipment">
                                     <label class="form-check-label " for="equipment">
                                         A.1.2 Equipment
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2" name="processDefinition">
                                </div>
                             <div class="col-12 ps-3">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="qualityControl"
                                         name="qualityControl">
                                     <label class="form-check-label " for="qualityControl">
                                         A.1.3 Quality Control/Laboratory Testing/Analysis
                                     </label>
                                 </div>
                             </div>
                             <div class="col-12 col-md-3  ps-4">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="productionTechnology1"
                                         name="productionTechnology1">
                                     <label class="form-check-label " for="productionTechnology1">
                                         1.3.1 Production Technology
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2" name="qualityControlDefinition">
                                </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="packagingLabeling"
                                         name="packagingLabeling">
                                     <label class="form-check-label" for="packagingLabeling">
                                         A2 Packaging/Labeling
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2" name="packagingLabelingDefinition">
                                </div>
                             <div class="col-12 col-md-3 ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="postHarvest"
                                         name="postHarvest">
                                     <label class="form-check-label" for="postHarvest">
                                         A3 Post-Harvest
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2" name="postHarvestDefinition">
                                </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="marketAssistance"
                                         name="marketAssistance">
                                     <label class="form-check-label" for="marketAssistance">
                                         A4 Market Assistance
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2" name="marketAssistanceDefinition">
                                </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="humanResourceTraining"
                                         name="humanResourceTraining">
                                     <label class="form-check-label" for="humanResourceTraining">
                                         A5 Human Resource training
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2"
                                        name="humanResourceTrainingDefinition">
                                </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="consultanceServices"
                                         name="consultanceServices">
                                     <label class="form-check-label" for="consultanceServices">
                                         A6 Consultance Services
                                     </label>
                                 </div>
                                </div>
                                <div class=" col-md-9 ps-4">
                                    <input type="text" class="bottom_border ms-2"
                                        name="consultanceServicesDefinition">
                                </div>
                             <div class="col-12 col-md-3  ps-1">
                                 <div class="form-check">
                                     <input class="form-check-input" type="checkbox" id="otherServices"
                                         name="otherServices">
                                     <label class="form-check-label" for="otherServices">
                                         A7 other Services (FDA Permit, LGU Registration,
                                         Barcoding)
                                     </label>
                                 </div>
                                </div>
                                <div class="col-md-9 ps-4 ">
                                    <input type="text" class="bottom_border ms-2"
                                        name="consultanceServicesDefinition">
                                </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
         <div class="d-flex justify-content-end p-3">
             <button type="button" class="btn btn-primary ExportPDF">Export as PDF</button>
         </div>
     </div>
 </div>
