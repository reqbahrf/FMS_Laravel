import * as bootstrap from 'bootstrap';
import * as jquery from 'jquery';
const ProcessToast = $('#ProcessToast');
const FeedbackToast = $('#ActionFeedbackToast');

/**import * as bootstrap from 'bootstrap';
 * Shows a Bootstrap toast notification with customizable status and message.
 * Uses a pre-defined toast element with ID 'ActionFeedbackToast'.
 *
 * @param {string} status - Bootstrap text background class for the toast header
 *                         (e.g., 'text-bg-success', 'text-bg-danger', 'text-bg-warning')
 * @param {string} message - The message to display in the toast body
 *
 * @example
 * // Show success message
 * showToastFeedback('text-bg-success', 'Operation completed successfully!');
 *
 * @example
 * // Show error message
 * showToastFeedback('text-bg-danger', 'An error occurred while processing your request.');
 *
 * @example
 * // Show warning message
 * showToastFeedback('text-bg-warning', 'Please review your input.');
 */
function showToastFeedback(status: string, message: string) {
    const toastInstance = new bootstrap.Toast(FeedbackToast[0]);

    FeedbackToast.find('.toast-header').removeClass([
        'text-bg-danger',
        'text-bg-success',
        'text-bg-warning',
        'text-bg-info',
        'text-bg-primary',
        'text-bg-light',
        'text-bg-dark',
    ]);

    FeedbackToast.find('.toast-body').text('');
    FeedbackToast.find('.toast-header').addClass(status);
    FeedbackToast.find('.toast-body').text(message);

    toastInstance.show();
}

/**
 * Formats a number value to a string with a fixed number of decimal places.
 *
 * @param {number} value - The number to be formatted.
 * @returns {string} The formatted number as a string with exactly 2 decimal places.
 */
const formatNumberToCurrency = (value: number) => {
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
function closeOffcanvasInstances(offcanva_id: string) {
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

function closeModal(modelId: string) {
    const model = bootstrap.Modal.getInstance(modelId);
    if (!model) return console.warn(`No modal instance found for ${modelId}`);
    model.hide();
}

function sanitize(input: string) {
    return $('<div>').text(input).html(); // Escape special characters
}

/**
 * Shows a Bootstrap toast notification for ongoing processes.
 * Uses a pre-defined toast element with ID 'ProcessToast'.
 *
 * @param {string} [message='Processing...'] - Custom message to display in the toast.
 *                                            If not provided, shows default 'Processing...' message
 *
 * @example
 * // Show default processing message
 * showProcessToast();
 *
 * @example
 * // Show custom processing message
 * showProcessToast('Uploading files...');
 */
function showProcessToast(message = 'Processing...') {
    const toastInstance = new bootstrap.Toast(ProcessToast[0]);

    // Set the message if provided, otherwise show default spinner
    if (message) {
        ProcessToast.find('#ProcessToastBody').html(message);
    }

    toastInstance.show();
}

/**
 * Hides the currently displayed process toast.
 * Safely handles cases where the toast instance might not exist.
 *
 * @example
 * // Hide process toast after operation completes
 * showProcessToast('Saving data...');
 * await saveData();
 * hideProcessToast();
 */
function hideProcessToast() {
    const toastInstance = bootstrap.Toast.getInstance(ProcessToast[0]);
    if (!toastInstance) {
        return console.warn('No process toast instance found.');
    }
    toastInstance.hide();
}

/**
 * Converts JQuery form data array into a structured object
 * Handles both regular form fields and array fields (with '[]' in the name)
 * @param formData - Array of name-value pairs from a form
 * @returns An object with form field names as keys and their values
 */
function serializeFormData(formData: JQuery.NameValuePair[]): {
    [key: string]: string | string[];
} {
    const FormDataObject: { [key: string]: string | string[] } = {};
    formData.forEach((field) => {
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
    showToastFeedback,
    formatNumberToCurrency,
    customDateFormatter,
    closeOffcanvasInstances,
    parseFormattedNumberToFloat,
    closeModal,
    sanitize,
    showProcessToast,
    hideProcessToast,
    serializeFormData,
};
