import * as bootstrap from 'bootstrap';
import * as jquery from 'jquery';

/**
 * Formats a number value to a string with a fixed number of decimal places.
 *
 * @param {number} value - The number to be formatted.
 * @returns {string} The formatted number as a string with exactly 2 decimal places.
 */
const formatNumberToCurrency = (value: number): string => {
    return value.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
};

const customDateFormatter = (date: string): string => {
    if (!date) return '';

    let parsedDate: Date;
    let includeTime = false;

    if (date.includes('T')) {
        parsedDate = new Date(date);
        includeTime = true;
    } else if (date.includes(' ')) {
        parsedDate = new Date(date.replace(' ', 'T'));
        includeTime = true;
    } else {
        const [year, month, day] = date.split('-').map(Number);
        parsedDate = new Date(Date.UTC(year, month - 1, day));
    }

    if (isNaN(parsedDate.getTime())) {
        console.warn(`Invalid date input: ${date}`);
        return '';
    }

    const dateOptions: Intl.DateTimeFormatOptions = {
        month: 'short',
        day: '2-digit',
        year: 'numeric',
    };

    if (includeTime) {
        dateOptions.hour = '2-digit';
        dateOptions.minute = '2-digit';
        dateOptions.hour12 = true;
    }

    return parsedDate.toLocaleString('en-US', dateOptions);
};

/**
 * Closes a Bootstrap Offcanvas instance by its ID.
 * Uses Bootstrap's Offcanvas API to properly hide the offcanvas element.
 *
 * @param {string} offcanva_id - The jQuery selector for the offcanvas element (e.g., '#myOffcanvas')
 * @throws {Error} If the offcanvas element doesn't exist or has no Bootstrap Offcanvas instance
 *
 * @example
 * // Close an offcanvas by its ID
 * closeOffcanvasInstances('#sidebarOffcanvas');
 *
 * @example
 * // Close multiple offcanvas instances
 * closeOffcanvasInstances('#filterOffcanvas');
 * closeOffcanvasInstances('#menuOffcanvas');
 */
function closeOffcanvasInstances(offcanva_id: string): void {
    const offcanvasElement = $(offcanva_id).get(0);
    if (!offcanvasElement) {
        console.warn(`No offcanvas element found for selector: ${offcanva_id}`);
        return;
    }
    const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
    if (offcanvasInstance) {
        offcanvasInstance.hide();
    }
}

/**
 * Parses a formatted number string (with thousand separators) back to a float.
 * Companion function to customFormatNumericInput.
 *
 * @param {string} value - The formatted number string to parse
 * @returns {number} The parsed float value, or 0 if parsing fails
 */
function parseFormattedNumberToFloat(value: string): number {
    return parseFloat(value?.replace(/,/g, '')) || 0;
}

function closeModal(modelId: string): void {
    const model = bootstrap.Modal.getInstance(modelId);
    if (!model) return console.warn(`No modal instance found for ${modelId}`);
    model.hide();
}

function sanitize(input: string): string {
    return $('<div>').text(input).html(); // Escape special characters
}

/**
 * Converts JQuery form data array into a structured object
 * Handles both regular form fields and array fields (with '[]' in the name)
 * @param formData - Array of name-value pairs from a form
 * @param filterOptions - Optional filtering options
 * @returns An object with form field names as keys and their values
 */
function serializeFormData(
    formData: JQuery.NameValuePair[],
    filterOptions?: {
        includeWithAttribute?: string;
        includeWithClass?: string;
    }
): { [key: string]: string | string[] } {
    const FormDataObject: { [key: string]: string | string[] } = {};

    formData.forEach((field) => {
        if (filterOptions) {
            const input = $(`[name="${field.name}"]`);

            if (
                filterOptions.includeWithAttribute &&
                !input.is(`[${filterOptions.includeWithAttribute}]`)
            ) {
                return;
            }
            if (
                filterOptions.includeWithClass &&
                !input.hasClass(filterOptions.includeWithClass)
            ) {
                return;
            }
        }
        if (field.name.includes('[]')) {
            FormDataObject[field.name] = FormDataObject[field.name]
                ? [...FormDataObject[field.name], field.value]
                : [field.value];
        } else {
            FormDataObject[field.name] = field.value;
        }
    });

    return FormDataObject;
}

export {
    formatNumberToCurrency,
    customDateFormatter,
    closeOffcanvasInstances,
    parseFormattedNumberToFloat,
    closeModal,
    sanitize,
    serializeFormData,
};
