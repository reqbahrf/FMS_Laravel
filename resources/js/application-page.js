import { formatNumber } from './Utilities/utilFunctions';
import {
    showToastFeedback,
    showProcessToast,
    hideProcessToast,
} from './Utilities/feedback-toast';
import { setupPhoneNumberInput } from './Utilities/phone-formatter';
import { customFormatNumericInput } from './Utilities/input-utils';
import { FormDraftHandler } from './Utilities/FormDraftHandler';
import { AddressFormInput } from './Utilities/AddressInputHandler';
import {
    InitializeFilePond,
    handleFilePondSelectorDisabling,
} from './Utilities/FilepondHandlers';
import {
    addNewRowHandler,
    removeRowHandler,
} from './Utilities/add-and-remove-table-row-handler';
import APPLICATION_FORM_CONFIG from './Form_Config/APPLICATION_CONFIG';
import BENCHMARKTableConfig from './Form_Config/form-table-config/tnaFormBenchMarkTableConfig';
import { TableDataExtractor } from './Utilities/TableDataExtractor';
import 'smartwizard/dist/css/smart_wizard_all.css';
import smartWizard from 'smartwizard';
import calculateEnterpriseLevel from './Utilities/calculate-enterprise-level';
//TODO: For testing purposes
// $(window).on('beforeunload', function () {
//     return 'Are you sure you want to leave?';
// });
const APPLICATION_FORM = $('#applicationForm');
const ASSETS_CARD = APPLICATION_FORM.find('#assetsCard');
let is_initialized = false;
export function initializeForm() {
    if (!is_initialized) {
        is_initialized = true;
    }

    customFormatNumericInput('form', [
        '#requested_fund_amount',
        '#initial_capitalization',
        '#present_capitalization',
    ]);
    customFormatNumericInput('#productAndSupplyChainTable tbody', [
        'input.UnitCost',
        'input.VolumeUsed',
    ]);
    customFormatNumericInput('#productionTable tbody', [
        'input.UnitCost',
        'input.AnnualCost',
    ]);
    customFormatNumericInput('#productionEquipmentTable tbody', [
        'input.Capacity',
    ]);

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
        { acceptedFileTypes: ['application/pdf', 'image/png', 'image/jpeg'] },
        'IntentFileID_Data_Handler'
    );

    // DTI/SEC/CDA File
    const dtiSecCdaInstance = InitializeFilePond(
        'DTI_SEC_CDA_File',
        { acceptedFileTypes: ['application/pdf', 'image/png', 'image/jpeg'] },
        'DtiSecCdaFileID_Data_Handler',
        'DtiSecCdaSelector'
    );

    // Business Permit File
    const businessPermitInstance = InitializeFilePond(
        'businessPermitFile',
        { acceptedFileTypes: ['application/pdf', 'image/png', 'image/jpeg'] },
        'BusinessPermitFileID_Data_Handler'
    );

    // FDA LTO File
    const fdaLtoInstance = InitializeFilePond(
        'fdaLtoFile',
        { acceptedFileTypes: ['application/pdf', 'image/png', 'image/jpeg'] },
        'FdaLtoFileID_Data_Handler',
        'fdaLtoSelector'
    );

    // Receipt File
    const receiptInstance = InitializeFilePond(
        'receiptFile',
        { acceptedFileTypes: ['application/pdf', 'image/png', 'image/jpeg'] },
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
        { acceptedFileTypes: ['application/pdf', 'image/png', 'image/jpeg'] },
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
    addNewRowHandler(
        '.add-product-and-supply-chain-row',
        '#productAndSupplyChainContainer'
    );
    removeRowHandler(
        '.remove-product-and-supply-chain-row',
        '#productAndSupplyChainContainer'
    );

    addNewRowHandler('.add-production-row', '#productionContainer');
    removeRowHandler('.remove-production-row', '#productionContainer');

    addNewRowHandler(
        '.add-production-equipment-row',
        '#productionEquipmentContainer'
    );
    removeRowHandler(
        '.remove-production-equipment-row',
        '#productionEquipmentContainer'
    );

    addNewRowHandler('.add-new-local-product-row', '#localMarketContainer');
    removeRowHandler('.remove-new-local-product-row', '#localMarketContainer');

    addNewRowHandler('.add-new-export-product-row', '#exportMarketContainer');
    removeRowHandler(
        '.remove-new-export-product-row',
        '#exportMarketContainer'
    );

    $('input, select').on('focus', function () {
        if ($(this).attr('required')) {
            $(this).removeClass('is-invalid');
        }
    });

    const smartWizardClassInstance = new smartWizard();
    const smartWizardInstance = $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'dots',
        autoAdjustHeight: false,
        transition: {
            animation: 'fade',
        },
        keyboard: {
            keyNavigation: false,
        },
        toolbar: {
            toolbarPosition: 'bottom',
            toolbarButtonPosition: 'right',
            showNextButton: true,
            showPreviousButton: true,
            position: 'both bottom',
            extraHtml: /*html*/ `<button
                    type="button"
                    class="btn btn-success submit-btn"
                    onclick="onFinish()"
                >
                    Submit
                </button>
                <button
                    class="btn btn-secondary cancel-btn"
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
                $('.submit-btn, .cancel-btn').hide();
            }
            if (stepIndex === 2) {
                $('.submit-btn, .cancel-btn').show();
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
                console.warn('Required checkboxes not found in DOM');
            }
            if (!this.confirmButton.length) {
                console.warn('Confirm button not found in DOM');
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
        const processToast = showProcessToast('Submitting form...');
        try {
            let formDataObject = {};
            const form = APPLICATION_FORM.find(':input:not([readonly])');
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
                url: APPLICATION_FORM.attr('action'),
                data: JSON.stringify(formDataObject),
                contentType: 'application/json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });

            confirmationModal.hide();

            if (response.success) {
                const message = response.success;
                hideProcessToast(processToast);

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
            hideProcessToast(processToast);
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
    setupPhoneNumberInput('#mobile_no');

    customFormatNumericInput($('div#personnelContainer'), 'input');

    // Apply custom formatting to input fields
    customFormatNumericInput(ASSETS_CARD, [
        '#buildings',
        '#equipments',
        '#working_capital',
    ]);

    ASSETS_CARD.find('#buildings, #equipments, #working_capital').on(
        'input',
        () => calculateEnterpriseLevel(ASSETS_CARD)
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

    // Initialize multiple address forms
    const addressForms = [
        new AddressFormInput({ prefix: 'home' }),
        new AddressFormInput({ prefix: 'office' }),
        new AddressFormInput({ prefix: 'factory' }),
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

    const formDraftHandler = new FormDraftHandler(APPLICATION_FORM);

    formDraftHandler.syncTextInputData();
    formDraftHandler.syncTablesData('#productAndSupplyChainTable tbody', {
        productAndSupply: BENCHMARKTableConfig.productAndSupply,
    });
    formDraftHandler.syncTablesData('#productionTable tbody', {
        production: BENCHMARKTableConfig.production,
    });
    formDraftHandler.syncTablesData('#productionEquipmentTable tbody', {
        productionEquipment: BENCHMARKTableConfig.productionEquipment,
    });
    formDraftHandler.syncTablesData('#exportMarketTable tbody', {
        exportMarket: tableConfigurations.exportMarket,
    });
    formDraftHandler.syncTablesData('#localMarketTable tbody', {
        localMarket: tableConfigurations.localMarket,
    });

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

    const loadAddressDropdowns = async (draftData) => {
        await AddressFormInput.loadHomeAddressDropdowns(draftData);
        await AddressFormInput.loadOfficeAddressDropdowns(draftData);
        await AddressFormInput.loadFactoryAddressDropdowns(draftData);
    };
    $(async () => {
        await formDraftHandler.loadDraftData(
            APPLICATION_FORM_CONFIG,
            null,
            null,
            null,
            loadAddressDropdowns
        );
        calculateEnterpriseLevel($('#assetsCard'));
    });
}

initializeForm();
