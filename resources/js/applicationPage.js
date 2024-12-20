import {
    showToastFeedback,
    showProcessToast,
    hideProcessToast,
} from './ReusableJS/utilFunctions';
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
    //IntentFile upload pond
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content');
    const baseFilePondConfig = {
        allowMultiple: false,
        allowFileTypeValidation: true,
        allowFileSizeValidation: true,
        allowRevert: true,
        maxFileSize: '10MB',
        server: {
            process: {
                url: '/FileRequirementsUpload',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                onload: (response) => {
                    // Common onload logic will be handled later
                },
                onerror: (response) => {
                    console.error('File upload error:', response);
                },
            },
            revert: (uniqueFileId, load, error) => {
                // Common revert logic will be handled later
            },
        },
    };

    function initializeFilePond(
        elementId,
        options,
        hiddenInputName,
        hiddenInputId,
        selectorId = null
    ) {
        const element = document.getElementById(elementId);
        if (!element) {
            console.error(`Element with ID '${elementId}' not found.`);
            return null;
        }

        const config = {
            ...baseFilePondConfig,
            ...options,
            server: {
                ...baseFilePondConfig.server,
                process: {
                    ...baseFilePondConfig.server.process,
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_path) {
                            element.setAttribute(
                                'data-unique-id',
                                data.unique_id
                            );
                            document.querySelector(
                                `input[name="${hiddenInputName}"][id="${hiddenInputId}"]`
                            ).value = data.file_path;
                            element.setAttribute(
                                'data-file-path',
                                data.file_path
                            );

                            if (selectorId) {
                                document
                                    .getElementById(selectorId)
                                    .classList.add('disabled');
                            }
                        }
                        return data.unique_id;
                    },
                },
                revert: (uniqueFileId, load, error) => {
                    const filePath = element.getAttribute('data-file-path');
                    const unique_id = element.getAttribute('data-unique-id');

                    fetch(`/FileRequirementsRevert/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            file_path: filePath,
                        }),
                    })
                        .then((response) => {
                            if (response.ok) {
                                load();
                            } else {
                                error('Could not revert file');
                            }
                        })
                        .catch(() => {
                            error('Could not revert file');
                        });
                },
            },
        };

        return FilePond.create(element, config);
    }

    function handleFilePondSelectorDisabling(selectorId, filePondInstance) {
        const selector = document.getElementById(selectorId);
        if (!selector) return;

        const checkAndDisable = () => {
            filePondInstance.disabled = selector.value === '';
        };

        checkAndDisable();
        selector.addEventListener('change', checkAndDisable);
    }

    // Intent File
    initializeFilePond(
        'IntentFile',
        { acceptedFileTypes: ['application/pdf'] },
        'Intent_unique_id_path',
        'IntentFileID_path'
    );

    // DTI/SEC/CDA File
    const dtiSecCdaInstance = initializeFilePond(
        'DtiSecCdafile',
        { acceptedFileTypes: ['application/pdf'] },
        'DTI_SEC_CDA_unique_id_path',
        'DtiSecCdaFileID_path',
        'DtiSecCdaSelector'
    );

    // Business Permit File
    initializeFilePond(
        'businessPermitFile',
        { acceptedFileTypes: ['application/pdf'] },
        'BusinessPermit_unique_id_path',
        'businessPermitFileID_path'
    );

    // FDA LTO File
    const fdaLtoInstance = initializeFilePond(
        'fdaLtoFile',
        { acceptedFileTypes: ['application/pdf'] },
        'FDA_LTO_unique_id_path',
        'fdaLtoFileID_path',
        'fdaLtoSelector'
    );

    // Receipt File
    initializeFilePond(
        'receiptFile',
        { acceptedFileTypes: ['application/pdf'] },
        'receipt_unique_id_path',
        'receiptFileID_path'
    );

    // Government ID File
    const govIdInstance = initializeFilePond(
        'govIdFile',
        { acceptedFileTypes: ['image/png', 'image/jpeg'], captureMethod: 'environment' },
        'govId_unique_id_path',
        'govIdFileID_path',
        'GovIdSelector'
    );

    // BIR File
    initializeFilePond(
        'BIRFile',
        { acceptedFileTypes: ['application/pdf'] },
        'BIR_unique_id_path',
        'BIRFileID_path'
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
        .change(function () {
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
                ...storeMarketProductsData(),
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

    const storeMarketProductsData = function () {
        const exportMarketData = [];
        const localMarketData = [];

        // Get data from Export Market table
        $('#exportMarketTable tbody tr').each(function () {
            const row = $(this);
            const exportData = {
                location: row.find('.location').val(),
                product: row.find('.product').val(),
                volume: row.find('.volume').val(),
                unit: row.find('.unit').val(),
            };

            if (exportData.product && exportData.product !== null) {
                exportMarketData.push(exportData);
            }
        });

        // Get data from Local Market table
        $('#localMarketTable tbody tr').each(function () {
            const row = $(this);
            const localData = {
                location: row.find('.location').val(),
                product: row.find('.product').val(),
                volume: row.find('.volume').val(),
                unit: row.find('.unit').val(),
            };

            if (localData.product && localData.product !== null) {
                localMarketData.push(localData);
            }
        });

        return {
            exportMarket: exportMarketData,
            localMarket: localMarketData,
        };
    };

    let changedFields = {};
    let autoSaveTimeout;
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
            autoSaveTimeout = setTimeout(syncDraftWithServer, saveInterval);
            console.log(changedFields);
        }
    );

    $('#exportMarketTable tr, #localMarketTable tr').on(
        'input change',
        'input',
        function () {
            changedFields = { ...storeMarketProductsData() };
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(syncDraftWithServer, saveInterval);
            console.log('this is triggered');
            console.log(changedFields);
        }
    );

    async function syncDraftWithServer() {
        if ($.isEmptyObject(changedFields)) return;
        const DRAFT_TYPE = 'Application';

        const requestData = {
            ...changedFields,
            ...storeMarketProductsData(),
            draft_type: DRAFT_TYPE,
        };

        try {
            const response = await $.ajax({
                type: 'POST',
                url: DRAFT_ROUTE.STORE,
                data: JSON.stringify(requestData),
                contentType: 'application/json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });

            if (response.success) {
                console.log('Draft saved successfully:', response.message);
                changedFields = {}; // Clear changes after saving
            }
        } catch (error) {
            console.error('Error saving draft:', error);
        }
    }

    const loadSimpleFields = (draftData) => {
        const excludedFields = [
            'exportMarket',
            'localMarket',
            'region',
            'province',
            'city',
            'barangay',
        ];
        $.each(draftData, (key, value) => {
            if (!excludedFields.includes(key)) {
                $(`[name="${key}"]`).val(value);
            }
        });
    };

    const loadMarketTables = (draftData) => {
        if (draftData.exportMarket) {
            $.each(draftData.exportMarket, (_, rowData) => {
                addRowToTable('#exportMarketTable', rowData);
            });
        }

        if (draftData.localMarket) {
            $.each(draftData.localMarket, (_, rowData) => {
                addRowToTable('#localMarketTable', rowData);
            });
        }
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

    // Main draft loading function
    const loadDraftData = async () => {
        console.log('Retrieving the form draft');
        try {
            const response = await $.ajax({
                type: 'GET',
                url: DRAFT_ROUTE.GET.replace(':type', 'Application'),
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });

            if (response.success && response.draftData) {
                const draftData = response.draftData;

                // Load form data in sequence
                loadSimpleFields(draftData);
                loadMarketTables(draftData);
                await loadAddressDropdowns(draftData);

                console.log('Draft loaded:', draftData);
            }
        } catch (error) {
            console.error('Error loading draft:', error);
        }
    };

    // Initialize draft loading
    (async () => {
        await loadDraftData();
    })();
    // Helper function to add rows to a table
    function addRowToTable(tableSelector, rowData) {
        const tableBody = $(tableSelector).find('tbody');
        const newRow = `
        <tr>
            <td><input type="text" class="form-control location" value="${
                rowData.location || ''
            }" /></td>
            <td><input type="text" class="form-control product" value="${
                rowData.product || ''
            }" /></td>
            <td><input type="text" class="form-control volume" value="${
                rowData.volume || ''
            }" /></td>
            <td><input type="text" class="form-control unit" value="${
                rowData.unit || ''
            }" /></td>
        </tr>
    `;
        tableBody.append(newRow);
    }
}

initializeForm();
