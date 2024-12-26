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
    revert: async (uniqueFileId, load, error) => {
        // Common revert logic will be handled later
    },
},
};

/**
 * @function initializeFilePond
 * @description Initializes a FilePond instance with custom configurations for file uploading,
 * reverting, and loading. It integrates with hidden input fields for metadata management and
 * provides server-side interaction for file processing and deletion.
 *
 * @param {string} elementId - The ID of the HTML input element to be transformed into a FilePond instance.
 * @param {Object} options - Custom options to merge with the base FilePond configuration. See {@link https://pqina.nl/filepond/docs/api/instance/properties/|FilePond Documentation} for available options.
 * @param {string} hiddenInputId - The ID of the hidden input element used to store file metadata (e.g., unique ID, file path, input name).
 * @param {string|null} [selectorId=null] - Optional. The ID of an element to be disabled after a successful file upload.
 *
 * @returns {FilePond|null} Returns the initialized FilePond instance, or null if the element with the given `elementId` is not found.
 *
 * @throws {Error} Logs an error to the console if the element with the given `elementId` is not found.
 *
 * @fires FilePond#process - Dispatched when a file is successfully processed.
 * @fires FilePond#revert - Dispatched when a file revert (deletion) is requested.
 * @fires FilePond#load - Dispatched when a file is requested to be loaded.
 * @fires FilePond#removefile - Dispatched when a file is removed from the list.
 *
 * @example
 * // Initialize FilePond for an element with ID 'myFileInput'
 * const pond = InitializeFilePond(
 *     'myFileInput',
 *     {
 *         acceptedFileTypes: ['image/jpeg', 'image/png'],
 *         maxFileSize: '2MB',
 *     },
 *     'myHiddenInput',
 *     'myFileNameSelector'
 * );
 *
 * @requires FilePond - The core FilePond library.
 * @requires baseFilePondConfig - A global object containing the base configuration for FilePond instances.
 * @requires csrfToken - A global variable containing the CSRF token for server requests.
 *
 * @property {Object} server - Server configuration object for FilePond.
 * @property {Object} server.process - Configuration for processing uploaded files.
 * @property {string} server.process.url - The URL to which files are uploaded.
 * @property {string} server.process.method - The HTTP method used for file uploads (e.g., 'POST').
 * @property {Object} server.process.headers - Custom headers to include in the upload request.
 * @property {Function} server.process.onload - Callback function triggered when a file is successfully uploaded. It receives the server response and updates hidden input fields and element attributes with file metadata.
 * @property {Function} server.process.onerror - Callback function triggered when a file upload fails.
 * @property {Function} server.revert - Callback function triggered when a file revert (deletion) is requested. It sends a DELETE request to the server to remove the file and updates the hidden input fields accordingly.
 * @property {Function} server.load - Callback function triggered when a file is requested to be loaded (e.g., when loading a previously uploaded file). It fetches the file data from the server and passes it to FilePond.
 * @property {Function} onremovefile - Callback function triggered when a file is removed from the FilePond instance. It sends a DELETE request to the server to delete the file and updates associated hidden input fields.
 */
function InitializeFilePond(
    elementId,
    options,
    hiddenInputId,
    selectorId = null
) {
    const element = document.getElementById(elementId);
    const elementName = element.name;
    const metaDataHandler = document.querySelector(
        `input[type="hidden"][id="${hiddenInputId}"]`
    );
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
                        metaDataHandler.value = data.file_path;
                        metaDataHandler.setAttribute(
                            'data-unique-id',
                            data.unique_id
                        );
                        metaDataHandler.setAttribute(
                            'data-file-input-name',
                            elementName
                        );
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
            revert: async (uniqueFileId, load, error) => {
                const filePath = element.getAttribute('data-file-path');
                const unique_id = element.getAttribute('data-unique-id');

                try {
                    const response = await fetch(
                        `/FileRequirementsRevert/${unique_id}`,
                        {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                file_path: filePath,
                            }),
                        }
                    );

                    if (response.ok) {
                        load();
                        metaDataHandler.value = '';
                        metaDataHandler.setAttribute(
                            'data-unique-id',
                            ''
                        );
                    } else {
                        error('Could not revert file');
                    }
                } catch (err) {
                    error('Could not revert file');
                }
            },
            load: async (source, load, error, progress, abort, headers) => {
                try {
                    const response = await fetch(source);
                    if (response.ok) {
                        const BlobData = await response.blob();
                        load(BlobData);
                    }
                } catch (error) {
                    console.error('Error loading file:', error);
                }
            },
        },
        onremovefile: async (error, file) => {
            const filePath = file.getMetadata('file_path');
            const unique_id = file.getMetadata('unique_id');
            const fileInputName = file.getMetadata('file_input_name');
            const metaDataHandlerID = file.getMetadata('meta_data_handler_id');
            const oldMEtaDataHandler = document.querySelector(
                `input[type="hidden"][id="${metaDataHandlerID}"]`
            );
            if(unique_id) {
                try {
                    const response = await fetch(`/FileRequirementsRevert/${unique_id}`,
                        {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                file_path: filePath,
                            }),
                        })
                    if(response.ok) {
                        oldMEtaDataHandler.value = '';
                        oldMEtaDataHandler.setAttribute(
                            'data-unique-id',
                            ''
                        );
                        oldMEtaDataHandler.setAttribute(
                            'data-file-input-name',
                            fileInputName
                        );
                    }
                    else {
                        console.error('Failed to delete file:', response.statusText);
                    }
                } catch (error) {
                    console.error('Error deleting file:', error);
                }
            }
            return true;
        }
    };

    return FilePond.create(element, config);
}


/**
 * @function handleFilePondSelectorDisabling
 * @description Manages the disabled state of a FilePond instance based on the value of a selector (e.g., a select dropdown).
 * The FilePond instance will be disabled if the selector's value is empty and enabled otherwise.
 * It also adds an event listener to the selector to re-evaluate the disabled state whenever the selector's value changes.
 *
 * @param {string} selectorId - The ID of the selector element (e.g., a <select> element).
 * @param {FilePond} filePondInstance - The FilePond instance to be enabled or disabled.
 *
 * @returns {void}
 *
 * @throws {Error} Does not throw an error but will silently return if the selector element with the given `selectorId` is not found.
 *
 * @example
 * // Assuming you have a select element with ID 'myFileNameSelector' and a FilePond instance 'myFilePond'
 * handleFilePondSelectorDisabling('myFileNameSelector', myFilePond);
 *
 * @listens change - Listens for the 'change' event on the selector element to update the FilePond instance's disabled state.
 */
function handleFilePondSelectorDisabling(selectorId, filePondInstance) {
    const selector = document.getElementById(selectorId);
    if (!selector) return;

    const checkAndDisable = () => {
        filePondInstance.disabled = selector.value === '';
    };

    checkAndDisable();
    selector.addEventListener('change', checkAndDisable);
}

export { InitializeFilePond, handleFilePondSelectorDisabling };
