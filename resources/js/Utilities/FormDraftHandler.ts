import * as FilePond from 'filepond';
import { TableDataExtractor } from './TableDataExtractor';
import { TableRowConfig, DraftFormConfig } from 'global-form-config';
import { showToastFeedback } from './feedback-toast';
import { processError } from './error-handler-util';
import { AddressFormInput } from './AddressInputHandler';
interface FilePondDraftData {
    [key: string]:
        | string
        | {
              filePath: string;
              uniqueId: string;
              metaDataName: string;
              metaDataId: string;
          };
}

interface DraftData {
    [key: string]: any;
}

export class FormDraftHandler {
    private formInstance: JQuery<HTMLFormElement>;
    private getDraftRoute: string;
    private storeDraftRoute: string;
    private saveInterval: number;
    private changedFields: { [key: string]: string | Object | number };
    private autoSaveTimeout: number | null;
    private savedIndicatorTimeout: number | null = null;
    private observers: MutationObserver[] = [];
    private boundInputSelectors: string[] = [];
    private boundTableSelectors: string[] = [];
    private deleteDraftRoute: string;

    constructor(
        formInstance: JQuery<HTMLFormElement>,
        saveInterval: number = 5000
    ) {
        this.formInstance = formInstance;
        this.getDraftRoute = formInstance.data('get-draft');
        this.storeDraftRoute = formInstance.data('store-draft');
        this.deleteDraftRoute = formInstance.data('delete-draft');
        this.saveInterval = saveInterval;
        this.changedFields = {};
        this.autoSaveTimeout = null;
    }

    /**
     * Synchronizes text input data with the server by monitoring input changes.
     * When an input field changes, the value is stored in the 'changedFields' object.
     * The '_scheduleSave' method is called to save the changes to the server.
     *
     *
     * @example
     * // Initialize and start monitoring input fields
     * const formHandler = new FormDraftHandler(formInstance, 'draftType');
     * formHandler.syncTextInputData();
     *
     * @description
     * This method:
     * 1. Sets up event listeners for input fields
     * 2. Monitors changes to input fields
     * 3. Stores the changed values in the 'changedFields' object
     * 4. Calls the '_scheduleSave' method to save the changes to the server
     */
    public syncTextInputData(inputSelectors: string | null = null) {
        inputSelectors =
            inputSelectors ??
            'textarea[name]:not([readonly]), input[name]:not([readonly]), select[name]:not([readonly])';
        this.formInstance.find(inputSelectors).on('input change', (event) => {
            const target = event.target as
                | HTMLInputElement
                | HTMLTextAreaElement
                | HTMLSelectElement;
            const fieldName = target.name;
            let fieldValue: string | boolean;

            // Handle different input types
            switch (target.type) {
                case 'checkbox':
                    // For checkboxes, store the checked state
                    fieldValue = (target as HTMLInputElement).checked;
                    break;
                case 'radio':
                    // For radio buttons, store the value of the selected radio button
                    const radioGroup = this.formInstance.find(
                        `input[name="${fieldName}"]:checked`
                    );
                    fieldValue =
                        radioGroup.length > 0
                            ? (radioGroup.val() as string)
                            : '';
                    break;
                case 'select-one':
                case 'select-multiple':
                    // For select elements, store the selected value(s)
                    fieldValue = (target as HTMLSelectElement).value;
                    break;
                default:
                    // For text inputs, textareas, and other input types, use the value
                    fieldValue = target.value;
            }

            this.changedFields[fieldName] = fieldValue;
            this._scheduleSave();
        });

        // Store the selector for cleanup
        this.boundInputSelectors.push(inputSelectors);
    }
    /**
     * Synchronizes table input data with the server by monitoring input changes.
     * Uses TableDataExtractor to extract data from specified tables and stores it in the 'changedFields' object.
     * Calls the '_scheduleSave' method to save the changes to the server.
     *
     *
     * @example
     * // Initialize and start monitoring table inputs
     * const formHandler = new FormDraftHandler(formInstance, 'draftType');
     * const tableConfigs = {
     *   exportMarket: {
     *     id: 'exportMarketTable',
     *     selectors: {
     *       product: '.product-class',
     *       location: '.location-class',
     *       volume: { value: '.volume-class', unit: '.unit-class' },
     *     },
     *     requiredFields: ['product']
     *   }
     * };
     * formHandler.syncTablesData('#exportMarketTable', tableConfigs);
     *
     * @description
     * This method:
     * 1. Sets up event listeners for table inputs
     * 2. Monitors changes to table inputs
     * 3. Stores the changed values in the 'changedFields' object
     * 4. Calls the '_scheduleSave' method to save the changes to the server
     */
    public syncTablesData(
        tableSelectors: string,
        tableConfigs: Record<string, any>
    ) {
        console.log(tableSelectors);
        this.formInstance
            .find(tableSelectors)
            .on('input change', 'input', () => {
                this.changedFields = TableDataExtractor(tableConfigs);

                this._scheduleSave();
            });

        // Store the selector for cleanup
        this.boundTableSelectors.push(tableSelectors);
    }

