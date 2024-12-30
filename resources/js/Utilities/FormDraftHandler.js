/**
 * Populates form text inputs with data from a draft object
 * @param {Object} draftData - Object containing key-value pairs to populate the form
 * @param {string} formSelector - jQuery selector for the target form
 * @param {Array} [excludedFields=[]] - Array of field names to exclude from population
 */
export function loadTextInputData(
    draftData,
    formSelector,
    excludedFields = []
) {
    $.each(draftData, (key, value) => {
        if (!excludedFields.includes(key) && typeof value !== 'object') {
            $(`${formSelector} [name="${key}"]`).val(value);
        }
    });
}

/**
 * Populates multiple tables with data using provided selectors and row configurations
 * @param {Object} draftData - Object containing data for each table type
 * @param {Object} tableSelectors - Object mapping table types to jQuery selectors
 * @param {Object} tableRowConfigs - Object mapping table types to row configuration objects
 */
export function loadTablesData(draftData, tableSelectors, tableRowConfigs) {
    $.each(tableSelectors, (tableType, tableSelector) => {
        const tableData = draftData[tableType];
        const rowConfig = tableRowConfigs[tableType];

        if (tableData) {
            $.each(tableData, (_, rowData) => {
                addRowToTable(tableSelector, rowData, rowConfig);
            });
        }
    });
}


export const loadFilepondData = (draftData, filepondIds) => {
    if (!draftData || typeof draftData !== 'object') return;

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

            const filepondId = filepondIds.find(id => id.includes(key));

            console.log("Looking for filepondId matching:", key);
            console.log("Found filepondId:", filepondId);


            if (filepondId) {
                const fileUrl = DRAFT_ROUTE.GET_FILE.replace(':unique_id', value.uniqueId);
                // Load file into corresponding FilePond instance
                const filepondInstance = getFilepondInstanceHandler(filepondId);
                if (filepondInstance) {
                    filepondInstance.addFile(fileUrl, {
                        type: 'local',
                        metadata: {
                            unique_id: value.uniqueId,
                            file_path: value.filePath,
                            file_input_name: key,
                            meta_data_handler_id: value.metaDataId
                        }
                    });
                }
            }
        }
    });
};

const getFilepondInstanceHandler = (filepondInputID) => {
    console.log("Looking for FilePond instance with ID:", filepondInputID);
    const filePondElement = document.getElementById(filepondInputID);
    if (filePondElement) {
        const instance = FilePond.find(filePondElement);
        console.log("Found FilePond instance:", instance);

        // Check if instance exists and is disabled
        if (instance && instance.disabled) {
            console.log("FilePond instance was disabled, enabling it now");
            instance.disabled = false;
        }

        return instance;
    } else {
        console.error("FilePond element not found for ID:", filepondInputID);
        return null; // Ensure a null value is returned if the element is not found
    }
};

/**
 * Adds a new row to a specified table using provided data and configuration
 * @param {string} tableSelector - jQuery selector for target table
 * @param {Object} rowData - Data to populate the new row
 * @param {Object} rowConfig - Configuration object containing createRow method
 */
function addRowToTable(tableSelector, rowData, rowConfig) {
    const tableBody = $(tableSelector).find('tbody');
    const newRow = rowConfig.createRow(rowData);
    tableBody.append(newRow);
}

/**
 * Synchronizes draft changes with the server by sending modified fields via AJAX POST request.
 * @param {string} draftType - The type of draft being synchronized
 * @param {Object} changedFields - Object containing the modified draft fields
 * @returns {Promise<void>} A promise that resolves when synchronization is complete
 */
export async function syncDraftWithServer(draftType, changedFields) {
    if ($.isEmptyObject(changedFields)) return;

    const requestData = {
        ...changedFields,
        draft_type: draftType,
    };

    try {
        const response = await $.ajax({
            type: 'POST',
            url: DRAFT_ROUTE.STORE,
            data: JSON.stringify(requestData),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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

/**
 * Asynchronously loads draft data for a given type, populating form fields and tables.
 *
 * @param {string} draftType - The type of draft to load.
 * @param {object} formConfig - Configuration object containing form and table selectors.
 * @param {function} [customInputDataLoaderFn] - Custom function to load text input data.
 * @param {function} [customTableDataLoaderFn] - Custom function to load table data.
 * @param {function|object} [customDataLoaderFn] - Custom function or object of functions to load other data.
 *
 * @returns {Promise<void>}
 */
export const loadDraftData = async (
    draftType,
    formConfig,
    customInputDataLoaderFn,
    customTableDataLoaderFn,
    customFilepondLoaderFn,
    customDataLoaderFn
) => {
    console.log('Retrieving the form draft for', draftType);
    try {
        const response = await $.ajax({
            type: 'GET',
            url: DRAFT_ROUTE.GET.replace(':type', draftType),
            headers: {
                'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });

        if (!response.success || !response.draftData) {
            console.log('No draft found or draft data is empty.');
            return; // Exit early if no draft data
        }

        const draftData = response.draftData;
        const { formSelector, tableSelectors, tableRowConfigs , filepondSelector} = formConfig;

        // Use helper functions or fall back to generic loaders
        const loaders = {
            textFields:
                customInputDataLoaderFn ||
                ((data, selector) => loadTextInputData(data, selector)),
            tablesFields:
                customTableDataLoaderFn ||
                ((data, selectors, rowConfigs) =>
                    loadTablesData(data, selectors, rowConfigs)),
            FilePondField:
                customFilepondLoaderFn ||
                ((data, selector) => loadFilepondData(data, selector)),
            customFields:
                typeof customDataLoaderFn === 'object'
                    ? customDataLoaderFn
                    : { defaultLoader: customDataLoaderFn || (() => {}) },
        };

        loaders.textFields(draftData, formSelector);
        loaders.tablesFields(draftData, tableSelectors, tableRowConfigs);
        loaders.FilePondField(draftData, filepondSelector);
        Object.entries(loaders.customFields).forEach(
            ([loaderName, loaderFn]) => {
                loaderFn(draftData, formSelector);
                console.log(`Executed custom loader: ${loaderName}`);
            }
        );

        console.log('Draft loaded:', draftData);
    } catch (error) {
        console.error('Error loading draft:', error);
    }
};
