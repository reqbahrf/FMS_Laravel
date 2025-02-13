import {
    showToastFeedback,
    showProcessToast,
    hideProcessToast,
    customFormatNumericInput
} from './Utilities/utilFunctions';
import { FormDraftHandler } from './Utilities/FormDraftHandler';
import {
    InitializeFilePond,
    handleFilePondSelectorDisabling,
} from './Utilities/FilepondHandlers';
import {
    AddNewRowHandler,
    RemoveRowHandler,
} from './Utilities/AddAndRemoveTableRowHandler';
import APPLICATION_FORM_CONFIG from './Form_Config/APPLICATION_CONFIG';
import { TableDataExtractor } from './Utilities/TableDataExtractor';
import 'smartwizard/dist/css/smart_wizard_all.css';
import smartWizard from 'smartwizard';
window.smartWizard = smartWizard;
//TODO: For testing purposes
$(window).on('beforeunload', function () {
    return 'Are you sure you want to leave?';
});
let is_initialized = false;
export function initializeForm() {
    new smartWizard();
    if (!is_initialized) {
        is_initialized = true;
    }

    customFormatNumericInput('form', ['#initial_capitalization', '#present_capitalization']);
    customFormatNumericInput('#productAndSupplyChainTable tbody', [
        'tr td:nth-child(3) input.UnitCost',
        'tr td:nth-child(4) input.VolumeUsed'
    ]);
    customFormatNumericInput('#productionTable', [
        'tr td:nth-child(3) .UnitCost',
        'tr td:nth-child(4) .AnnualCost'
    ]);
    customFormatNumericInput('#productionEquipmentTable', ['.Capacity'])

    const confirmButton = $('#confirmButton');
    confirmButton.off('click');

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
    )

    const processFlowInstance = InitializeFilePond(
        'processFlow',
        { acceptedFileTypes: ['image/png', 'image/jpeg'] },
        'ProcessFlowFileID_Data_Handler'
    )

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

    const BENCHMARKTableConfig = {
        productAndSupply: {
            id: 'productAndSupplyChainContainer',
            selectors: {
                rowMaterial: '.RawMaterial',
                source: '.Source',
                unitCost: '.UnitCost',
                volumeUsed: '.VolumeUsed',
            },
            requiredFields: ['rowMaterial', 'source', 'unitCost', 'volumeUsed'],
        },
        production: {
            id: 'productionContainer',
            selectors: {
                product: '.Product',
                volumeProduction: '.VolumeProduction',
                unitCost: '.UnitCost',
                annualCost: '.AnnualCost',
            },
            requiredFields: [
                'product',
                'volumeProduction',
                'unitCost',
                'annualCost',
            ],
        },
        productionEquipment: {
            id: 'productionEquipmentContainer',
            selectors: {
                typeOfEquipment: '.TypeOfEquipment',
                specification: '.Specification',
                capacity: '.Capacity',
            },
            requiredFields: ['typeOfEquipment', 'specification', 'capacity'],
        },
    };

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
            const fileInput = fileInputContainer.querySelector('input[type="file"]');
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

        console.log('File uploads validation result:', isValid);
        return isValid;
    }
    $('#yearEstablished, #yearEnterpriseRegistered, #permitYearRegistered').on('input', function(e) {
        // Remove any non-numeric characters
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });

    smartWizardInstance.on(
        'leaveStep',
        function (
            e,
            anchorObject,
            currentStepIndex,
            nextStepIndex,
            stepDirection
        ) {
            console.log(
                'Leave Step',
                currentStepIndex,
                nextStepIndex,
                stepDirection
            );

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

            if (stepPosition != 'Last') {
                $('.btn-success, .btn-secondary').hide();
            }

            if (stepIndex === totalSteps - 1 && stepPosition === 'last') {
                console.log('Arriving at Last Step - Showing Buttons');
            } else {
                console.log('Not Arriving at Last Step - Hiding Buttons');
                $('.btn-success, .btn-secondary').hide();
            }
            if (stepIndex === 3) {
                // Since stepIndex is 0-based, step-4 corresponds to index 3
                $('.btn-success, .btn-secondary').show();

                let fullName =
                    $('#prefix').val() +
                    ' ' +
                    $('#f_name').val() +
                    ' ' +
                    $('#middle_name').val() +
                    ' ' +
                    $('#l_name').val() +
                    ' ' +
                    $('#suffix').val();

                $('#re_Full_name').val(fullName);
                $('#re_b_Date').val($('#b_date').val());
                $('#re_designa').val($('#designation').val());
                $('#re_Mobile_no').val($('#Mobile_no').val());
                $('#re_landline').val($('#landline').val());

                // Business Info
                $('#re_firm_name').val($('#firm_name').val());
                $('#re_type_enterprise').val($('#enterpriseType').val());
                const BusinessInfo = {
                    Background: $('#brief_background').val(),
                    PermitNo: $('#business_permit_No').val(),
                    PermitYearRegistered: $('#permit_year_registered').val(),
                    RegistrationNo: $('#enterpriseRegistrationNo').val(),
                    RegistrationYear: $('#yearEnterpriseRegistered').val(),
                    BusinessType: $('#businessType').val(),
                    InitialCapital: $('#initial_capitalization').val(),
                    presentCapital: $('#present_capitalization').val(),
                    specificProduct: $('#specificProductOrService').val(),
                    reasonsForAssistance: $(
                        '#reasonsWhyAssistanceIsBeingSought'
                    ).val(),
                    consultationAnswer: $(
                        'input[name="consultationAnswer"]:checked'
                    ).val(),
                    companyAgency: $('#fromWhatCompanyAgency').val(),
                    assistanceType: $(
                        '#pleaseSpecifyTheTypeOfAssistanceSought'
                    ).val(),
                    whyNot: $('#whyNot').val(),
                    enterprisePlanForTheNext5Years: $(
                        '#enterprisePlanForTheNext5Years'
                    ).val(),
                    nextTenYears: $('#nextTenYears').val(),
                    currentAgreementAndAlliancesUndertaken: $(
                        '#currentAgreementAndAlliancesUndertaken'
                    ).val(),
                };

                const BusinessActivities = {
                    foodProcessing: $('#food_Processing_activity').is(':checked'),
                    foodProcessingSpecificSector: $(
                        '#food_processing_specific_sector'
                    ).val(),
                    furniture: $('#furniture_activity').is(':checked'),
                    furnitureSpecificSector: $(
                        '#furniture_specific_sector'
                    ).val(),
                    naturalFibers: $('#natural_fibers_activity').is(':checked'),
                    naturalFibersSpecificSector: $(
                        '#natural_fibers_specific_sector'
                    ).val(),
                    metals: $('#metals_and_engineering_activity').is(':checked'),
                    metalsSpecificSector: $('#metals_and_engineering_specific_sector').val(),
                    aquatic: $('#aquatic_and_marine_activity').is(':checked'),
                    aquaticSpecificSector: $('#aquatic_and_marine_specific_sector').val(),
                    horticulture: $('#horticulture_activity').is(':checked'),
                    horticultureSpecificSector: $(
                        '#horticulture_specific_sector'
                    ).val(),
                    others: $('#other_activity').is(':checked'),
                    othersSpecificSector: $('#other_specific_sector').val(),
                };
                const OfficeLandMark = $('#officeLandmark').val();
                const OfficeBarangay = 'Barangay ' + $('#officeBarangay').val();
                const OfficeCity = $('#officeCity').val();
                const OfficeProvince = $('#officeProvince').val();
                const OfficeRegion = $('#officeRegion').val();
                const OfficeTeleNumber = $('#officeTelNo').val();
                const OfficeFax = $('#officeFaxNo').val();
                const OfficeEmail = $('#officeEmailAddress').val();

                const FactoryLandMark = $('#factoryLandmark').val();
                const FactoryBarangay =
                    'Barangay ' + $('#factoryBarangay').val();
                const FactoryCity = $('#factoryCity').val();
                const FactoryProvince = $('#factoryProvince').val();
                const FactoryRegion = $('#factoryRegion').val();
                const FactoryTeleNumber = $('#factoryTelNo').val();
                const FactoryFax = $('#factoryFaxNo').val();
                const FactoryEmail = $('#factoryEmailAddress').val();

                $('#re_brief_background').val(BusinessInfo.Background);
                $('#re_business_permit_No').val(BusinessInfo.PermitNo);
                $('#re_permit_year_registered').val(BusinessInfo.PermitYearRegistered);
                $('#re_enterpriseRegistrationNo').val(
                    BusinessInfo.RegistrationNo
                );
                $('#re_yearEnterpriseRegistered').val(
                    BusinessInfo.RegistrationYear
                );
                $('#re_initial_capitalization').val(BusinessInfo.InitialCapital);
                $('#re_present_capitalization').val(BusinessInfo.presentCapital);

                $('#re_OfficeAddress').val(
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
                $('#re_officeEmailAddress').val(OfficeEmail);
                $('#re_officeTelNo').val(OfficeTeleNumber);
                $('#re_officeFaxNo').val(OfficeFax);

                $('#re_factoryAddress').val(
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
                $('#re_factoryEmailAddress').val(FactoryEmail);
                $('#re_factoryTelNo').val(FactoryTeleNumber);
                $('#re_factoryFaxNo').val(FactoryFax);

                $('#re_foodProcessing').prop(
                    'checked',
                    BusinessActivities.foodProcessing
                );
                $('#re_foodProcessingSpecificSector').val(
                    BusinessActivities.foodProcessingSpecificSector
                );
                $('#re_furniture').prop(
                    'checked',
                    BusinessActivities.furniture
                );
                $('#re_furnitureSpecificSector').val(
                    BusinessActivities.furnitureSpecificSector
                );
                $('#re_naturalFibers').prop(
                    'checked',
                    BusinessActivities.naturalFibers
                );
                $('#re_naturalFibersSpecificSector').val(
                    BusinessActivities.naturalFibersSpecificSector
                );
                $('#re_metals').prop('checked', BusinessActivities.metals);
                $('#re_metalsSpecificSector').val(
                    BusinessActivities.metalsSpecificSector
                );
                $('#re_aquatic').prop('checked', BusinessActivities.aquatic);
                $('#re_aquaticSpecificSector').val(
                    BusinessActivities.aquaticSpecificSector
                );
                $('#re_horticulture').prop(
                    'checked',
                    BusinessActivities.horticulture
                );
                $('#re_horticultureSpecificSector').val(
                    BusinessActivities.horticultureSpecificSector
                );
                $('#re_others').prop('checked', BusinessActivities.others);
                $('#re_othersSpecificSector').val(
                    BusinessActivities.othersSpecificSector
                );

                $('#re_buildings').val($('#buildings').val());
                $('#re_equipments').val($('#equipments').val());
                $('#re_working_capital').val($('#working_capital').val());
                $('#re_to_Assets').text($('#to_Assets').text());
                $('#re_Enterprise_Level').text($('#Enterprise_Level').text());
                $('#EnterpriseLevelInput').val($('#Enterprise_Level').text());
                $('#re_LocalMar').val($('#LocalMar').val());
                $('#re_ExportMar').val($('#ExportMar').val());

                // Personnel Info
                $('#re_m_personnelDiRe').val($('#m_personnelDiRe').val());
                $('#re_f_personnelDiRe').val($('#f_personnelDiRe').val());
                $('#re_m_personnelDiPart').val($('#m_personnelDiPart').val());
                $('#re_f_personnelDiPart').val($('#f_personnelDiPart').val());

                // Retrieve and populate values for indirect personnel
                $('#re_m_personnelIndRe').val($('#m_personnelIndRe').val());
                $('#re_f_personnelIndRe').val($('#f_personnelIndRe').val());
                $('#re_m_personnelIndPart').val($('#m_personnelIndPart').val());
                $('#re_f_personnelIndPart').val($('#f_personnelIndPart').val());

                // Object mapping file input IDs to their corresponding readonly input IDs

                // Update the review section with consultation data
                $('#re_specificProductOrService').val(
                    BusinessInfo.specificProduct
                );
                $('#re_reasonsWhyAssistanceIsBeingSought').val(
                    BusinessInfo.reasonsForAssistance
                );

                $('#re_enterprisePlanForTheNext5Years').val(
                    BusinessInfo.enterprisePlanForTheNext5Years
                );
                $('#re_nextTenYears').val(BusinessInfo.nextTenYears);
                $('#re_currentAgreementAndAlliancesUndertaken').val(
                    BusinessInfo.currentAgreementAndAlliancesUndertaken
                );

                // Handle consultation radio buttons in review
                if (BusinessInfo.consultationAnswer === 'yes') {
                    $('#re_consultationYes').prop('checked', true);
                    $('#re_consultationNo').prop('checked', false);
                    $('#re_yesConsultationDetails').show();
                    $('#re_noConsultationDetails').hide();
                    $('#re_fromWhatCompanyAgency').val(
                        BusinessInfo.companyAgency
                    );
                    $('#re_pleaseSpecifyTheTypeOfAssistanceSought').val(
                        BusinessInfo.assistanceType
                    );
                } else if (BusinessInfo.consultationAnswer === 'no') {
                    $('#re_consultationYes').prop('checked', false);
                    $('#re_consultationNo').prop('checked', true);
                    $('#re_yesConsultationDetails').hide();
                    $('#re_noConsultationDetails').show();
                    $('#re_whyNot').val(BusinessInfo.whyNot);
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

    const confirmTrueInfo = $('input[type="checkbox"]#detail_confirm');
    const confirmAgreeInfo = $('input[type="checkbox"]#agree_terms');
    const make_availableInfo = $('input[type="checkbox"]#make_available');
    const satisfied_requirementsInfo = $('input[type="checkbox"]#satisfied_requirements');
    const when_inputs_suppliedInfo = $('input[type="checkbox"]#when_inputs_supplied');
    const report_preparedInfo = $('input[type="checkbox"]#report_prepared');
    const report_permissionInfo = $('input[type="checkbox"]#report_permission');
    const receipt_acknowledgmentInfo = $('input[type="checkbox"]#receipt_acknowledgment');

    $(confirmTrueInfo)
        .add(confirmAgreeInfo)
        .add(make_availableInfo)
        .add(satisfied_requirementsInfo)
        .add(when_inputs_suppliedInfo)
        .add(report_preparedInfo)
        .add(report_permissionInfo)
        .add(receipt_acknowledgmentInfo)
        .on('change', function () {
            confirmButton.prop(
                'disabled',
                !$(confirmTrueInfo).is(':checked') ||
                !$(confirmAgreeInfo).is(':checked') ||
                !$(make_availableInfo).is(':checked') ||
                !$(satisfied_requirementsInfo).is(':checked') ||
                !$(when_inputs_suppliedInfo).is(':checked') ||
                !$(report_preparedInfo).is(':checked') ||
                !$(report_permissionInfo).is(':checked') ||
                !$(receipt_acknowledgmentInfo).is(':checked')
            );
        });

    confirmButton.on('click', async function (event) {
        event.preventDefault();
        await submitForm();
    });

    const ApplicationForm = $('#applicationForm');

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

            console.log(formDataObject);
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
                error[0] || error.responseJSON.message
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

    const formatNumber = (input) => {
        let value = input.value.replace(/,/g, ''); // Remove existing commas
        value = value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except for decimal point
        value = value.replace(/(\.\d{2})\d+$/, '$1'); // Limit decimal points to 2

        // Add commas every 3 digits
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        input.value = value;
    };

    $('.num_only').on('input', function () {
        const input = $(this);
        const value = input.val().replace(/[^0-9.]/g, '');
        input.val(value);
    });

    function updateEnterpriseLevel() {
        $('#buildings, #equipments, #working_capital').each(function () {
            formatNumber($(this)[0]);
        });

        const buildingsValue =
            parseFloat($('#buildings').val().replace(/,/g, '')) || 0;
        const equipmentsValue =
            parseFloat($('#equipments').val().replace(/,/g, '')) || 0;
        const workingCapitalValue =
            parseFloat($('#working_capital').val().replace(/,/g, '')) || 0;
        const total = buildingsValue + equipmentsValue + workingCapitalValue;
        $('#to_Assets').text(
            total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
        );
        if (total === 0) {
            $('#Enterprise_Level').text('');
            return;
        }
        if (total < 3e6) {
            $('#Enterprise_Level').text('Micro Enterprise');
        } else if (total < 15e6) {
            $('#Enterprise_Level').text('Small Enterprise');
        } else if (total < 100e6) {
            $('#Enterprise_Level').text('Medium Enterprise');
        } else {
            $('#Enterprise_Level').text('Large Enterprise');
        }
    }

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

            AddressForm.populateSelect(this.selectors.province, [], 'Select Province');
            AddressForm.populateSelect(this.selectors.city, [], 'Select City');
            AddressForm.populateSelect(this.selectors.barangay, [], 'Select Barangay');

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
            AddressForm.populateSelect(this.selectors.barangay, [], 'Select Barangay');

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
        const provinceCode = $('#officeProvince').find(':selected').data('code');
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
        const provinceCode = $('#factoryProvince').find(':selected').data('code');
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
