import {
    showToastFeedback,
    showProcessToast,
    hideProcessToast,
} from './Utilities/utilFunctions';
import {
    syncDraftWithServer,
    loadDraftData,
    loadTextInputData,
} from './Utilities/FormDraftHandler';
import {
    InitializeFilePond,
    handleFilePondSelectorDisabling,
} from './Utilities/FilepondHandlers';
import APPLICATION_FORM_CONFIG from './Form_Config/APPLICATION_CONFIG';
import { TableDataExtractor } from './Utilities/TableDataExtractor';
import 'smartwizard/dist/css/smart_wizard_all.css';
import smartWizard from 'smartwizard';
window.smartWizard = smartWizard;

let is_initialized = false;
export function initializeForm() {
    new smartWizard();
    if (!is_initialized) {
        is_initialized = true;
    }

    const confirmButton = $('#confirmButton');
    confirmButton.off('click');

    const API_BASE_URL = 'https://psgc.gitlab.io/api';

    // Intent File
    const intentInstance = InitializeFilePond(
        'IntentFile',
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
    // Market Outlet Table Functions
    const toggleDeleteRowButton = (container, elementSelector) => {
        const element = container.find(elementSelector);
        const deleteRowButton = container.find('.removeRowButton');
        element.length === 1
            ? deleteRowButton.prop('disabled', true)
            : deleteRowButton.prop('disabled', false);
    };

    // Handle adding new rows
    $('.addNewProductRow').on('click', function () {
        const container = $(this).closest(
            '#localMarketContainer, #exportMarketContainer'
        );
        const table = container.find('table');

        const lastRow = table.find('tbody tr:last-child');
        const newRow = lastRow.clone();
        newRow.find('input').val('');
        newRow.find('select').prop('selectedIndex', 0);
        table.find('tbody').append(newRow);
        toggleDeleteRowButton(container, 'tbody tr');
    });

    // Handle removing rows
    $('.removeRowButton').on('click', function () {
        const container = $(this).closest(
            '#localMarketContainer, #exportMarketContainer'
        );
        const table = container.find('table');
        const lastRow = table.find('tbody tr:last-child');
        lastRow.remove();
        toggleDeleteRowButton(container, 'tbody tr');
    });

    $('input, select').focus(function () {
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
            extraHtml: `<button type="button" class="btn btn-success" onclick="onFinish()" >Submit</button> <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`,
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
            'IntentFile',
            'DtiSecCdafile',
            'businessPermitFile',
            'receiptFile',
            'govIdFile',
            'BIRFile',
        ];

        let isValid = true;

        requiredFileInputs.forEach((inputId) => {
            const fileInput = document.getElementById(inputId);
            if (!fileInput) {
                console.error(`File input not found: ${inputId}`);
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
            const pondInstance = FilePond.find(fileInput);

            console.log(`Checking ${inputId}:`, {
                fileInput,
                pondInstance: pondInstance ? 'exists' : 'not found',
                files: pondInstance ? pondInstance.getFiles().length : 'N/A',
            });

            // Check if no files are uploaded
            if (!pondInstance || pondInstance.getFiles().length === 0) {
                isValid = false;

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
                const landMark = $('#Landmark').val();
                const Barangay = 'Barangay ' + $('#barangay').val();
                const City = $('#city').val();
                const Province = $('#province').val();
                const Region = $('#region').val();

                $('#re_Address').val(
                    landMark +
                        ', ' +
                        Barangay +
                        ', ' +
                        City +
                        ', ' +
                        Province +
                        ', ' +
                        Region
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
            }
        }
    );
    function validateCurrentStep(stepIndex) {
        let isValid = true;
        const currentStep = $('#step-' + (stepIndex + 1)); // stepIndex is 0-based

        currentStep.find('input, select, textarea').each(function () {
            if (!this.checkValidity()) {
                $(this).addClass('is-invalid'); // Add invalid class for styling
                isValid = false;
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

    $(confirmTrueInfo)
        .add(confirmAgreeInfo)
        .on('change', function () {
            confirmButton.prop(
                'disabled',
                !$(confirmTrueInfo).is(':checked') ||
                    !$(confirmAgreeInfo).is(':checked')
            );
        });

    confirmButton.on('click', async function (event) {
        event.preventDefault();
        await submitForm();
    });

    async function submitForm() {
        showProcessToast('Submitting form...');
        try {
            let formDataObject = {};
            const form = $('#applicationForm').find(':input:not([readonly])');
            const updatedFormData = form.serializeArray();
            $.each(updatedFormData, function (i, v) {
                formDataObject[v.name] = v.value;
            });

            formDataObject = {
                ...formDataObject,
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
                'An error occurred while submitting the form'
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

    const populateSelect = (selectElement, data, placeholder) => {
        const parsedData = typeof data === 'string' ? JSON.parse(data) : data;
        $(selectElement).html(`<option value="">${placeholder}</option>`); // Clear options
        $.each(parsedData, (index, item) => {
            $(selectElement).append(
                `<option value="${item.name}" data-code="${item.code}">${item.name}</option>`
            );
        });
    };

    // Function to initialize region dropdown
    const initializeRegions = () => {
        const $regionSelect = $('#region');
        API.fetchRegions().done((regions) => {
            populateSelect($regionSelect, regions, 'Select Region');
        });
    };

    // Function to handle province update based on selected region
    const updateProvinces = () => {
        const $regionSelect = $('#region');
        const $provinceSelect = $('#province');
        const $citySelect = $('#city');
        const $barangaySelect = $('#barangay');

        const regionCode = $regionSelect.find(':selected').data('code');

        $provinceSelect.prop('disabled', !regionCode);
        $citySelect.prop('disabled', true);
        $barangaySelect.prop('disabled', true);

        populateSelect($provinceSelect, [], 'Select Province');
        populateSelect($citySelect, [], 'Select City');
        populateSelect($barangaySelect, [], 'Select Barangay');

        if (regionCode) {
            API.fetchProvinces(regionCode).done((provinces) => {
                populateSelect($provinceSelect, provinces, 'Select Province');
            });
        }
    };

    // Function to handle city update based on selected province
    const updateCities = () => {
        const $provinceSelect = $('#province');
        const $citySelect = $('#city');
        const $barangaySelect = $('#barangay');

        const provinceCode = $provinceSelect.find(':selected').data('code');

        $citySelect.prop('disabled', !provinceCode);
        $barangaySelect.prop('disabled', true);

        populateSelect($citySelect, [], 'Select City');
        populateSelect($barangaySelect, [], 'Select Barangay');

        if (provinceCode) {
            API.fetchCities(provinceCode).done((cities) => {
                populateSelect($citySelect, cities, 'Select City');
            });
        }
    };

    const updateBarangays = () => {
        const $citySelect = $('#city');
        const $barangaySelect = $('#barangay');

        const cityCode = $citySelect.find(':selected').data('code');

        $barangaySelect.prop('disabled', !cityCode);

        if (cityCode) {
            API.fetchBarangay(cityCode).done((barangays) => {
                populateSelect($barangaySelect, barangays, 'Select Barangay');
            });
        }
    };

    initializeRegions();
    $('#region').on('change', updateProvinces);
    $('#province').on('change', updateCities);
    $('#city').on('change', updateBarangays);

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

    let changedFields = {};
    let autoSaveTimeout;
    const DRAFT_TYPE = 'Application';
    const saveInterval = 5000; // 5 seconds

    $('#applicationForm :input:not([readonly])').on(
        'input change',
        function () {
            const fieldName = $(this).attr('name');
            const fieldValue = $(this).val();

            if (!fieldName) {
                return;
            }

            changedFields[fieldName] = fieldValue; // Track changes locally

            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                syncDraftWithServer(DRAFT_TYPE, changedFields);
            }, saveInterval);
            console.log(changedFields);
        }
    );

    $('#exportMarketTable tr, #localMarketTable tr').on(
        'input change',
        'input',
        function () {
            changedFields = { ...getMarketProductsData(tableConfigurations) };
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                syncDraftWithServer(DRAFT_TYPE, changedFields);
            }, saveInterval);
            console.log('this is triggered');
            console.log(changedFields);
        }
    );

    const FileMetaHiddenInputs = [
        'IntentFileID_Data_Handler',
        'DtiSecCdaFileID_Data_Handler',
        'BusinessPermitFileID_Data_Handler',
        'FdaLtoFileID_Data_Handler',
        'ReceiptFileID_Data_Handler',
        'GovIdFileID_Data_Handler',
        'BIRFileID_Data_Handler',
    ];

    /**
     * Monitors changes in hidden input fields containing file metadata and triggers an action to sync these changes with the server.
     * This function specifically targets hidden input fields that store information about uploaded files, such as file paths, unique IDs, and related metadata.
     * When changes are detected in these fields, it prepares an object containing the updated information and calls a function to save this data as a draft.
     *
     * @param {string[]} FileMetaHiddenInputs - An array of IDs for hidden input elements that store file metadata. Each ID corresponds to a specific type of document or file.
     *
     * @description
     * The function initializes a MutationObserver for each specified hidden input field. The MutationObserver listens for changes to the 'value' attribute of these inputs.
     * When a change is detected, it extracts relevant information such as the file path, unique ID, input name, and metadata details.
     * This information is then compiled into an object (`changedFields`) and passed to the `syncDraftWithServer` function to be saved as a draft.
     * This ensures that changes in file uploads are captured and persisted in a draft state.
     *
     * The `changedFields` object has the following structure:
     * ```js
     * {
     *   [META_DATA_HIDDEN_INPUT_NAME]: "file/path/string", // The name of the hidden input field, used as a key for the file path.
     *   [FILE_INPUT_NAME]: {  // The name of the associated file input field, used as a key for an object containing more details.
     *     filePath: "file/path/string", // The path of the uploaded file.
     *     uniqueId: "unique-identifier", // A unique identifier for the file.
     *     metaDataName: "META_DATA_HIDDEN_INPUT_NAME", // The name attribute of the hidden input.
     *     metaDataId: "META_DATA_ID" // The ID attribute of the hidden input.
     *   }
     * }
     * ```
     *
     * @example
     * // Example usage to monitor specific file input fields:
     * fileInputChange([
     *   'IntentFileID_Data_Handler',
     *   'DtiSecCdaFileID_Data_Handler',
     *   'BusinessPermitFileID_Data_Handler'
     * ]);
     *
     * @requires jQuery - A fast, small, and feature-rich JavaScript library for DOM manipulation.
     * @requires MutationObserver - A web API that provides a way to react to changes in the DOM.
     *
     * @global {string} DRAFT_TYPE - A global variable that defines the type of draft being saved (e.g., 'application', 'form').
     *
     * @fires syncDraftWithServer - This function is called to handle the actual saving of the draft data to the server.
     * The `changedFields` object is passed to this function along with the `DRAFT_TYPE`.
     * @see syncDraftWithServer - For details on how the draft data is processed and saved.
     */
    const fileInputChange = async (FileMetaHiddenInputs) => {
        FileMetaHiddenInputs.forEach((inputId) => {
            const inputElement = $(`#${inputId}`);

            // Use a MutationObserver to detect changes to the 'value' attribute
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (
                        mutation.type === 'attributes' &&
                        mutation.attributeName === 'value'
                    ) {
                        const META_DATA_HIDDEN_INPUT_NAME =
                            inputElement.attr('name');
                        const META_DATA_ID = inputElement.attr('id');
                        const filePath = inputElement.val();
                        const FILE_INPUT_NAME = inputElement.attr(
                            'data-file-input-name'
                        );
                        const uniqueId = inputElement.attr('data-unique-id');
                        console.log(
                            `Hidden input ${inputId} changed to: ${filePath} with unique ID: ${uniqueId}`
                        );
                        const changedFields = {
                            [META_DATA_HIDDEN_INPUT_NAME]: filePath,
                            [FILE_INPUT_NAME]: {
                                filePath: filePath,
                                uniqueId: uniqueId,
                                metaDataName: META_DATA_HIDDEN_INPUT_NAME,
                                metaDataId: META_DATA_ID,
                            },
                        };
                        syncDraftWithServer(DRAFT_TYPE, changedFields);
                    }
                });
            });

            // Start observing the input element for changes to its attributes
            observer.observe(inputElement[0], { attributes: true });
        });
    };

    const loadApplicationFormInputFields = (draftData, formSelector) => {
        const excludedFields = [
            'exportMarket',
            'localMarket',
            'region',
            'province',
            'city',
            'barangay',
        ];
        loadTextInputData(draftData, formSelector, excludedFields);
    };

    const loadLocationDropdown = async (
        selector,
        fetchFn,
        data,
        placeholder
    ) => {
        return new Promise((resolve) => {
            fetchFn.done((items) => {
                populateSelect($(selector), items, placeholder);
                $(selector).val(data);
                $(selector).prop('disabled', false);
                resolve();
            });
        });
    };

    const loadAddressDropdowns = async (draftData) => {
        if (!draftData.region) return;

        // Load regions
        await loadLocationDropdown(
            '#region',
            API.fetchRegions(),
            draftData.region,
            'Select Region'
        );

        if (!draftData.province) return;

        // Load provinces
        const regionCode = $('#region').find(':selected').data('code');
        await loadLocationDropdown(
            '#province',
            API.fetchProvinces(regionCode),
            draftData.province,
            'Select Province'
        );

        if (!draftData.city) return;

        // Load cities
        const provinceCode = $('#province').find(':selected').data('code');
        await loadLocationDropdown(
            '#city',
            API.fetchCities(provinceCode),
            draftData.city,
            'Select City'
        );

        if (!draftData.barangay) return;

        // Load barangays
        const cityCode = $('#city').find(':selected').data('code');
        await loadLocationDropdown(
            '#barangay',
            API.fetchBarangay(cityCode),
            draftData.barangay,
            'Select Barangay'
        );
    };

    const loadFilePondDraftFile = (FilepondInstances) => {};

    (async () => {
        await loadDraftData(
            DRAFT_TYPE,
            APPLICATION_FORM_CONFIG,
            loadApplicationFormInputFields,
            null,
            null,
            loadAddressDropdowns
        );
        await fileInputChange(FileMetaHiddenInputs);
        updateEnterpriseLevel();
    })();
}

initializeForm();
