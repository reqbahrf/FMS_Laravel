import * as FilePond from 'filepond';
import {
    FilePondResponse,
    CustomFilePondConfig,
    ProcessConfig,
    ServerConfig,
    InitializeFilePondConfig,
} from '../@types/FilepondHandlers';

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute('content') as string;
const baseFilePondConfig: CustomFilePondConfig = {
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
            onload: (response: any) => {
                // Common onload logic will be handled later
                return response;
            },
            onerror: (response: any) => {
                console.error('File upload error:', response);
            },
        },
        revert: async (
            uniqueFileId: string,
            load: () => void,
            error: (arg0: string) => void
        ): Promise<void> => {
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
    elementId: string,
    options: Partial<InitializeFilePondConfig>,
    hiddenInputId: string | null = null,
    selectorId: string | null = null
): FilePond.FilePond | null {
    const element = document.getElementById(elementId) as HTMLInputElement;
    const elementName = element.name;
    const metaDataHandler = hiddenInputId
        ? (document.querySelector(
              `input[type="hidden"][id="${hiddenInputId}"]`
          ) as HTMLInputElement)
        : null;
    if (!element) {
        console.error(`Element with ID '${elementId}' not found.`);
        throw new Error('Element not found');
    }

    const config: InitializeFilePondConfig = {
        ...baseFilePondConfig,
        ...options,
        server: {
            ...(baseFilePondConfig.server as ServerConfig),
            process: (
                fieldName: string,
                file: File,
                metadata: { [key: string]: any },
                load: (p: string | { [key: string]: any }) => void,
                error: (errorText: string) => void,
                progress: (computableEvent: {
                    lengthComputable: boolean;
                    loaded: number;
                    total: number;
                }) => void,
                abort: () => void
            ) => {
                if (metadata && metadata.unique_id && metadata.file_path) {
                    const uniqueId = metadata.unique_id;
                    const filePath = metadata.file_path;

                    element.setAttribute('data-unique-id', uniqueId);
                    element.setAttribute('data-file-path', filePath);

                    if (metaDataHandler) {
                        metaDataHandler.value = filePath;
                        metaDataHandler.setAttribute(
                            'data-unique-id',
                            uniqueId
                        );
                        metaDataHandler.setAttribute(
                            'data-file-input-name',
                            elementName
                        );
                    }

                    if (selectorId) {
                        document
                            .getElementById(selectorId)
                            ?.classList.add('disabled');
                    }

                    load(uniqueId);
                    return;
                }

                const formData = new FormData();
                formData.append(fieldName, file, file.name);

                const controller = new AbortController();
                const signal = controller.signal;

                fetch('/FileRequirementsUpload', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                    signal: signal,
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(
                                `HTTP error! Status: ${response.status}`
                            );
                        }
                        return response.json();
                    })
                    .then((data: FilePondResponse) => {
                        if (data.unique_id && data.file_path) {
                            element.setAttribute(
                                'data-unique-id',
                                data.unique_id
                            );
                            element.setAttribute(
                                'data-file-path',
                                data.file_path
                            );
                            if (metaDataHandler) {
                                metaDataHandler.value = data.file_path;
                                metaDataHandler.setAttribute(
                                    'data-unique-id',
                                    data.unique_id
                                );
                                metaDataHandler.setAttribute(
                                    'data-file-input-name',
                                    elementName
                                );
                            }
                            if (selectorId) {
                                document
                                    .getElementById(selectorId)
                                    ?.classList.add('disabled');
                            }
                        }

                        load(data.unique_id);
                    })
                    .catch((err) => {
                        if (err.name === 'AbortError') {
                            // Request was aborted
                            return;
                        }
                        error(err.message || 'File upload failed');
                    });

                // Note: Fetch API doesn't have built-in progress events like XMLHttpRequest
                // This is a limitation when switching to fetch API

                // Return abort function
                return {
                    abort: () => {
                        controller.abort();
                        abort();
                    },
                };
            },
            revert: async (
                uniqueFileId: string,
                load: () => void,
                error: (arg0: string) => void
            ): Promise<void> => {
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
                        if (!metaDataHandler) return;
                        metaDataHandler.value = '';
                        metaDataHandler.setAttribute('data-unique-id', '');
                        if (selectorId) {
                            document
                                .getElementById(selectorId)
                                ?.classList.remove('disabled');
                        }
                    }
                } catch (err: any) {
                    error(
                        'Error: ' + err?.message ||
                            err?.responseJSON?.message ||
                            'Failed to revert file'
                    );
                }
            },
            load: async (
                source: string,
                load: (file: Blob | File) => void,
                error: (errorText: string) => void
            ) => {
                try {
                    const response = await fetch(source);
                    if (response.ok) {
                        const BlobData = (await response.blob()) as Blob;
                        load(BlobData);
                    } else {
                        error(
                            'File not found on the server or has been expired. Please try again'
                        );
                    }
                } catch (error: any) {
                    error(
                        'Error: ' + error?.message ||
                            error?.responseJSON?.message ||
                            'Failed to load file'
                    );
                }
            },
        },
        labelFileLoadError: (error: any) => {
            return `Error: ${error?.body || error}`;
        },
        onremovefile: async (
            error: FilePond.FilePondErrorDescription | null,
            file: FilePond.FilePondFile
        ): Promise<void> => {
            const filePath: string = file.getMetadata('file_path');
            const unique_id: string = file.getMetadata('unique_id');
            const fileInputName: string = file.getMetadata('file_input_name');
            const metaDataHandlerID: string = file.getMetadata(
                'meta_data_handler_id'
            );
            const oldMEtaDataHandler = document.querySelector(
                `input[type="hidden"][id="${metaDataHandlerID}"]`
            ) as HTMLInputElement;
            if (unique_id) {
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
                        oldMEtaDataHandler.value = '';
                        oldMEtaDataHandler.setAttribute('data-unique-id', '');
                        oldMEtaDataHandler.setAttribute(
                            'data-file-input-name',
                            fileInputName
                        );
                    } else {
                        console.error(
                            'Failed to delete file:',
                            response.statusText
                        );
                    }
                } catch (error) {
                    console.error('Error deleting file:', error);
                }
            }
            return;
        },
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
 * @param {FilePond.FilePond} filePondInstance - The FilePond instance to be enabled or disabled.
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
function handleFilePondSelectorDisabling(
    selectorId: string,
    filePondInstance: FilePond.FilePond
) {
    const selector = document.getElementById(selectorId) as HTMLSelectElement;
    if (!selector) return;

    const checkAndDisable = () => {
        if (filePondInstance.setOptions) {
            filePondInstance.setOptions({
                disabled: selector.value === '',
            });
        }
    };

    checkAndDisable();
    selector.addEventListener('change', checkAndDisable);
}

export { InitializeFilePond, handleFilePondSelectorDisabling };