    /**
     * Synchronizes FilePond file upload data with the server by monitoring hidden input changes.
     * Uses MutationObserver to detect changes in file metadata hidden inputs and automatically
     * saves the changes to the server.
     *
     *
     * @example
     * // Initialize and start monitoring file inputs
     * const formHandler = new FormDraftHandler(formInstance, 'draftType');
     * formHandler.syncFilepondData(['fileInput1_Data_Handler', 'fileInput2_Data_Handler']);
     *
     * @description
     * This method:
     * 1. Sets up MutationObservers for each hidden input
     * 2. Monitors changes to the 'value' attribute
     * 3. Extracts metadata (file path, unique ID, etc.)
     * 4. Automatically saves changes using the draft system
     */
    public syncFilepondData(FileMetaDataHiddenInputSelector: string[]) {
        FileMetaDataHiddenInputSelector.forEach((inputId) => {
            const inputElement = $(`#${inputId}`);

            let isProcessing = false;
            const observer = new MutationObserver((mutations) => {
                if (isProcessing) {
                    return;
                }
                isProcessing = true;
                mutations.forEach((mutation) => {
                    if (
                        mutation.type === 'attributes' &&
                        mutation.attributeName === 'value'
                    ) {
                        const META_DATA_HIDDEN_INPUT_NAME = inputElement.attr(
                            'name'
                        ) as string;
                        const META_DATA_ID = inputElement.attr('id');
                        const filePath = inputElement.val();
                        const FILE_INPUT_NAME = inputElement.attr(
                            'data-file-input-name'
                        ) as string;
                        const uniqueId = inputElement.attr('data-unique-id');
                        console.warn(
                            `Hidden input ${inputId} changed to: ${filePath} with unique ID: ${uniqueId}`
                        );
                        this.changedFields = {
                            [META_DATA_HIDDEN_INPUT_NAME]: filePath,
                            [FILE_INPUT_NAME]: {
                                filePath: filePath,
                                uniqueId: uniqueId,
                                metaDataName: META_DATA_HIDDEN_INPUT_NAME,
                                metaDataId: META_DATA_ID,
                            },
                        } as FilePondDraftData;
                        if (!FILE_INPUT_NAME) return;
                        this._scheduleSave();
                    }
                });
                setTimeout(() => {
                    isProcessing = false;
                }, 100);
            });

            // Start observing the input element for changes to its attributes
            observer.observe(inputElement[0], { attributes: true });

            // Store the observer for cleanup
            this.observers.push(observer);
        });
    }

