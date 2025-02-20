import {
    showToastFeedback,
    showProcessToast,
    hideProcessToast,
} from './Utilities/utilFunctions';
import { customFormatNumericInput } from './Utilities/input-utils';
import { FormDraftHandler } from './Utilities/FormDraftHandler';
import {
    InitializeFilePond,
    handleFilePondSelectorDisabling,
} from './Utilities/FilepondHandlers';
import {
    AddNewRowHandler,
    RemoveRowHandler,
} from './Utilities/add-and-remove-table-row-handler';
import APPLICATION_FORM_CONFIG from './Form_Config/APPLICATION_CONFIG';
import BENCHMARKTableConfig from './Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import { TableDataExtractor } from './Utilities/TableDataExtractor';
import 'smartwizard/dist/css/smart_wizard_all.css';
import smartWizard from 'smartwizard';
window.smartWizard = smartWizard;
//TODO: For testing purposes
// $(window).on('beforeunload', function () {
//     return 'Are you sure you want to leave?';
// });
const ApplicationForm = $('#applicationForm');
let is_initialized = false;
export function initializeForm() {
    new smartWizard();
    if (!is_initialized) {
        is_initialized = true;
    }

    customFormatNumericInput('form', [
        '#initial_capitalization',
        '#present_capitalization',
    ]);
    customFormatNumericInput('#productAndSupplyChainTable tbody', [
        'tr td:nth-child(3) input.UnitCost',
        'tr td:nth-child(4) input.VolumeUsed',
    ]);
    customFormatNumericInput('#productionTable', [
        'tr td:nth-child(3) .UnitCost',
        'tr td:nth-child(4) .AnnualCost',
    ]);
    customFormatNumericInput('#productionEquipmentTable', ['.Capacity']);

    const API_BASE_URL = 'https://psgc.gitlab.io/api';

    const organizationalStructureInstance = InitializeFilePond(
        'organizationalStructure',
        { acceptedFileTypes: ['image/png', 'image/jpeg'] },
        'OrganizationalStructureFileID_Data_Handler'
    );

    const planLayoutInstance = InitializeFilePond(
        'planLayout',
        { acceptedFileTypes: ['image/png', 'image/jpeg'] },
        'PlanLayoutFileID_Data_Handler'
    );

    const processFlowInstance = InitializeFilePond(
        'processFlow',
        { acceptedFileTypes: ['image/png', 'image/jpeg'] },
        'ProcessFlowFileID_Data_Handler'
    );

    // Intent File
    const intentInstance = InitializeFilePond(
        'intentFile',
        { acceptedFileTypes: ['application/pdf'] },
        'IntentFileID_Data_Handler'
    );

    // DTI/SEC/CDA File
    const dtiSecCdaInstance = InitializeFilePond(
        'DTI_SEC_CDA_File',
        { acceptedFileTypes: ['application/pdf'] },
        'DtiSecCdaFileID_Data_Handler',
        'DtiSecCdaSelector'
    );

    // Business Permit File
    const businessPermitInstance = InitializeFilePond(
        'businessPermitFile',
        { acceptedFileTypes: ['application/pdf'] },
        'BusinessPermitFileID_Data_Handler'
    );

    // FDA LTO File
    const fdaLtoInstance = InitializeFilePond(
        'fdaLtoFile',
        { acceptedFileTypes: ['application/pdf'] },
        'FdaLtoFileID_Data_Handler',
        'fdaLtoSelector'
    );

    // Receipt File
    const receiptInstance = InitializeFilePond(
        'receiptFile',
        { acceptedFileTypes: ['application/pdf'] },
        'ReceiptFileID_Data_Handler'
    );

    // Government ID File
    const govIdInstance = InitializeFilePond(
        'govIdFile',
        {
            acceptedFileTypes: ['image/png', 'image/jpeg'],
            captureMethod: 'environment',
        },
        'GovIdFileID_Data_Handler',
        'GovIdSelector'
    );

    // BIR File
    const birInstance = InitializeFilePond(
        'BIRFile',
        { acceptedFileTypes: ['application/pdf'] },
        'BIRFileID_Data_Handler'
    );

    handleFilePondSelectorDisabling('DtiSecCdaSelector', dtiSecCdaInstance);
    handleFilePondSelectorDisabling('fdaLtoSelector', fdaLtoInstance);
    handleFilePondSelectorDisabling('GovIdSelector', govIdInstance);

    const beachMarkTableData = (BENCHMARKTableConfig) => {
        const data = TableDataExtractor(BENCHMARKTableConfig);
        return data;
    };

    //TODO: fix these handler
    AddNewRowHandler(
        '.addProductAndSupplyChainRow',
        '#productAndSupplyChainContainer'
    );
    RemoveRowHandler('.removeRowButton', '#productAndSupplyChainContainer');

    AddNewRowHandler('.addProductionRow', '#productionContainer');
    RemoveRowHandler('.removeRowButton', '#productionContainer');

    AddNewRowHandler(
        '.addProductionEquipmentRow',
        '#productionEquipmentContainer'
    );
    RemoveRowHandler('.removeRowButton', '#productionEquipmentContainer');

    AddNewRowHandler(
        '.addNewProductRow',
        '#localMarketContainer, #exportMarketContainer'
    );
    RemoveRowHandler(
        '.removeRowButton',
        '#localMarketContainer, #exportMarketContainer'
    );

    $('input, select').on('focus', function () {
        if ($(this).attr('required')) {
            $(this).removeClass('is-invalid');
        }
    });

    const smartWizardInstance = $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'dots',
        autoAdjustHeight: false,
        transition: {
            animation: 'fade',
        },
        toolbar: {
            toolbarPosition: 'bottom',
            toolbarButtonPosition: 'right',
            showNextButton: true,
            showPreviousButton: true,
            position: 'both bottom',
            extraHtml: /*html*/ `<button
                    type="button"
                    class="btn btn-success"
                    onclick="onFinish()"
                >
                    Submit
                </button>
                <button
                    class="btn btn-secondary"
                    onclick="onCancel()"
                >
                    Cancel
                </button>`,
        },
        anchorSettings: {
            anchorClickable: false,
        },
    });

    function validateCurrentStep(stepIndex) {
        const currentStep = $('#step-' + (stepIndex + 1));
        const requiredInputs = currentStep.find(
            'input[required], select[required], textarea[required]'
        );
        let isValid = true;

        requiredInputs.each(function () {
            const input = $(this);
            const value = input.val().trim();
            const invalidFeedback = input.next('.invalid-feedback');

            if (!value) {
                isValid = false;
                input.addClass('is-invalid'); // Add invalid class for styling
                if (invalidFeedback.length) {
                    invalidFeedback.show();
                }
            } else {
                input.removeClass('is-invalid');
                if (invalidFeedback.length) {
                    invalidFeedback.hide();
                }
            }
        });

        return isValid;
    }

    function validateFileUploads() {
        // Debugging step detection
        const smartWizardElement = $('#smartwizard');
        // Get step information
        const stepInfo = smartWizardElement.smartWizard('getStepInfo');

        // File requirement step (0-indexed)
        const fileRequirementStepIndex = 2; // Third step
        // Only validate on the file requirement step
        if (stepInfo.currentStep !== fileRequirementStepIndex) {
            return true; // Skip validation for other steps
        }

        const requiredFileInputs = [
            'organizationalStructure',
            'planLayout',
            'processFlow',
            'intentFile',
            'DTI_SEC_CDA_File',
            'businessPermitFile',
            'receiptFile',
            'govIdFile',
            'BIRFile',
        ];

        let isValid = true;

        requiredFileInputs.forEach((inputId) => {
            const fileInputContainer = document.querySelector(`#${inputId}`);
            const fileInput =
                fileInputContainer.querySelector('input[type="file"]');
            if (!fileInput) {
                return; // Skip this iteration
            }

            // Only validate if the input is required
            if (!fileInput.hasAttribute('required')) {
                return; // Skip this iteration if not required
            }

            // More robust invalid feedback finding
            const parentDiv = fileInput.closest('.mb-3');
            const invalidFeedback = parentDiv
                ? parentDiv.querySelector('.invalid-feedback') ||
                  document.createElement('div')
                : null;

            if (!invalidFeedback) {
                // Create invalid feedback if it doesn't exist
                invalidFeedback = document.createElement('div');
                invalidFeedback.classList.add('invalid-feedback');
                invalidFeedback.textContent = `Please upload ${inputId.replace(
                    'File',
                    ''
                )} file`;
                parentDiv.appendChild(invalidFeedback);
            }

            // Get the FilePond instance
            const pondInstance = FilePond.find(fileInputContainer);

            // Check if no files are uploaded
            if (!pondInstance || pondInstance.getFiles().length === 0) {
                // TODO: change to `false` after the testing
                isValid = true;

                // Show invalid feedback
                invalidFeedback.style.display = 'block';
                invalidFeedback.textContent = `Please upload ${inputId.replace(
                    'File',
                    ''
                )} file`;
                fileInput.classList.add('is-invalid');
            } else {
                // Hide invalid feedback
                invalidFeedback.style.display = 'none';
                fileInput.classList.remove('is-invalid');
            }
        });
        return isValid;
    }
    $('#yearEstablished, #yearEnterpriseRegistered, #permitYearRegistered').on(
        'input',
        function (e) {
            // Remove any non-numeric characters
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        }
    );

    smartWizardInstance.on(
        'leaveStep',
        function (
            e,
            anchorObject,
            currentStepIndex,
            nextStepIndex,
            stepDirection
        ) {
            if (nextStepIndex > currentStepIndex) {
                // Combine regular input and file upload validation
                const regularInputsValid =
                    validateCurrentStep(currentStepIndex);
                const fileUploadsValid = validateFileUploads();

                if (!regularInputsValid || !fileUploadsValid) {
                    e.preventDefault();
                    return false;
                }
            }
        }
    );

    smartWizardInstance.on(
        'showStep',
        function (e, anchorObject, stepIndex, stepDirection, stepPosition) {
            const totalSteps = $('#smartwizard').find('ul li').length;

            if (stepIndex !== totalSteps - 1 && stepPosition !== 'last') {
                $('.btn-success, .btn-secondary').hide();
            }
            if (stepIndex === 3) {
                // Since stepIndex is 0-based, step-4 corresponds to index 3
                $('.btn-success, .btn-secondary').show();
                const inputField = ApplicationForm.find(
                    'input:not([readonly]), select:not([readonly]), textarea:not([readonly])'
                );
                const reviewInputsContainer = $('#reviewInputsContainer').find(
                    'input[readonly], select[readonly], textarea[readonly]'
                );
                let fullName =
                    inputField.filter('#prefix').val() +
                    ' ' +
                    inputField.filter('#f_name').val() +
                    ' ' +
                    inputField.filter('#middle_name').val() +
                    ' ' +
                    inputField.filter('#l_name').val() +
                    ' ' +
                    inputField.filter('#suffix').val();

                reviewInputsContainer.filter('#re_Full_name').val(fullName);
                reviewInputsContainer
                    .filter('#re_b_Date')
                    .val(inputField.filter('#b_date').val());
                reviewInputsContainer
                    .filter('#re_designa')
                    .val(inputField.filter('#designation').val());
                reviewInputsContainer
                    .filter('#re_Mobile_no')
                    .val(inputField.filter('#Mobile_no').val());
                reviewInputsContainer
                    .filter('#re_landline')
                    .val(inputField.filter('#landline').val());

                // Business Info
                reviewInputsContainer
                    .filter('#re_firm_name')
                    .val(inputField.filter('#firm_name').val());
                reviewInputsContainer
                    .filter('#re_type_enterprise')
                    .val(inputField.filter('#enterpriseType').val());
                const BusinessInfo = {
                    Background: inputField.filter('#brief_background').val(),
                    PermitNo: inputField.filter('#business_permit_No').val(),
                    PermitYearRegistered: inputField
                        .filter('#permit_year_registered')
                        .val(),
                    RegistrationNo: inputField
                        .filter('#enterpriseRegistrationNo')
                        .val(),
                    RegistrationYear: inputField
                        .filter('#yearEnterpriseRegistered')
                        .val(),
                    BusinessType: inputField.filter('#businessType').val(),
                    InitialCapital: inputField
                        .filter('#initial_capitalization')
                        .val(),
                    presentCapital: inputField
                        .filter('#present_capitalization')
                        .val(),
                    specificProduct: inputField
                        .filter('#specificProductOrService')
                        .val(),
                    reasonsForAssistance: inputField
                        .filter('#reasonsWhyAssistanceIsBeingSought')
                        .val(),
                    consultationAnswer: inputField
                        .filter('input[name="consultationAnswer"]:checked')
                        .val(),
                    companyAgency: inputField
                        .filter('#fromWhatCompanyAgency')
                        .val(),
                    assistanceType: inputField
                        .filter('#pleaseSpecifyTheTypeOfAssistanceSought')
                        .val(),
                    whyNot: inputField.filter('#whyNot').val(),
                    enterprisePlanForTheNext5Years: inputField
                        .filter('#enterprisePlanForTheNext5Years')
                        .val(),
                    nextTenYears: inputField.filter('#nextTenYears').val(),
                    currentAgreementAndAlliancesUndertaken: inputField
                        .filter('#currentAgreementAndAlliancesUndertaken')
                        .val(),
                };

                const BusinessActivities = {
                    foodProcessing: inputField
                        .filter('#food_Processing_activity')
                        .is(':checked'),
                    foodProcessingSpecificSector: inputField
                        .filter('#food_processing_specific_sector')
                        .val(),
                    furniture: inputField
                        .filter('#furniture_activity')
                        .is(':checked'),
                    furnitureSpecificSector: inputField
                        .filter('#furniture_specific_sector')
                        .val(),
                    naturalFibers: inputField
                        .filter('#natural_fibers_activity')
                        .is(':checked'),
                    naturalFibersSpecificSector: inputField
                        .filter('#natural_fibers_specific_sector')
                        .val(),
                    metals: inputField
                        .filter('#metals_and_engineering_activity')
                        .is(':checked'),
                    metalsSpecificSector: inputField
                        .filter('#metals_and_engineering_specific_sector')
                        .val(),
                    aquatic: inputField
                        .filter('#aquatic_and_marine_activity')
                        .is(':checked'),
                    aquaticSpecificSector: inputField
                        .filter('#aquatic_and_marine_specific_sector')
                        .val(),
                    horticulture: inputField
                        .filter('#horticulture_activity')
                        .is(':checked'),
                    horticultureSpecificSector: inputField
                        .filter('#horticulture_specific_sector')
                        .val(),
                    others: inputField.filter('#other_activity').is(':checked'),
                    othersSpecificSector: inputField
                        .filter('#other_specific_sector')
                        .val(),
                };
                const OfficeLandMark = inputField
                    .filter('#officeLandmark')
                    .val();
                const OfficeBarangay =
                    'Barangay ' + inputField.filter('#officeBarangay').val();
                const OfficeCity = inputField.filter('#officeCity').val();
                const OfficeProvince = inputField
                    .filter('#officeProvince')
                    .val();
                const OfficeRegion = inputField.filter('#officeRegion').val();
                const OfficeTeleNumber = inputField
                    .filter('#officeTelNo')
                    .val();
                const OfficeFax = inputField.filter('#officeFaxNo').val();
                const OfficeEmail = inputField
                    .filter('#officeEmailAddress')
                    .val();

                const FactoryLandMark = inputField
                    .filter('#factoryLandmark')
                    .val();
                const FactoryBarangay =
                    'Barangay ' + inputField.filter('#factoryBarangay').val();
                const FactoryCity = inputField.filter('#factoryCity').val();
                const FactoryProvince = inputField
                    .filter('#factoryProvince')
                    .val();
                const FactoryRegion = inputField.filter('#factoryRegion').val();
                const FactoryTeleNumber = inputField
                    .filter('#factoryTelNo')
                    .val();
                const FactoryFax = inputField.filter('#factoryFaxNo').val();
                const FactoryEmail = inputField
                    .filter('#factoryEmailAddress')
                    .val();

                reviewInputsContainer
                    .filter('#re_brief_background')
                    .val(BusinessInfo.Background);
                reviewInputsContainer
                    .filter('#re_business_permit_No')
                    .val(BusinessInfo.PermitNo);
                reviewInputsContainer
                    .filter('#re_permit_year_registered')
                    .val(BusinessInfo.PermitYearRegistered);
                reviewInputsContainer
                    .filter('#re_enterpriseRegistrationNo')
                    .val(BusinessInfo.RegistrationNo);
                reviewInputsContainer
                    .filter('#re_yearEnterpriseRegistered')
                    .val(BusinessInfo.RegistrationYear);
                reviewInputsContainer
                    .filter('#re_initial_capitalization')
                    .val(BusinessInfo.InitialCapital);
                reviewInputsContainer
                    .filter('#re_present_capitalization')
                    .val(BusinessInfo.presentCapital);

                reviewInputsContainer
                    .filter('#re_OfficeAddress')
                    .val(
                        OfficeLandMark +
                            ', ' +
                            OfficeBarangay +
                            ', ' +
                            OfficeCity +
                            ', ' +
                            OfficeProvince +
                            ', ' +
                            OfficeRegion
                    );
                reviewInputsContainer
                    .filter('#re_officeEmailAddress')
                    .val(OfficeEmail);
                reviewInputsContainer
                    .filter('#re_officeTelNo')
                    .val(OfficeTeleNumber);
                reviewInputsContainer.filter('#re_officeFaxNo').val(OfficeFax);

                reviewInputsContainer
                    .filter('#re_factoryAddress')
                    .val(
                        FactoryLandMark +
                            ', ' +
                            FactoryBarangay +
                            ', ' +
                            FactoryCity +
                            ', ' +
                            FactoryProvince +
                            ', ' +
                            FactoryRegion
                    );
                reviewInputsContainer
                    .filter('#re_factoryEmailAddress')
                    .val(FactoryEmail);
                reviewInputsContainer
                    .filter('#re_factoryTelNo')
                    .val(FactoryTeleNumber);
                reviewInputsContainer
                    .filter('#re_factoryFaxNo')
                    .val(FactoryFax);

                reviewInputsContainer
                    .filter('#re_foodProcessing')
                    .prop('checked', BusinessActivities.foodProcessing);
                reviewInputsContainer
                    .filter('#re_foodProcessingSpecificSector')
                    .val(BusinessActivities.foodProcessingSpecificSector);
                reviewInputsContainer
                    .filter('#re_furniture')
                    .prop('checked', BusinessActivities.furniture);
                reviewInputsContainer
                    .filter('#re_furnitureSpecificSector')
                    .val(BusinessActivities.furnitureSpecificSector);
                reviewInputsContainer
                    .filter('#re_naturalFibers')
                    .prop('checked', BusinessActivities.naturalFibers);
                reviewInputsContainer
                    .filter('#re_naturalFibersSpecificSector')
                    .val(BusinessActivities.naturalFibersSpecificSector);
                reviewInputsContainer
                    .filter('#re_metals')
                    .prop('checked', BusinessActivities.metals);
                reviewInputsContainer
                    .filter('#re_metalsSpecificSector')
                    .val(BusinessActivities.metalsSpecificSector);
                reviewInputsContainer
                    .filter('#re_aquatic')
                    .prop('checked', BusinessActivities.aquatic);
                reviewInputsContainer
                    .filter('#re_aquaticSpecificSector')
                    .val(BusinessActivities.aquaticSpecificSector);
                $('#re_horticulture').prop(
                    'checked',
                    BusinessActivities.horticulture
                );
                $('#re_horticultureSpecificSector').val(
                    BusinessActivities.horticultureSpecificSector
                );
                reviewInputsContainer
                    .filter('#re_others')
                    .prop('checked', BusinessActivities.others);
                reviewInputsContainer
                    .filter('#re_othersSpecificSector')
                    .val(BusinessActivities.othersSpecificSector);

                reviewInputsContainer
                    .filter('#re_buildings')
                    .val(inputField.filter('#buildings').val());
                reviewInputsContainer
                    .filter('#re_equipments')
                    .val(inputField.filter('#equipments').val());
                reviewInputsContainer
                    .filter('#re_working_capital')
                    .val(inputField.filter('#working_capital').val());
                reviewInputsContainer
                    .filter('#re_to_Assets')
                    .text(inputField.filter('#to_Assets').text());
                reviewInputsContainer
                    .filter('#re_Enterprise_Level')
                    .text(inputField.filter('#Enterprise_Level').text());
                reviewInputsContainer
                    .filter('#EnterpriseLevelInput')
                    .val(inputField.filter('#Enterprise_Level').text());
                reviewInputsContainer
                    .filter('#re_LocalMar')
                    .val(inputField.filter('#LocalMar').val());
                reviewInputsContainer
                    .filter('#re_ExportMar')
                    .val(inputField.filter('#ExportMar').val());

                // Personnel Info
                reviewInputsContainer
                    .filter('#re_m_personnelDiRe')
                    .val(inputField.filter('#m_personnelDiRe').val());
                reviewInputsContainer
                    .filter('#re_f_personnelDiRe')
                    .val(inputField.filter('#f_personnelDiRe').val());
                reviewInputsContainer
                    .filter('#re_m_personnelDiPart')
                    .val(inputField.filter('#m_personnelDiPart').val());
                reviewInputsContainer
                    .filter('#re_f_personnelDiPart')
                    .val(inputField.filter('#f_personnelDiPart').val());

                // Retrieve and populate values for indirect personnel
                reviewInputsContainer
                    .filter('#re_m_personnelIndRe')
                    .val(inputField.filter('#m_personnelIndRe').val());
                reviewInputsContainer
                    .filter('#re_f_personnelIndRe')
                    .val(inputField.filter('#f_personnelIndRe').val());
                reviewInputsContainer
                    .filter('#re_m_personnelIndPart')
                    .val(inputField.filter('#m_personnelIndPart').val());
                reviewInputsContainer
                    .filter('#re_f_personnelIndPart')
                    .val(inputField.filter('#f_personnelIndPart').val());

                // Object mapping file input IDs to their corresponding readonly input IDs

                // Update the review section with consultation data
                reviewInputsContainer
                    .filter('#re_specificProductOrService')
                    .val(BusinessInfo.specificProduct);
                reviewInputsContainer
                    .filter('#re_reasonsWhyAssistanceIsBeingSought')
                    .val(BusinessInfo.reasonsForAssistance);

                reviewInputsContainer
                    .filter('#re_enterprisePlanForTheNext5Years')
                    .val(BusinessInfo.enterprisePlanForTheNext5Years);
                reviewInputsContainer
                    .filter('#re_nextTenYears')
                    .val(BusinessInfo.nextTenYears);
                reviewInputsContainer
                    .filter('#re_currentAgreementAndAlliancesUndertaken')
                    .val(BusinessInfo.currentAgreementAndAlliancesUndertaken);

                // Handle consultation radio buttons in review
                if (BusinessInfo.consultationAnswer === 'yes') {
                    reviewInputsContainer
                        .filter('#re_consultationYes')
                        .prop('checked', true);
                    reviewInputsContainer
                        .filter('#re_consultationNo')
                        .prop('checked', false);
                    reviewInputsContainer
                        .filter('#re_yesConsultationDetails')
                        .show();
                    reviewInputsContainer
                        .filter('#re_noConsultationDetails')
                        .hide();
                    reviewInputsContainer
                        .filter('#re_fromWhatCompanyAgency')
                        .val(BusinessInfo.companyAgency);
                    reviewInputsContainer
                        .filter('#re_pleaseSpecifyTheTypeOfAssistanceSought')
                        .val(BusinessInfo.assistanceType);
                } else if (BusinessInfo.consultationAnswer === 'no') {
                    reviewInputsContainer
                        .filter('#re_consultationYes')
                        .prop('checked', false);
                    reviewInputsContainer
                        .filter('#re_consultationNo')
                        .prop('checked', true);
                    reviewInputsContainer
                        .filter('#re_yesConsultationDetails')
                        .hide();
                    reviewInputsContainer
                        .filter('#re_noConsultationDetails')
                        .show();
                    reviewInputsContainer
                        .filter('#re_whyNot')
                        .val(BusinessInfo.whyNot);
                }
            }
        }
    );
    //TODO: change to false own done with the testing
    function validateCurrentStep(stepIndex) {
        let isValid = true;
        const currentStep = $('#step-' + (stepIndex + 1)); // stepIndex is 0-based

        currentStep.find('input, select, textarea').each(function () {
            if (!this.checkValidity()) {
                $(this).addClass('is-invalid'); // Add invalid class for styling
                isValid = true;
                $('#smartwizard').smartWizard('fixHeight');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        return isValid;
    }

    window.onFinish = function () {
        window.confirmationModal = new bootstrap.Modal(
            document.getElementById('confirmationModal')
        );
        confirmationModal.show();
    };

    let checkBoxValidationHandler;
    // Checkbox Validation Handler
    class CheckboxValidationHandler {
        constructor(config) {
            this.checkboxIds = [
                'detail_confirm',
                'agree_terms',
                'make_available',
                'satisfied_requirements',
                'when_inputs_supplied',
                'report_prepared',
                'report_permission',
                'receipt_acknowledgment',
            ];
            this.confirmButtonId = config.confirmButtonId;
            this.initialize();
        }

        initialize() {
            // Create a single selector for all checkboxes
            const checkboxSelector = this.checkboxIds
                .map((id) => `input[type="checkbox"]#${id}`)
                .join(',');
            this.checkboxes = $(checkboxSelector);
            this.confirmButton = $(`#${this.confirmButtonId}`);

            if (!this.checkboxes.length) {
                throw new Error('Required checkboxes not found in DOM');
            }
            if (!this.confirmButton.length) {
                throw new Error('Confirm button not found in DOM');
            }

            // Bind event handler
            this.checkboxes.on('change', this.handleCheckboxChange.bind(this));

            this.confirmButton.on('click', async (event) => {
                event.preventDefault();
                try {
                    await submitForm();
                } catch (err) {
                    showToastFeedback('text-bg-danger', err);
                }
            });
        }

        handleCheckboxChange() {
            // Check if all checkboxes are checked using a single array operation
            const allChecked = Array.from(this.checkboxes).every(
                (checkbox) => checkbox.checked
            );

            // Update button state
            this.confirmButton.prop('disabled', !allChecked);
        }

        // Clean up method to remove event listeners
        destroy() {
            this.checkboxes.off('change');
        }
    }

    if (checkBoxValidationHandler) checkBoxValidationHandler.destroy();
    // Usage
    checkBoxValidationHandler = new CheckboxValidationHandler({
        confirmButtonId: 'confirmButton',
    });

    // Clean up when needed
    // validationHandler.destroy();

    async function submitForm() {
        showProcessToast('Submitting form...');
        try {
            let formDataObject = {};
            const form = ApplicationForm.find(':input:not([readonly])');
            const updatedFormData = form.serializeArray();
            $.each(updatedFormData, function (i, v) {
                formDataObject[v.name] = v.value;
            });

            formDataObject = {
                ...formDataObject,
                ...beachMarkTableData(BENCHMARKTableConfig),
                ...getMarketProductsData(tableConfigurations),
            };

            const response = await $.ajax({
                type: 'POST',
                url: REGISTRATIONFORM_SUBMISSION_ROUTE,
                data: JSON.stringify(formDataObject),
                contentType: 'application/json',
                processData: false,
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });

            confirmationModal.hide();

            if (response.success) {
                const message = response.success;
                hideProcessToast();

                setTimeout(() => {
                    showToastFeedback('text-bg-success', message);
                }, 500);

                if (response.redirect) {
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 3000);
                }
            }
        } catch (error) {
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.error ||
                    error?.responseJSON?.message ||
                    'Error submitting form'
            );
            console.error('Error submitting form:', error);
        }
    }

    function onCancel() {
        console.log('Form cancelled');
        window.location.href = 'some_cancel_url'; // Redirect to a specific URL
    }
    $('#Mobile_no')
        .on('keypress', function (e) {
            const charCode = e.which ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        })
        .on('input', function () {
            const number = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
            if (number.length > 0) {
                var formattedNumber = number.match(
                    /(\d{0,3})(\d{0,3})(\d{0,4})/
                );
                var formatted = '';
                if (formattedNumber[1]) formatted += formattedNumber[1];
                if (formattedNumber[2]) formatted += '-' + formattedNumber[2];
                if (formattedNumber[3]) formatted += '-' + formattedNumber[3];
                $(this).val(formatted);
            }
        });

    customFormatNumericInput($('div#personnelContainer'), 'input');

    function updateEnterpriseLevel() {
        // Cache DOM selections
        const enterpriseLevelElement = $('span#Enterprise_Level');
        const totalAssetsElement = $('span#to_Assets');
        const enterpriseLevelInput = $('input#EnterpriseLevelInput');

        // Helper function to parse comma-separated numbers
        const parseNumericInput = (selector) => {
            const value = $(selector).val().replace(/,/g, '');
            return parseFloat(value) || 0;
        };

        // Parse values, removing commas before parsing
        const buildingsValue = parseNumericInput('#buildings');
        const equipmentsValue = parseNumericInput('#equipments');
        const workingCapitalValue = parseNumericInput('#working_capital');

        // Calculate total
        const total = buildingsValue + equipmentsValue + workingCapitalValue;

        // Format total with comma separators
        totalAssetsElement.text(
            total.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );

        // Determine enterprise level using a more declarative approach
        const enterpriseLevels = [
            { threshold: 3e6, level: 'Micro Enterprise' },
            { threshold: 15e6, level: 'Small Enterprise' },
            { threshold: 100e6, level: 'Medium Enterprise' },
            { threshold: Infinity, level: 'Large Enterprise' },
        ];

        const enterpriseLevel = enterpriseLevels.findLast(
            ({ threshold }) => total >= threshold
        ).level;

        enterpriseLevelElement.text(enterpriseLevel);
        enterpriseLevelInput.val(enterpriseLevel);
    }

    // Apply custom formatting to input fields
    customFormatNumericInput('#buildings, #equipments, #working_capital');

    $('#buildings, #equipments, #working_capital').on(
        'input',
        updateEnterpriseLevel
    );

    $('textarea').on('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    $('textarea[readonly]').each(function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    $('#Export, #Local').on('input', function () {
        if (this.scrollHeight > this.clientHeight) {
            $('#smartwizard').smartWizard('fixHeight');
        }
    });

    const API = {
        fetchRegions: () => {
            return $.ajax({
                type: 'GET',
                url: `${API_BASE_URL}/regions/`,
            }).fail((error) => {
                console.error('Error fetching regions:', error);
            });
        },

        fetchProvinces: (regionCode) => {
            return $.ajax({
                type: 'GET',
                url: `${API_BASE_URL}/regions/${regionCode}/provinces/`,
            }).fail((error) => {
                console.error('Error fetching provinces:', error);
            });
        },

        fetchCities: (provinceCode) => {
            return $.ajax({
                type: 'GET',
                url: `${API_BASE_URL}/provinces/${provinceCode}/cities-municipalities/`,
            }).fail((error) => {
                console.error('Error fetching cities:', error);
            });
        },
        fetchBarangay: (cityCode) => {
            return $.ajax({
                type: 'GET',
                url: `${API_BASE_URL}/cities-municipalities/${cityCode}/barangays/`,
            });
        },
    };

    class AddressForm {
        constructor(config) {
            this.prefix = config.prefix;
            this.selectors = {
                region: `#${this.prefix}Region`,
                province: `#${this.prefix}Province`,
                city: `#${this.prefix}City`,
                barangay: `#${this.prefix}Barangay`,
            };
            this.initializeAddressSelection();
        }

        static populateSelect(selectElement, data, placeholder) {
            const parsedData =
                typeof data === 'string' ? JSON.parse(data) : data;
            $(selectElement).html(`<option value="">${placeholder}</option>`);
            $.each(parsedData, (index, item) => {
                $(selectElement).append(
                    `<option value="${item.name}" data-code="${item.code}">${item.name}</option>`
                );
            });
        }

        initializeAddressSelection() {
            this.initializeRegions();
            $(this.selectors.region).on('change', () => this.updateProvinces());
            $(this.selectors.province).on('change', () => this.updateCities());
            $(this.selectors.city).on('change', () => this.updateBarangays());
        }

        initializeRegions() {
            API.fetchRegions().done((regions) => {
                AddressForm.populateSelect(
                    this.selectors.region,
                    regions,
                    'Select Region'
                );
            });
        }

        updateProvinces() {
            const regionCode = $(this.selectors.region)
                .find(':selected')
                .data('code');

            $(this.selectors.province).prop('disabled', !regionCode);
            $(this.selectors.city).prop('disabled', true);
            $(this.selectors.barangay).prop('disabled', true);

            AddressForm.populateSelect(
                this.selectors.province,
                [],
                'Select Province'
            );
            AddressForm.populateSelect(this.selectors.city, [], 'Select City');
            AddressForm.populateSelect(
                this.selectors.barangay,
                [],
                'Select Barangay'
            );

            if (regionCode) {
                API.fetchProvinces(regionCode).done((provinces) => {
                    AddressForm.populateSelect(
                        this.selectors.province,
                        provinces,
                        'Select Province'
                    );
                });
            }
        }

        updateCities() {
            const provinceCode = $(this.selectors.province)
                .find(':selected')
                .data('code');

            $(this.selectors.city).prop('disabled', !provinceCode);
            $(this.selectors.barangay).prop('disabled', true);

            AddressForm.populateSelect(this.selectors.city, [], 'Select City');
            AddressForm.populateSelect(
                this.selectors.barangay,
                [],
                'Select Barangay'
            );

            if (provinceCode) {
                API.fetchCities(provinceCode).done((cities) => {
                    AddressForm.populateSelect(
                        this.selectors.city,
                        cities,
                        'Select City'
                    );
                });
            }
        }

        updateBarangays() {
            const cityCode = $(this.selectors.city)
                .find(':selected')
                .data('code');
            $(this.selectors.barangay).prop('disabled', !cityCode);

            if (cityCode) {
                API.fetchBarangay(cityCode).done((barangays) => {
                    AddressForm.populateSelect(
                        this.selectors.barangay,
                        barangays,
                        'Select Barangay'
                    );
                });
            }
        }
    }

    // Initialize multiple address forms
    const addressForms = [
        new AddressForm({ prefix: 'office' }),
        new AddressForm({ prefix: 'factory' }),
    ];

    const getMarketProductsData = (tableConfigs) => {
        const allMarketData = TableDataExtractor(tableConfigs);
        return allMarketData;
    };

    const tableConfigurations = {
        exportMarket: {
            id: 'exportMarketTable',
            selectors: {
                product: '.product',
                location: '.location',
                volume: '.volume',
                unit: '.unit',
            },
            requiredFields: ['product'],
        },
        localMarket: {
            id: 'localMarketTable',
            selectors: {
                product: '.product',
                location: '.location',
                volume: '.volume',
                unit: '.unit',
            },
            requiredFields: ['product'],
        },
    };

    const DRAFT_TYPE = 'Application';

    const formDraftHandler = new FormDraftHandler(ApplicationForm, DRAFT_TYPE);

    formDraftHandler.syncTextInputData();
    formDraftHandler.syncTablesData(
        '#exportMarketTable tr, #localMarketTable tr',
        tableConfigurations
    );

    const FileMetaHiddenInputs = [
        'OrganizationalStructureFileID_Data_Handler',
        'PlanLayoutFileID_Data_Handler',
        'ProcessFlowFileID_Data_Handler',
        'IntentFileID_Data_Handler',
        'DtiSecCdaFileID_Data_Handler',
        'BusinessPermitFileID_Data_Handler',
        'FdaLtoFileID_Data_Handler',
        'ReceiptFileID_Data_Handler',
        'GovIdFileID_Data_Handler',
        'BIRFileID_Data_Handler',
    ];
    formDraftHandler.syncFilepondData(FileMetaHiddenInputs);

    const loadApplicationFormInputFields = (draftData, formSelector) => {
        const excludedFields = [
            'exportMarket',
            'localMarket',
            'officeRegion',
            'officeProvince',
            'officeCity',
            'officeBarangay',
            'factoryRegion',
            'factoryProvince',
            'factoryCity',
            'factoryBarangay',
        ];
        formDraftHandler.loadTextInputData(
            draftData,
            formSelector,
            excludedFields
        );
    };

    const loadLocationDropdown = async (
        selector,
        fetchFn,
        data,
        placeholder
    ) => {
        return new Promise((resolve) => {
            fetchFn.done((items) => {
                AddressForm.populateSelect($(selector), items, placeholder);
                $(selector).val(data);
                $(selector).prop('disabled', false);
                resolve();
            });
        });
    };

    const loadOfficeAddressDropdowns = async (draftData) => {
        if (!draftData.officeRegion) return;

        // Load regions
        await loadLocationDropdown(
            '#officeRegion',
            API.fetchRegions(),
            draftData.officeRegion,
            'Select Office Region'
        );

        if (!draftData.officeProvince) return;

        // Load provinces
        const regionCode = $('#officeRegion').find(':selected').data('code');
        await loadLocationDropdown(
            '#officeProvince',
            API.fetchProvinces(regionCode),
            draftData.officeProvince,
            'Select Office Province'
        );

        if (!draftData.officeCity) return;

        // Load cities
        const provinceCode = $('#officeProvince')
            .find(':selected')
            .data('code');
        await loadLocationDropdown(
            '#officeCity',
            API.fetchCities(provinceCode),
            draftData.officeCity,
            'Select Office City'
        );

        if (!draftData.officeBarangay) return;

        // Load barangays
        const cityCode = $('#officeCity').find(':selected').data('code');
        await loadLocationDropdown(
            '#officeBarangay',
            API.fetchBarangay(cityCode),
            draftData.officeBarangay,
            'Select Office Barangay'
        );
    };

    const loadFactoryAddressDropdowns = async (draftData) => {
        if (!draftData.factoryRegion) return;

        // Load regions
        await loadLocationDropdown(
            '#factoryRegion',
            API.fetchRegions(),
            draftData.factoryRegion,
            'Select Factory Region'
        );

        if (!draftData.factoryProvince) return;

        // Load provinces
        const regionCode = $('#factoryRegion').find(':selected').data('code');
        await loadLocationDropdown(
            '#factoryProvince',
            API.fetchProvinces(regionCode),
            draftData.factoryProvince,
            'Select Factory Province'
        );

        if (!draftData.factoryCity) return;

        // Load cities
        const provinceCode = $('#factoryProvince')
            .find(':selected')
            .data('code');
        await loadLocationDropdown(
            '#factoryCity',
            API.fetchCities(provinceCode),
            draftData.factoryCity,
            'Select Factory City'
        );

        if (!draftData.factoryBarangay) return;

        // Load barangays
        const cityCode = $('#factoryCity').find(':selected').data('code');
        await loadLocationDropdown(
            '#factoryBarangay',
            API.fetchBarangay(cityCode),
            draftData.factoryBarangay,
            'Select Factory Barangay'
        );
    };

    $(async () => {
        await formDraftHandler.loadDraftData(
            APPLICATION_FORM_CONFIG,
            loadApplicationFormInputFields,
            null,
            null,
            {
                loadOfficeAddressDropdowns,
                loadFactoryAddressDropdowns,
            }
        );
        updateEnterpriseLevel();
    });
}

initializeForm();
