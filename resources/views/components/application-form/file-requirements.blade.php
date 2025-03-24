<h3>Upload the Following Requirements:</h3>
<div class="row mb-12 p-5">
    <div class="mb-3">
        <label
            class="form-label"
            for="IntentFile"
        >Letter of Intent:
            <span class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
        </label>
        <input
            class="fileUploads"
            id="intentFile"
            name="intentFile"
            type="file"
            accept="application/pdf"
            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
        >
        <div class="invalid-feedback">
            Please upload the Letter of Intent.
        </div>
        <div class="form-text">Accepted formats: .pdf. Maximum file size: 10MB</div>
    </div>
    <div class="mb-3">
        <label
            class="form-label"
            for="DtiSecCdafile"
        >DTI/SEC/CDA
            <span class="form-text">(Certificate of Registration):</span>
            <span class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
        </label>
        <div class="row mb-3">
            <div class="col-2 d-flex align-items-center justify-content-center">
                <select
                    class="form-select form-select-lg"
                    id="DtiSecCdaSelector"
                    name="DSC_file_Selector"
                >
                    <option value="">Choose...</option>
                    <option value="DTI">DTI</option>
                    <option value="SEC">SEC</option>
                    <option value="CDA">CDA</option>
                </select>
            </div>
            <div
                class="col-10"
                id="DtiSecCdaContainer"
            >
                <input
                    class="fileUploads"
                    id="DTI_SEC_CDA_File"
                    name="DTI_SEC_CDA_File"
                    type="file"
                    {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                >
                <div class="invalid-feedback">
                    Please upload the DTI/SEC/CDA document.
                </div>
            </div>
        </div>
        <div class="form-text">Choose 1 out of 3 documents above. the accepted formats: .pdf.
            Maximum file size: 10MB
        </div>
    </div>
    <div class="mb-3">
        <label
            class="form-label"
            for="businessPermitFile"
        >Business Permit:
            <span class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
        </label>
        <input
            class="fileUploads"
            id="businessPermitFile"
            name="businessPermitFile"
            type="file"
            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
        >
        <div class="invalid-feedback">
            Please upload the Business Permit.
        </div>
        <div class="form-text">Accepted formats: .pdf.</div>
    </div>
    <div class="mb-3">
        <label
            class="form-label"
            for="fdaLtoFile"
        >FDA/LTO
            <span class="form-text">(Certificate of Registration):</span>
            <span class="fw-lighter">
                (if Applicable)
            </span>
            <span class="form-text text-secondary fw-lighter">
                Food and Drug Administration(FDA) or Food and Drug Administration(LTO)
            </span>
        </label>
        <div class="row mb-3">
            <div class="col-2 d-flex align-items-center justify-content-center">
                <select
                    class="form-select form-select-lg"
                    id="fdaLtoSelector"
                    name="Fda_Lto_Selector"
                >
                    <option value="">Choose...</option>
                    <option value="FDA">FDA</option>
                    <option value="LTO">LTO</option>
                </select>
            </div>
            <div class="col-10">
                <input
                    class="fileUploads"
                    id="fdaLtoFile"
                    name="fdaLtoFile"
                    type="file"
                >
            </div>
        </div>
        <div class="form-text">Choose 1 out of 2 documents above. the accepted formats: .pdf
            Maximum file size: 10MB
        </div>
    </div>
    <div class="mb-3">
        <label
            class="form-label"
            for="receiptFile"
        >Official Receipt of the Business:
            <span class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
        </label>
        <input
            class="fileUploads"
            id="receiptFile"
            name="receiptFile"
            type="file"
            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
        >
        <div class="invalid-feedback">
            Please upload the Official Receipt of the Business.
        </div>
        <div class="form-text">Accepted formats: .pdf.</div>
    </div>
    <div class="mb-3">
        <label
            class="form-label"
            for="govIdFile"
        >Government Valid ID:
            <span class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
        </label>
        <div class="row">
            <div class="col-2 d-flex align-items-center justify-content-center">
                <Select
                    class="form-select form-select-lg"
                    id="GovIdSelector"
                    name="GovIdSelector"
                >
                    <option value="">Choose...</option>
                    <option value="National ID">National ID</option>
                    <option value="SSS ID">SSS UMID</option>
                    <option value="GSIS ID">GSIS UMID</option>
                    <option value="Passport ID">Philippine Passport</option>
                </Select>
            </div>
            <div class="col-10 mb-3">
                <input
                    class="fileUploads"
                    id="govIdFile"
                    name="govIdFile"
                    type="file"
                    capture="environment"
                    {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
                >
                <div class="invalid-feedback">
                    Please upload the Copy of Government Valid ID.
                </div>
                <div class="form-text">Accepted formats: .jpeg, .png. Maximum file size: 10MB
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label
            class="form-label"
            for="BIRFile"
        >BIR
            <span class="form-text">(Certificate of Registration):</span>
            <span class="requiredFields">{{ auth()->user()->hasRole('Cooperator') ? '*' : '' }}</span>
            <span class="form-text text-secondary fw-lighter">
                Bureau of Internal Revenue(BIR) Certificate of Registration
            </span>
        </label>
        <input
            class="fileUploads"
            id="BIRFile"
            name="BIRFile"
            type="file"
            {{ auth()->user()->hasRole('Cooperator') ? 'required' : '' }}
        >
        <div class="form-text">Accepted formats: .pdf. Maximum file size: 10MB</div>
        <div class="invalid-feedback">
            Please upload the BIR.
        </div>
    </div>
    <div
        class="alert alert-primary m-0"
        role="alert"
    >
        <i class="ri-information-2-fill ri-lg"></i>
        Please, before you proceed to the next step, make sure you have double-checked all the
        uploaded files.
    </div>
    <input
        id="IntentFileID_Data_Handler"
        name="IntentFileID_Data_Handler"
        type="hidden"
    >
    <input
        id="DtiSecCdaFileID_Data_Handler"
        name="DtiSecCdaFileID_Data_Handler"
        type="hidden"
    >
    <input
        id="BusinessPermitFileID_Data_Handler"
        name="BusinessPermitFileID_Data_Handler"
        type="hidden"
    >
    <input
        id="FdaLtoFileID_Data_Handler"
        name="FdaLtoFileID_Data_Handler"
        type="hidden"
    >
    <input
        id="ReceiptFileID_Data_Handler"
        name="ReceiptFileID_Data_Handler"
        type="hidden"
    >
    <input
        id="GovIdFileID_Data_Handler"
        name="GovIdFileID_Data_Handler"
        type="hidden"
    >
    <input
        id="BIRFileID_Data_Handler"
        name="BIRFileID_Data_Handler"
        type="hidden"
    >
</div>