    /**
     * Populates form text inputs with data from a draft object
     */
    public loadTextInputData(
        draftData: DraftData,
        formSelector: string,
        excludedFields: string[] = []
    ) {
        Object.entries(draftData).forEach(([key, value]) => {
            // Skip excluded fields and non-primitive values
            if (
                !excludedFields.includes(key) &&
                (typeof value === 'string' || typeof value === 'boolean')
            ) {
                const $field = $(`${formSelector} [name="${key}"]`);

                if ($field.length > 0) {
                    const fieldType = $field.attr('type');

                    switch (fieldType) {
                        case 'checkbox':
                            // Set checkbox checked state
                            $field.prop('checked', value === true);
                            break;
                        case 'radio':
                            // Select the radio button with the matching value
                            if (typeof value === 'string') {
                                $(
                                    `${formSelector} input[name="${key}"][value="${value}"]`
                                ).prop('checked', true);
                            }
                            break;
                        default:
                            // For text inputs, textareas, and other input types
                            if (typeof value === 'string') {
                                $field.val(value);
                            }
                    }
                }
            }
        });
    }

    /**
     * Populates multiple tables with data using provided selectors and row configurations
     */
    public loadTablesData(
        draftData: DraftData,
        tableSelectors: string[],
        tableRowConfigs: { [key: string]: any }
    ) {
        // If draftData is an array, convert it to an object
        const normalizedDraftData = Array.isArray(draftData)
            ? draftData.reduce(
                  (acc, curr, index) => {
                      acc[index.toString()] = curr;
                      return acc;
                  },
                  {} as { [key: string]: any }
              )
            : draftData;

        $.each(tableSelectors, (tableType, tableSelector) => {
            const tableData = normalizedDraftData[tableType];
            const rowConfig: TableRowConfig = tableRowConfigs[tableType];

            if (tableData) {
                // Handle both array and object types of tableData
                const dataToIterate = Array.isArray(tableData)
                    ? tableData
                    : Object.values(tableData);

                $.each(dataToIterate, (_, rowData) => {
                    // Ensure rowData is an object
                    const rowDataObject =
                        typeof rowData === 'object'
                            ? rowData
                            : { value: rowData };
                    this._addRowToTable(
                        tableSelector,
                        rowDataObject,
                        rowConfig
                    );
                });
            }
        });
    }

