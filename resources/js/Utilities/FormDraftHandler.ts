import * as FilePond from 'filepond';
import { TableDataExtractor } from './TableDataExtractor';
import { TableRowConfig, DraftFormConfig } from 'global-form-config';
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
    private observers: MutationObserver[] = [];
    private boundInputSelectors: string[] = [];
    private boundTableSelectors: string[] = [];

    constructor(
        formInstance: JQuery<HTMLFormElement>,
        saveInterval: number = 5000
    ) {
        this.formInstance = formInstance;
        this.getDraftRoute = formInstance.data('get-draft');
        this.storeDraftRoute = formInstance.data('store-draft');
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
    private loadTextInputData(
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
    private _loadTablesData(
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
                    this.addRowToTable(tableSelector, rowDataObject, rowConfig);
                });
            }
        });
    }

    private loadFilepondData(
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
                    const fileUrl = DRAFT_ROUTE.GET_FILE.replace(
                        ':unique_id',
                        value.uniqueId
                    );
                    // Load file into corresponding FilePond instance
                    const filepondInstance =
                        this.getFilepondInstanceHandler(filepondId);
                    if (filepondInstance) {
                        filepondInstance.addFile(fileUrl, {
                            type: 'local',
                            metadata: {
                                unique_id: value.uniqueId,
                                file_path: value.filePath,
                                file_input_name: key,
                                meta_data_handler_id: value.metaDataId,
                            },
                        });
                    }
                }
            }
        });
    }

    private getFilepondInstanceHandler(filepondInputID: string) {
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
    private addRowToTable(
        tableSelector: string,
        rowData: object,
        rowConfig: TableRowConfig
    ) {
        const tableBody = $(tableSelector).find('tbody');
        const newRow = rowConfig.createRow(rowData);
        tableBody.append(newRow);
    }

    /**
     * Asynchronously loads draft data for a given type, populating form fields, tables, and filepond.
     */
    public async loadDraftData(
        formConfig: DraftFormConfig,
        customInputDataLoaderFn?: Function,
        customTableDataLoaderFn?: Function,
        customFilepondLoaderFn?: Function,
        customDataLoaderFn?: Function
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
            } = formConfig;

            // Use helper functions or fall back to generic loaders
            const loaders = {
                textFields:
                    customInputDataLoaderFn ||
                    ((data: DraftData, selector: string) =>
                        this.loadTextInputData(data, selector)),
                tablesFields:
                    customTableDataLoaderFn ||
                    ((
                        data: DraftData,
                        selectors: string[],
                        rowConfigs: { [key: string]: any }
                    ) => this._loadTablesData(data, selectors, rowConfigs)),
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

            loaders.textFields(draftData, formSelector);
            loaders.tablesFields(draftData, tableSelectors, tableRowConfigs);
            loaders.FilePondField(draftData, filepondSelector);
            Object.entries(loaders.customFields).forEach(
                ([loaderName, loaderFn]) => {
                    loaderFn(draftData, formSelector);
                }
            );
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
                this._removeDraftLoadingHandler();
                this.changedFields = {};
            }
        } catch (error) {
            this._removeDraftLoadingHandler();
        }
    }

    private _draftLoadingHandler(customLoadingMessage = null) {
        if (this.formInstance.find('#DraftingIndicator').length > 0) {
            return;
        }
        const spinner =
            /*html*/
            `<div class="d-flex align-items-center" id="DraftingIndicator">
                            <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span role="status" class="ms-1 text-secondary">${customLoadingMessage ?? 'Drafting...'}</span>
                        </div>`;
        this.formInstance.prepend(spinner);
    }
    private _removeDraftLoadingHandler() {
        this.formInstance.find('#DraftingIndicator').remove();
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

        this.changedFields = {};
    }
}
