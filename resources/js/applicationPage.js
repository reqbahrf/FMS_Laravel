import "smartwizard/dist/css/smart_wizard_all.css";
import smartWizard from 'smartwizard';
window.smartWizard = smartWizard;

export function initializeForm() {

     new smartWizard();


        const API_BASE_URL = 'https://psgc.gitlab.io/api';
        //IntentFile upload pond
        const IntentFile = document.getElementById('IntentFile');
        FilePond.create(IntentFile, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['application/pdf'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="Intent_unique_id_path"][id="IntentFileID_path"]')
                                .value = data
                                .file_paths.IntentFile;
                            IntentFile.setAttribute('data-unique-id', data.unique_id);

                            // Update the file path for the IntentFile
                            const IntentFilePath = data.file_paths.IntentFile;
                            if (IntentFilePath) {
                                // Update the file path in the file upload element
                                IntentFile.setAttribute('data-file-path', IntentFilePath);
                                console.log(IntentFile);
                            }
                        }

                        // Return the unique file ID that FilePond will use to track the file
                        return data.unique_id;
                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const IntentFilePath = IntentFile.getAttribute('data-file-path');
                    const unique_id = IntentFile.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', IntentFilePath, 'and unique ID:',
                        unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: IntentFilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }
        });

        //DTI File upload
        const DTI_SEC_CDA_File = document.getElementById('DtiSecCdafile');
        const DTI_SEC_CDA_instance = FilePond.create(DTI_SEC_CDA_File, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['application/pdf'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="DTI_SEC_CDA_unique_id_path"][id="DtiSecCdaFileID_path"]'
                                )
                                .value = data
                                .file_paths.DTI_SEC_CDA_File;
                            DTI_SEC_CDA_File.setAttribute('data-unique-id', data.unique_id);
                            console.log(DTI_SEC_CDA_File);

                            // Update the file path for the dtiFile
                            const dtiSecCdaFilePath = data.file_paths.DTI_SEC_CDA_File;
                            console.log(dtiSecCdaFilePath);
                            if (dtiSecCdaFilePath) {
                                // Update the file path in the file upload element
                                DTI_SEC_CDA_File.setAttribute('data-file-path', dtiSecCdaFilePath);
                                if (DTI_SEC_CDA_File) {
                                    document.getElementById('DtiSecCdaSelector').classList.add(
                                        'disabled');
                                }
                                console.log(dtiSecCdaFilePath);
                            }
                        }

                        // Return the unique file ID that FilePond will use to track the file
                        return data.unique_id;
                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const dSC_FilePath = DTI_SEC_CDA_File.getAttribute('data-file-path');
                    const unique_id = DTI_SEC_CDA_File.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', dSC_FilePath, 'and unique ID:',
                        unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: dSC_FilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }
        })

        const DTI_SEC_CDA_file_Selector = document.getElementById('DtiSecCdaSelector');

        function checkDTI_SEC_CDA_fileValue() {
            if (DTI_SEC_CDA_file_Selector.value === '') {
                DTI_SEC_CDA_instance.disabled = true;
            } else {
                DTI_SEC_CDA_instance.disabled = false;
            }
        }
        checkDTI_SEC_CDA_fileValue();
        DTI_SEC_CDA_file_Selector.addEventListener('change', checkDTI_SEC_CDA_fileValue);

        const businessPermitFile = document.getElementById('businessPermitFile');
        FilePond.create(businessPermitFile, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['application/pdf'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="BusinessPermit_unique_id_path"][id="businessPermitFileID_path"]'
                                ).value =
                                data
                                .file_paths.businessPermitFile;
                            businessPermitFile.setAttribute('data-unique-id', data.unique_id);

                            // Update the file path for the dtiFile
                            const BusinessPermitFilePath = data.file_paths.businessPermitFile;
                            if (BusinessPermitFilePath) {
                                // Update the file path in the file upload element
                                businessPermitFile.setAttribute('data-file-path',
                                    BusinessPermitFilePath);
                                console.log(BusinessPermitFilePath);
                            }
                        }

                        // Return the unique file ID that FilePond will use to track the file
                        return data.unique_id;
                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const BusinessPermitFilePath = businessPermitFile.getAttribute(
                        'data-file-path');
                    const unique_id = businessPermitFile.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', BusinessPermitFilePath,
                        'and unique ID:', unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: BusinessPermitFilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }
        })

        const fdaLtoFile = document.getElementById('fdaLtoFile');
        const fdaLto_instance = FilePond.create(fdaLtoFile, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['application/pdf'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="FDA_LTO_unique_id_path"][id="fdaLtoFileID_path"]')
                                .value = data
                                .file_paths.fdaLtoFile;
                            fdaLtoFile.setAttribute('data-unique-id', data.unique_id);
                            console.log(fdaLtoFile);

                            // Update the file path for the dtiFile
                            const fdaLtoFilePath = data.file_paths.fdaLtoFile;
                            console.log(fdaLtoFilePath);
                            if (fdaLtoFilePath) {
                                // Update the file path in the file upload element
                                fdaLtoFile.setAttribute('data-file-path', fdaLtoFilePath);
                                if (fdaLtoFile) {
                                    console.log(fdaLtoFilePath);
                                    document.getElementById('fdaLtoSelector').classList.add(
                                        'disabled');
                                }
                                console.log(fdaLtoFilePath);
                            }
                        }

                        // Return the unique file ID that FilePond will use to track the file
                        return data.unique_id;
                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const fdaLtoFilePath = fdaLtoFile.getAttribute('data-file-path');
                    const unique_id = fdaLtoFile.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', fdaLtoFilePath, 'and unique ID:',
                        unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: fdaLtoFilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }
        })


        const fda_lto_select = document.getElementById('fdaLtoSelector');

        function checkFdalto() {
            if (fda_lto_select.value === '') {
                fdaLto_instance.disabled = true;
            } else {
                fdaLto_instance.disabled = false;
            }
        }
        checkFdalto()
        fda_lto_select.addEventListener('change', checkFdalto);

        const receiptFile = document.getElementById('receiptFile');
        FilePond.create(receiptFile, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['application/pdf'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="receipt_unique_id_path"][id="receiptFileID_path"]')
                                .value = data
                                .file_paths.receiptFile;
                            receiptFile.setAttribute('data-unique-id', data.unique_id);

                            // Update the file path for the dtiFile
                            const receiptFilePath = data.file_paths.receiptFile;
                            if (receiptFilePath) {
                                // Update the file path in the file upload element
                                receiptFile.setAttribute('data-file-path', receiptFilePath);
                                console.log(receiptFilePath);
                            }
                        }

                        // Return the unique file ID that FilePond will use to track the file
                        return data.unique_id;
                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const receiptFilePath = receiptFile.getAttribute('data-file-path');
                    const unique_id = receiptFile.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', receiptFilePath, 'and unique ID:',
                        unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: receiptFilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }
        })

        const govIdFile = document.getElementById('govIdFile');
        const govId_instance = FilePond.create(govIdFile, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['image/png', 'image/jpeg'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="govId_unique_id_path"][id="govIdFileID_path"]')
                                .value = data
                                .file_paths.govIdFile;
                            govIdFile.setAttribute('data-unique-id', data.unique_id);

                            // Update the file path for the dtiFile
                            const govIdFilePath = data.file_paths.govIdFile;
                            if (govIdFilePath) {
                                // Update the file path in the file upload element
                                govIdFile.setAttribute('data-file-path', govIdFilePath);
                                console.log(govIdFilePath);
                                document.getElementById('GovIdSelector').classList.add('disabled');
                            }
                        }

                        // Return the unique file ID that FilePond will use to track the file
                        return data.unique_id;


                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const govIdFilePath = govIdFile.getAttribute('data-file-path');
                    const unique_id = govIdFile.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', govIdFilePath, 'and unique ID:',
                        unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: govIdFilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }

        })

        const govId_select = document.getElementById('GovIdSelector');
        function checkGovId(){
            if(govId_select.value === ''){
                govId_instance.disabled = true;
            }else{
                govId_instance.disabled = false;
            }
        }
        checkGovId()
        govId_select.addEventListener('change', checkGovId);

        const BIR = document.getElementById('BIRFile');
        FilePond.create(BIR, {
            allowMultiple: false,
            allowFileTypeValidation: true,
            allowFileSizeValidation: true,
            acceptedFileTypes: ['application/pdf'],
            allowRevert: true,
            maxFileSize: '10MB',
            server: {
                process: {
                    url: '/requirements/submit',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    onload: (response) => {
                        const data = JSON.parse(response);
                        if (data.unique_id && data.file_paths) {
                            // Store unique_id in a hidden input field or as a data attribute
                            document.querySelector(
                                    'input[name="BIR_unique_id_path"][id="BIRFileID_path"]')
                                .value = data
                                .file_paths.BIRFile;
                            BIR.setAttribute('data-unique-id', data.unique_id);

                            // Update the file path for the dtiFile
                            const BIRFilePath = data.file_paths.BIRFile;
                            if (BIRFilePath) {
                                // Update the file path in the file upload element
                                BIR.setAttribute('data-file-path', BIRFilePath);
                                console.log(BIRFilePath);
                            }
                        }

                        return data.unique_id;
                    },
                    onerror: (response) => {
                        // Handle error response
                        console.error('File upload error:', response);
                    }
                },
                revert: (uniqueFileId, load, error) => {
                    const BIRFilePath = BIR.getAttribute('data-file-path');
                    const unique_id = BIR.getAttribute('data-unique-id');

                    console.log('Reverting file with path:', BIRFilePath, 'and unique ID:',
                        unique_id);

                    fetch(`/delete/file/${unique_id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            file_path: BIRFilePath
                        })
                    }).then(response => {
                        if (response.ok) {
                            load(); // Indicate that the revert was successful
                        } else {
                            error('Could not revert file');
                        }
                    }).catch(() => {
                        error('Could not revert file');
                    });
                }

            }

        })

        $('input, select').focus(function() {
            if ($(this).attr('required')) {
                $(this).removeClass('is-invalid');
            }
        });

        const smartWizardInstance = $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            autoAdjustHeight: false,
            transition: {
                animation: 'fade'
            },
            toolbar: {
                toolbarPosition: 'bottom',
                toolbarButtonPosition: 'right',
                showNextButton: true,
                showPreviousButton: true,
                position: 'both bottom',
                extraHtml: `<button type="button" class="btn btn-success" onclick="onFinish()" >Submit</button> <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
            },
            anchorSettings: {
                anchorClickable: false
            }
        });

        function validateCurrentStep(stepIndex) {
            const currentStep = $('#step-' + (stepIndex + 1));
            const requiredInputs = currentStep.find('input[required], select[required], textarea[required]');
            let isValid = true;

            requiredInputs.each(function() {
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
                'BIRFile'
            ];

            let isValid = true;

            requiredFileInputs.forEach(inputId => {
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
                const invalidFeedback = parentDiv ? 
                    parentDiv.querySelector('.invalid-feedback') || 
                    document.createElement('div') : 
                    null;

                if (!invalidFeedback) {
                    // Create invalid feedback if it doesn't exist
                    invalidFeedback = document.createElement('div');
                    invalidFeedback.classList.add('invalid-feedback');
                    invalidFeedback.textContent = `Please upload ${inputId.replace('File', '')} file`;
                    parentDiv.appendChild(invalidFeedback);
                }
                
                // Get the FilePond instance
                const pondInstance = FilePond.find(fileInput);
                
                console.log(`Checking ${inputId}:`, {
                    fileInput, 
                    pondInstance: pondInstance ? 'exists' : 'not found', 
                    files: pondInstance ? pondInstance.getFiles().length : 'N/A'
                });

                // Check if no files are uploaded
                if (!pondInstance || pondInstance.getFiles().length === 0) {
                    isValid = false;
                    
                    // Show invalid feedback
                    invalidFeedback.style.display = 'block';
                    invalidFeedback.textContent = `Please upload ${inputId.replace('File', '')} file`;
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

        smartWizardInstance.on('leaveStep', function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
            console.log('Leave Step', currentStepIndex, nextStepIndex, stepDirection);

            if (nextStepIndex > currentStepIndex) {
                // Combine regular input and file upload validation
                const regularInputsValid = validateCurrentStep(currentStepIndex);
                const fileUploadsValid = validateFileUploads();

                if (!regularInputsValid || !fileUploadsValid) {
                    e.preventDefault();
                    return false;
                }
            }
        });

        smartWizardInstance.on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
            const totalSteps = $('#smartwizard').find('ul li').length;

            if (stepPosition != "Last") {
                $('.btn-success, .btn-secondary').hide();
            }

            if (stepIndex === totalSteps - 1 && stepPosition === 'last') {
                console.log("Arriving at Last Step - Showing Buttons");

            } else {
                console.log("Not Arriving at Last Step - Hiding Buttons");
                $('.btn-success, .btn-secondary').hide();
            }
            if (stepIndex === 3) { // Since stepIndex is 0-based, step-4 corresponds to index 3
                $('.btn-success, .btn-secondary').show();

                let fullName = $('#prefix').val() + ' ' + $('#f_name').val() + ' ' + $('#middle_name')
                    .val() + ' ' + $('#l_name').val() + ' ' + $('#suffix').val();

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

                $('#re_Address').val(landMark + ', ' + Barangay + ', ' + City + ', ' + Province + ', ' +
                    Region);
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

        });
        function validateCurrentStep(stepIndex) {
            let isValid = true;
            const currentStep = $('#step-' + (stepIndex + 1)); // stepIndex is 0-based

            currentStep.find('input, select, textarea').each(function() {
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

        window.onFinish = function(event) {
            event.preventDefault();
            window.confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }

        const confirmTrueInfo = $('input[type="checkbox"]#detail_confirm');
        const confirmAgreeInfo = $('input[type="checkbox"]#agree_terms');

        const confirmButton = document.getElementById('confirmButton');

        confirmTrueInfo.add(confirmAgreeInfo).change(function() {
            confirmButton.disabled = !(confirmTrueInfo.is(':checked') && confirmAgreeInfo.is(':checked'));
        });

        confirmButton.addEventListener('click', function(event) {
            event.preventDefault();
            submitForm();
        });

        function submitForm() {

            $.ajax({
                type: 'POST',
                url: REGISTRATIONFORM_SUBMISSION_ROUTE,
                data: $('#applicationForm').find(':input:not([readonly])').serialize(),
                success: function(response) {
                    // Handle the response from the server
                    console.log('Form submitted successfully', response);
                    const message = response.success;

                    confirmationModal.hide();

                    if (response.success) {
                        setTimeout(() => {
                            const toastElement = document.getElementById('successToast');
                            const toast = new bootstrap.Toast(toastElement);
                            toast.show();
                        }, 500);

                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 3000);
                    }

                    // Display the toast
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error('Error submitting form', error);
                }
            });
        }

        function onCancel() {
            console.log("Form cancelled");
            window.location.href = 'some_cancel_url'; // Redirect to a specific URL
        }
            $('#Mobile_no').on('keypress', function(e) {
                const charCode = (e.which) ? e.which : e.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }).on('input', function() {
                const number = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                if (number.length > 0) {
                    var formattedNumber = number.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
                    var formatted = '';
                    if (formattedNumber[1]) formatted += formattedNumber[1];
                    if (formattedNumber[2]) formatted += '-' + formattedNumber[2];
                    if (formattedNumber[3]) formatted += '-' + formattedNumber[3];
                    $(this).val(formatted);
                }
            });

            const formatNumber = (input) => {
                    let value = input.value.replace(/,/g, ''); // Remove existing commas
                    value = value.replace(/[^\d.]/g,
                        ''); // Remove non-numeric characters except for decimal point
                    value = value.replace(/(\.\d{2})\d+$/, '$1'); // Limit decimal points to 2

                    // Add commas every 3 digits
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                    input.value = value;
                };

            $('.num_only').on('input', function() {
                const input = $(this);
                const value = input.val().replace(/[^0-9.]/g, '');
                input.val(value);
            });

            function updateEnterpriseLevel() {

                $('#buildings, #equipments, #working_capital').each(function() {
                    formatNumber($(this)[0]);
                });

                const buildingsValue = parseFloat($('#buildings').val().replace(/,/g, '')) || 0;
                const equipmentsValue = parseFloat($('#equipments').val().replace(/,/g, '')) || 0;
                const workingCapitalValue = parseFloat($('#working_capital').val().replace(/,/g, '')) || 0;
                const total = buildingsValue + equipmentsValue + workingCapitalValue;
                $('#to_Assets').text(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
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

            $('#buildings, #equipments, #working_capital').on('input', updateEnterpriseLevel);

        $('textarea').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        $('textarea[readonly]').each(function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });


        $('#Export, #Local').on('input', function() {
            if (this.scrollHeight > this.clientHeight) {
                $('#smartwizard').smartWizard('fixHeight');
            }
        });

        window.fetchRegions = function() {
            fetch(`${API_BASE_URL}/regions/`)
                .then(response => response.json())
                .then(data => {
                    const regionSelect = document.getElementById("region");
                    data.forEach(region => {
                        const option = document.createElement("option");
                        option.value = region.name;
                        option.textContent = region.name;
                        option.dataset.code = region.code;
                        regionSelect.appendChild(option);
                    });
                });
        }

        window.updateProvinces = function() {
            const regionSelect = document.getElementById("region");
            const selectedRegionOption = regionSelect.options[regionSelect.selectedIndex];
            const provinceSelect = document.getElementById("province");
            const citySelect = document.getElementById("city");
            const barangaySelect = document.getElementById("barangay");

            if (regionSelect.value) {
                provinceSelect.disabled = false;
            } else {
                provinceSelect.disabled = true;
                citySelect.disabled = true;
                barangaySelect.disabled = true;
            }

            provinceSelect.innerHTML = '<option value="">Select Province</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const selectedRegionCode = selectedRegionOption.dataset.code;
            if (selectedRegionCode) {
                fetch(`${API_BASE_URL}/regions/${selectedRegionCode}/provinces/`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(province => {
                            const option = document.createElement("option");
                            option.value = province.name;
                            option.textContent = province.name;
                            option.dataset.code = province.code;
                            provinceSelect.appendChild(option);
                        });
                    });
            }
        }

        window.updateCities = function() {
            const provinceSelect = document.getElementById("province");
            const selectedProvinceOption = provinceSelect.options[provinceSelect.selectedIndex];
            const citySelect = document.getElementById("city");
            const barangaySelect = document.getElementById("barangay");

            if (provinceSelect.value) {
                citySelect.disabled = false;
            } else {
                citySelect.disabled = true;
                barangaySelect.disabled = true;
            }

            citySelect.innerHTML = '<option value="">Select City</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const selectedProvinceCode = selectedProvinceOption.dataset.code;
            if (selectedProvinceCode) {
                fetch(`${API_BASE_URL}/provinces/${selectedProvinceCode}/cities-municipalities/`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(city => {
                            const option = document.createElement("option");
                            option.value = city.name;
                            option.textContent = city.name;
                            option.dataset.code = city.code;
                            citySelect.appendChild(option);
                        });
                    });
            }
        }

        window.updateBarangays = function() {
            const citySelect = document.getElementById("city");
            const selectedCityOption = citySelect.options[citySelect.selectedIndex];
            const barangaySelect = document.getElementById("barangay");

            if (citySelect.value) {
                barangaySelect.disabled = false;
            } else {
                barangaySelect.disabled = true;
            }

            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const selectedCityCode = selectedCityOption.dataset.code;
            if (selectedCityCode) {
                fetch(`${API_BASE_URL}/cities-municipalities/${selectedCityCode}/barangays/`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(barangay => {
                            const option = document.createElement("option");
                            option.value = barangay.name;
                            option.textContent = barangay.name;
                            option.dataset.code = barangay.code;
                            barangaySelect.appendChild(option);
                        });
                    });
            }
        }

        fetchRegions();
}

initializeForm();