    public loadFilepondData(
        draftData: FilePondDraftData,
        filepondIds: string[]
    ) {
        if (!draftData || typeof draftData !== 'object' || !filepondIds) return;

        $.each(draftData, (key, value) => {
            // Validate object structure and required properties
            if (key === 'undefined') {
                console.warn("Skipping 'undefined' key.");
                return true; // Continue to the next iteration in $.each
            }

            if (
                value &&
                typeof value === 'object' &&
                'filePath' in value &&
                'uniqueId' in value &&
                'metaDataName' in value &&
                'metaDataId' in value &&
                typeof value.filePath === 'string' &&
                typeof value.uniqueId === 'string' &&
                typeof value.metaDataName === 'string' &&
                typeof value.metaDataId === 'string'
            ) {
                const filepondId = filepondIds.find((id) =>
                    id.includes(String(key))
                );

                if (filepondId) {
                    const fileUrl = GET_DRAFT_FILE.replace(
                        ':uniqueId',
                        value.uniqueId
                    );

                    fetch(fileUrl)
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error(
                                    `HTTP error! Status: ${response.status}`
                                );
                            }

                            // Extract metadata from headers
                            const fileName = response.headers.get(
                                'X-File-Name'
                            ) as string;
                            const fileSize = response.headers.get(
                                'X-File-Size'
                            ) as string;
                            const fileType = response.headers.get(
                                'X-Mime-Type'
                            ) as string;

                            // Clone the response to use the body twice
                            const responseClone = response.clone();

                            // Get the file content as a blob
                            return responseClone.blob().then((blob) => {
                                return {
                                    blob,
                                    fileName,
                                    fileSize: Number(fileSize),
                                    fileType,
                                };
                            });
                        })
                        .then(({ blob, fileName, fileSize, fileType }) => {
                            const filepondInstance =
                                this._getFilepondInstanceHandler(filepondId);

                            if (filepondInstance) {
                                // Create a File object from the blob
                                const file = new File([blob], fileName, {
                                    type: fileType,
                                });

                                // Add the file to FilePond with metadata
                                filepondInstance.addFile(file, {
                                    metadata: {
                                        unique_id: value.uniqueId,
                                        file_path: value.filePath,
                                        file_input_name: key,
                                        meta_data_handler_id: value.metaDataId,
                                    },
                                });
                            }
                        })
                        .catch((error) => {
                            console.error('Error loading file:', error);
                        });
                }
            }
        });
    }

    private _getFilepondInstanceHandler(filepondInputID: string) {
        const filePondElement = document.getElementById(filepondInputID);
        if (filePondElement) {
            const instance = FilePond.find(filePondElement);

            // Check if instance exists and is disabled
            if (instance && instance.disabled) {
                instance.disabled = false;
            }

            return instance;
        } else {
            console.error(
                'FilePond element not found for ID:',
                filepondInputID
            );
            return null; // Ensure a null value is returned if the element is not found
        }
    }
    /**
     * Adds a new row to a specified table using provided data and configuration
     * @param {string} tableSelector - jQuery selector for target table
     * @param {Object} rowData - Data to populate the new row
     * @param {Object} rowConfig - Configuration object containing createRow method
     */
    private _addRowToTable(
        tableSelector: string,
        rowData: object,
        rowConfig: TableRowConfig
    ) {
        const tableBody = $(tableSelector).find('tbody');
        const newRow = rowConfig.createRow(rowData);
        tableBody.append(newRow);
    }

    /**
     * Handles the loading of "Same Address With" checkboxes in the correct sequence
     * to ensure that source addresses are fully loaded before copying to target addresses.
     *
     * @param {Object} draftData - The draft data containing form values
     * @returns {Promise<void>} - A promise that resolves when all address checkboxes are properly handled
     */
    private async handleAddressCheckboxSequence(draftData: any): Promise<void> {
        const addressSequence = [
            { prefix: 'home', checkbox: null },
            { prefix: 'office', checkbox: 'same_address_with_home' },
            { prefix: 'factory', checkbox: 'same_address_with_office' },
        ];

        for (const addressType of addressSequence) {
            if (!addressType.checkbox || !draftData[addressType.checkbox]) {
                await AddressFormInput.loadAddressDropdowns(
                    addressType.prefix,
                    draftData
                );
            }

            if (addressType.checkbox && draftData[addressType.checkbox]) {
                await new Promise((resolve) => setTimeout(resolve, 100));

                const sourcePrefix = addressType.checkbox.replace(
                    'same_address_with_',
                    ''
                );

                $(`#${addressType.checkbox}`).prop('checked', true);

                AddressFormInput.handleSameAddressCheckbox(
                    sourcePrefix,
                    addressType.prefix,
                    true
                );
            }
        }
    }

    /**
     * Loads saved draft data into a form based on the provided configuration.
     *
     * This method retrieves draft data from the server and populates form fields,
     * table data, and FilePond file upload components according to the specified
     * configuration. It supports custom loading functions for different types of form elements.
     *
     * @param {DraftFormConfig} formConfig - Configuration object that defines form selectors,
     *                                       table selectors, table row configurations,
     *                                       FilePond selectors, and fields to exclude
     * @param {Function} [customInputDataLoaderFn] - Optional custom function to load data into text inputs
     * @param {Function} [customTableDataLoaderFn] - Optional custom function to load data into tables
     * @param {Function} [customFilepondLoaderFn] - Optional custom function to load data into FilePond instances
     * @param {Function|Object<string, Function>} [customDataLoaderFn] - Optional custom function or object of named functions
     *                                                                 to handle loading data into custom form elements
     * @returns {Promise<void>} - A promise that resolves when the draft data has been loaded
     */
    public async loadDraftData(
        formConfig: DraftFormConfig,
        customInputDataLoaderFn?: Function,
        customTableDataLoaderFn?: Function,
        customFilepondLoaderFn?: Function,
        customDataLoaderFn?: Function | { [key: string]: Function }
    ): Promise<void> {
        try {
            const response = await $.ajax({
                type: 'GET',
                url: this.getDraftRoute,
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });

            if (!response.success || !response.draftData) {
                console.warn('No draft found or draft data is empty.');
                return; // Exit early if no draft data
            }

            const draftData = response.draftData;
            const {
                formSelector,
                tableSelectors,
                tableRowConfigs,
                filepondSelector,
                excludedFields,
            }: DraftFormConfig = formConfig;

            const loaders = {
                textFields:
                    customInputDataLoaderFn ||
                    ((
                        data: DraftData,
                        selector: string,
                        excludedFields?: string[]
                    ) =>
                        this.loadTextInputData(data, selector, excludedFields)),
                tablesFields:
                    customTableDataLoaderFn ||
                    ((
                        data: DraftData,
                        selectors: string[],
                        rowConfigs: { [key: string]: any }
                    ) => this.loadTablesData(data, selectors, rowConfigs)),
                FilePondField:
                    customFilepondLoaderFn ||
                    ((data: FilePondDraftData, selector: string[]) =>
                        this.loadFilepondData(data, selector)),
                customFields:
                    typeof customDataLoaderFn === 'object'
                        ? customDataLoaderFn
                        : {
                              defaultLoader: customDataLoaderFn || (() => {}),
                          },
            };

            loaders.textFields(draftData, formSelector, excludedFields);
            loaders.tablesFields(draftData, tableSelectors, tableRowConfigs);
            loaders.FilePondField(draftData, filepondSelector);
            Object.entries(loaders.customFields).forEach(
                ([loaderName, loaderFn]) => {
                    loaderFn(draftData, formSelector);
                }
            );

            await this.handleAddressCheckboxSequence(draftData);
        } catch (error) {
            console.error('Error loading draft:', error);
        }
    }

    private _scheduleSave() {
        this._draftLoadingHandler();
        clearTimeout(this.autoSaveTimeout ?? 0);
        this.autoSaveTimeout = setTimeout(() => {
            this._syncDraftWithServer(this.changedFields);
        }, this.saveInterval);
    }

    private _getDraftType(url: string): string | null {
        try {
            const urlObj = new URL(url);
            const pathSegments = urlObj.pathname.split('/');

            const draftTypeIndex = pathSegments.indexOf('Draft') + 1;

            if (draftTypeIndex > 0 && draftTypeIndex < pathSegments.length) {
                return pathSegments[draftTypeIndex];
            } else {
                return null;
            }
        } catch (error) {
            console.error('Invalid URL:', error);
            return null;
        }
    }

    /**
     * Synchronizes draft changes with the server.
     * @param {Object} changedFields - Object containing the modified draft fields.
     */
    private async _syncDraftWithServer(changedFields: DraftData) {
        if ($.isEmptyObject(changedFields)) return;

        const draftType = this._getDraftType(this.storeDraftRoute);

        const requestData = {
            ...changedFields,
            draft_type: draftType,
        };

        try {
            const response = await $.ajax({
                type: 'POST',
                url: this.storeDraftRoute,
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
                this._showSavedIndicator();
                this.changedFields = {};
            }
        } catch (error) {
            this._removeDraftLoadingHandler();
        }
    }
    public async deleteDraft() {
        if (!this.deleteDraftRoute) return;
        try {
            const response = await $.ajax({
                type: 'DELETE',
                url: this.deleteDraftRoute,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });
            showToastFeedback('text-bg-success', response?.message);
        } catch (error) {
            throw error;
        }
    }

    private _draftLoadingHandler(customLoadingMessage = null) {
        if (this.formInstance.find('#DraftingIndicator').length > 0) {
            return;
        }

        // Create a container for the drafting indicator that will be sticky
        const indicatorContainer =
            /*html*/
            `<div class="position-sticky top-0 start-0 z-3 w-100 p-2" id="DraftingIndicatorContainer">
                <div class="bg-white rounded-5 bg-opacity-90 py-2 shadow-sm" >
                    <div class="d-flex align-items-center px-3" id="DraftingIndicator">
                        <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span role="status" class="ms-1 text-secondary">${customLoadingMessage ?? 'Drafting...'}</span>
                    </div>
                </div>
            </div>`;

        this.formInstance.prepend(indicatorContainer);
    }

    private _removeDraftLoadingHandler() {
        this.formInstance.find('#DraftingIndicatorContainer').remove();
    }

    /**
     * Shows a saved indicator that appears briefly when a draft is successfully saved
     */
    private _showSavedIndicator() {
        // First remove the drafting indicator
        this._removeDraftLoadingHandler();

        // Clear any existing timeout for the saved indicator
        if (this.savedIndicatorTimeout !== null) {
            clearTimeout(this.savedIndicatorTimeout);
        }

        // If the saved indicator already exists, just reset its timeout
        if (this.formInstance.find('#SavedIndicatorContainer').length > 0) {
            this.savedIndicatorTimeout = setTimeout(() => {
                this.formInstance
                    .find('#SavedIndicatorContainer')
                    .fadeOut(300, function () {
                        $(this).remove();
                    });
            }, 3000);
            return;
        }

        // Create a container for the saved indicator
        const savedIndicatorContainer =
            /*html*/
            `<div class="position-sticky top-0 start-0 z-3 w-100 p-2" id="SavedIndicatorContainer">
                <div class="bg-white rounded-5 bg-opacity-90 py-2 shadow-sm border border-1 border-success" >
                    <div class="d-flex align-items-center px-3" id="SavedIndicator">
                        <div class="text-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <span class="ms-1 text-success"><i class="ri-checkbox-circle-fill"></i>Draft saved successfully</span>
                    </div>
                </div>
            </div>`;

        this.formInstance.prepend(savedIndicatorContainer);

        // Set a timeout to remove the saved indicator after 3 seconds
        this.savedIndicatorTimeout = setTimeout(() => {
            this.formInstance
                .find('#SavedIndicatorContainer')
                .fadeOut(300, function () {
                    $(this).remove();
                });
        }, 3000);
    }

    /**
     * Destroys the FormDraftHandler instance by cleaning up all resources.
     * This includes:
     * - Disconnecting all MutationObservers
     * - Removing event listeners from form inputs and tables
     * - Clearing any pending timeouts
     * - Removing UI elements added by the handler
     *
     * Call this method when the form is being removed from the DOM or when
     * the draft functionality is no longer needed to prevent memory leaks.
     *
     * @example
     * // Clean up resources when form is no longer needed
     * formHandler.destroy();
     */
    public destroy(): void {
        if (this.autoSaveTimeout !== null) {
            clearTimeout(this.autoSaveTimeout);
            this.autoSaveTimeout = null;
        }

        if (this.savedIndicatorTimeout !== null) {
            clearTimeout(this.savedIndicatorTimeout);
            this.savedIndicatorTimeout = null;
        }

        this.observers.forEach((observer) => {
            observer.disconnect();
        });
        this.observers = [];

        this.boundInputSelectors.forEach((selector) => {
            this.formInstance.find(selector).off('input change');
        });
        this.boundInputSelectors = [];

        this.boundTableSelectors.forEach((selector) => {
            this.formInstance.find(selector).off('input change', 'input');
        });
        this.boundTableSelectors = [];

        this._removeDraftLoadingHandler();
        this.formInstance.find('#SavedIndicatorContainer').remove();

        this.changedFields = {};
    }
}
