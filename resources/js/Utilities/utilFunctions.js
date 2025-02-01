const ProcessToast = $('#ProcessToast');
const FeedbackToast = $('#ActionFeedbackToast');

/**
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
function showToastFeedback(status, message) {
    const toastInstance = new bootstrap.Toast(FeedbackToast);

    FeedbackToast
        .find('.toast-header')
        .removeClass([
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
const formatNumberToCurrency = (value) => {
    return value.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
};

const customDateFormatter = (date) => {
    const hasTime = /\d{1,2}:\d{2}/.test(date);

    const dateObj = new Date(date);

    const dateOptions = {
        month: 'short',
        day: '2-digit',
        year: 'numeric',
    };
    if (hasTime) {
        dateOptions.hour = 'numeric';
        dateOptions.minute = '2-digit';
        dateOptions.hour12 = true;
    }

    return dateObj.toLocaleString('en-US', dateOptions);
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
function closeOffcanvasInstances(offcanva_id) {
    const offcanvasElement = $(offcanva_id).get(0);
    const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
    offcanvasInstance.hide();
}

/**
 * Formats numeric input fields to display thousand separators and limit decimal places to 2 digits.
 * Automatically formats the input value as the user types.
 *
 * @param {string|Element} selectorOrParent - jQuery selector or parent element to attach the event handler.
 *                                           If only one argument is provided, this becomes the input selector.
 * @param {string|string[]|null} inputSelectors - jQuery selector(s) for the input field(s) to format.
 *                                               Can be a single selector string or array of selectors.
 *                                               Can be use for event delegation, if the parent element is provided.
 *                                               If null, the first parameter is used as the input selector.
 *
 *
 * @example
 * // Format a single input
 * customFormatNumericInput('#priceInput');
 *
 * // Format multiple inputs within a form
 * customFormatNumericInput('#myForm', ['.price-input', '.amount-input']);
 *
 * // Format inputs within a specific parent
 * customFormatNumericInput('#parentDiv', '.numeric-input');
 */
function customFormatNumericInput(selectorOrParent, inputSelectors = null) {
    // If only one argument is provided, treat it as input selector(s)
    if (inputSelectors === null) {
        inputSelectors = selectorOrParent;
        selectorOrParent = 'body';
    }

    // Convert single string selector to array if needed
    const selectors = Array.isArray(inputSelectors)
        ? inputSelectors
        : [inputSelectors];

    // Join all selectors with comma for jQuery multiple selector
    const combinedSelector = selectors.join(', ');

    $(selectorOrParent).on('input', combinedSelector, function () {
        let value = $(this)
            .val()
            .replace(/[^0-9.]/g, '');
        if (value.includes('.')) {
            const parts = value.split('.');
            parts[1] = parts[1].substring(0, 2);
            value = parts.join('.');
        }
        const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        $(this).val(formattedValue);
    });
}

/**
 * Parses a formatted number string (with thousand separators) back to a float.
 * Companion function to customFormatNumericInput.
 *
 * @param {string} value - The formatted number string to parse
 * @returns {number} The parsed float value, or 0 if parsing fails
 */
function parseFormattedNumberToFloat(value) {
    return parseFloat(value?.replace(/,/g, '')) || 0;
}

function closeModal(modelId) {
    const model = bootstrap.Modal.getInstance(modelId);
    model.hide();
}

function sanitize(input) {
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
function createConfirmationModal(options = {}) {
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
    const modalHTML = /*html*/`
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
    const toastInstance = new bootstrap.Toast(ProcessToast);

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
    const toastInstance = bootstrap.Toast.getInstance(ProcessToast);
    if (toastInstance) {
        toastInstance.hide();
    }
}

export {
    showToastFeedback,
    formatNumberToCurrency,
    customDateFormatter,
    closeOffcanvasInstances,
    customFormatNumericInput,
    parseFormattedNumberToFloat,
    closeModal,
    sanitize,
    createConfirmationModal,
    showProcessToast,
    hideProcessToast,
};
