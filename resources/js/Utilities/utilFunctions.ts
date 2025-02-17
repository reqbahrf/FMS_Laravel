import * as bootstrap from 'bootstrap';
import * as jquery from 'jquery';
const ProcessToast = $('#ProcessToast');
const FeedbackToast = $('#ActionFeedbackToast');

interface ConfirmationModalOptions {
    title?: string;
    titleBg?: string;
    message?: string;
    confirmText?: string;
    cancelText?: string;
    confirmButtonClass?: string;
    size?: string;
}

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
    // If the date is empty or invalid, return an empty string
    if (!date) return '';

    // Try parsing the date string, handling both date-only and datetime formats
    let parsedDate: Date;
    let includeTime = false;

    // Check if the date contains a space (likely a datetime string)
    if (date.includes(' ')) {
        // For datetime strings, use the standard Date constructor
        parsedDate = new Date(date.replace(' ', 'T'));
        includeTime = true;
    } else {
        // For date-only strings, use Date.UTC to avoid timezone issues
        const [year, month, day] = date.split('-').map(Number);
        parsedDate = new Date(Date.UTC(year, month - 1, day));
    }

    // Check if the date is valid
    if (isNaN(parsedDate.getTime())) {
        console.warn(`Invalid date input: ${date}`);
        return '';
    }

    const dateOptions: Intl.DateTimeFormatOptions = {
        month: 'short',
        day: '2-digit',
        year: 'numeric',
    };

    // Add time formatting if the original input included time
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
function parseFormattedNumberToFloat(value: string) {
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
 * Creates and displays a customizable confirmation modal dialog using Bootstrap.
 * Returns a Promise that resolves to true if confirmed, false if cancelled or closed.
 *
 * @param {Object} options - Configuration options for the modal
 * @param {string} [options.title='Confirm Action'] - The title text of the modal
 * @param {string} [options.titleBg='bg-primary'] - Bootstrap background class for the modal header
 * @param {string} [options.message='Are you sure you want to proceed?'] - The message body of the modal
 * @param {string} [options.confirmText='Confirm'] - Text for the confirm button
 * @param {string} [options.cancelText='Cancel'] - Text for the cancel button
 * @param {string} [options.confirmButtonClass='btn-primary'] - Bootstrap button class for the confirm button
 * @param {string} [options.size=''] - Bootstrap modal size class (e.g., 'modal-lg', 'modal-sm')
 * @returns {Promise<boolean>} Resolves to true if confirmed, false if cancelled or closed
 *
 * @example
 * // Basic usage
 * const result = await createConfirmationModal();
 * if (result) {
 *     // User clicked confirm
 * }
 *
 * @example
 * // Custom configuration
 * const result = await createConfirmationModal({
 *     title: 'Delete Item',
 *     titleBg: 'bg-danger',
 *     message: 'Are you sure you want to delete this item?',
 *     confirmText: 'Delete',
 *     confirmButtonClass: 'btn-danger',
 *     size: 'modal-sm'
 * });
 */
function createConfirmationModal(options: ConfirmationModalOptions = {}) {
    const {
        title = 'Confirm Action',
        titleBg = 'bg-primary',
        message = 'Are you sure you want to proceed?',
        confirmText = 'Confirm',
        cancelText = 'Cancel',
        confirmButtonClass = 'btn-primary',
        size = '',
    } = options;

    // Remove existing modal if any
    $('#confirmationModal').remove();

    // Create modal HTML
    const modalHTML = /*html*/ `
        <div class="modal fade" style="z-index: 2000 !important;" data-bs-backdrop="static" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog ${size}">
                <div class="modal-content">
                    <div class="modal-header ${titleBg}">
                        <h5 class="modal-title text-white" id="confirmationModalLabel">${sanitize(
                            title
                        )}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ${sanitize(message)}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">${sanitize(
                            cancelText
                        )}</button>
                        <button type="button" class="btn ${sanitize(
                            confirmButtonClass
                        )}" id="confirmActionBtn">${sanitize(
                            confirmText
                        )}</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Append modal to body
    $('body').append(modalHTML);

    // Create and return a promise
    return new Promise((resolve, reject) => {
        const modalElement = document.getElementById('confirmationModal');
        if (!modalElement)
            return console.warn(
                `No modal element found with id #confirmationModal`
            );
        const modal = new bootstrap.Modal(modalElement);

        // Handle confirm button click
        $('#confirmActionBtn').on('click', () => {
            modal.hide();
            resolve(true);
        });

        // Handle modal hidden event (including cancel button and close button)
        modalElement.addEventListener('hidden.bs.modal', () => {
            $('#confirmationModal').remove();
            resolve(false);
        });

        // Show the modal
        modal.show();
    });
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

function serializeFormData(formData: JQuery.NameValuePair[]): {[key: string]: string | string[] } {
    const FormDataObject: {[key: string]: string | string[] } = {};
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
    createConfirmationModal,
    showProcessToast,
    hideProcessToast,
    serializeFormData,
};
