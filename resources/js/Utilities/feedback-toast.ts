import * as bootstrap from 'bootstrap';
import * as jquery from 'jquery';

// Container references
const toastFeedbackContainer = $('#toastFeedbackContainer');
const toastProcessContainer = $('#toastProcessContainer');

// Counter to generate unique IDs for toast instances
let toastCounter = 0;

// Map of status keywords to Bootstrap utility classes
const STATUS_MAP: Record<string, string> = {
    success: 'text-bg-success',
    error: 'text-bg-danger',
    info: 'text-bg-info',
    warning: 'text-bg-warning',
    // Add more mappings as needed
};

/**
 * Shows a Bootstrap toast notification with customizable status and message.
 * Creates a new toast instance for each call to allow stacking.
 *
 * @param {string} status - Either a simple status keyword ('success', 'error', 'info', 'warning')
 *                         or a direct Bootstrap text background class
 *                         (e.g., 'text-bg-success', 'text-bg-danger', 'text-bg-warning')
 * @param {string} message - The message to display in the toast body
 * @param {boolean} [autohide=true] - Whether to automatically hide the toast
 * @param {number} [delay=5000] - Delay in milliseconds before autohiding the toast
 *
 * @example
 * // Using simple status keywords
 * showToastFeedback('success', 'Operation completed successfully!');
 * showToastFeedback('error', 'An error occurred while processing your request.', false);
 *
 * @example
 * // Using direct Bootstrap classes (backward compatibility)
 * showToastFeedback('text-bg-success', 'Operation completed successfully!');
 * showToastFeedback('text-bg-danger', 'An error occurred while processing your request.', false);
 */
function showToastFeedback(
    status: string,
    message: string,
    autohide: boolean = true,
    delay: number = 5000
): {
    id: string;
    element: JQuery<HTMLElement>;
    instance: bootstrap.Toast;
} | void {
    // Check if status is a key in our map, otherwise use it directly
    const bootstrapClass: string = STATUS_MAP[status.toLowerCase()] || status;

    // Create a unique ID for this toast
    const toastId = `feedback-toast-${toastCounter++}`;

    // Create the toast HTML
    const toastHTML = /*html*/ `
        <div id="${toastId}" class="toast align-items-center mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="${autohide}" data-bs-delay="${delay}">
            <div class="toast-header ${bootstrapClass}">
                <strong class="me-auto">Message</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

    // Append the new toast to the container
    toastFeedbackContainer.append(toastHTML);

    // Get the new toast element and initialize it
    const toastElement = $(`#${toastId}`);
    const toastInstance = new bootstrap.Toast(toastElement[0]);

    // Show the toast
    toastInstance.show();

    // Remove the element from DOM after it's hidden (for cleanup)
    toastElement.on('hidden.bs.toast', function () {
        toastElement.remove();
    });

    return !autohide
        ? { id: toastId, element: toastElement, instance: toastInstance }
        : undefined;
}

/**
 * Shows a Bootstrap toast notification for ongoing processes.
 * Creates a new toast instance for each call to allow stacking.
 *
 * @param {string} [message='Processing...'] - Custom message to display in the toast
 * @param {boolean} [autohide=false] - Whether to automatically hide the toast
 * @returns {Object} Toast object with id, element, and instance references
 *
 * @example
 * // Show default processing message
 * const processToast = showProcessToast();
 *
 * @example
 * // Show custom processing message that auto-hides
 * showProcessToast('Uploading files...', true);
 */
function showProcessToast(
    message: string = 'Processing...',
    autohide: boolean = false
): { id: string; element: JQuery<HTMLElement>; instance: bootstrap.Toast } {
    // Create a unique ID for this toast
    const toastId = `process-toast-${toastCounter++}`;

    // Create the toast HTML
    const toastHTML = /*html*/ `
        <div id="${toastId}" class="toast align-items-center mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="${autohide}">
            <div class="toast-header text-bg-success">
                <div class="spinner-border spinner-border-sm me-2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <strong class="me-auto">${message}</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

    // Append the new toast to the container
    toastProcessContainer.append(toastHTML);

    // Get the new toast element and initialize it
    const toastElement = $(`#${toastId}`);
    const toastInstance = new bootstrap.Toast(toastElement[0]);

    // Show the toast
    toastInstance.show();

    // Remove the element from DOM after it's hidden (for cleanup)
    toastElement.on('hidden.bs.toast', function () {
        toastElement.remove();
    });

    return { id: toastId, element: toastElement, instance: toastInstance };
}

/**
 * Hides a specific process toast.
 *
 * @param {string|Object} toast - Either a toast ID string or toast object returned from showProcessToast
 * @example
 * // Hide toast by ID
 * hideProcessToast('process-toast-1');
 *
 * @example
 * // Hide toast by object
 * const toast = showProcessToast('Saving data...');
 * // ... after process completes
 * hideProcessToast(toast);
 */
function hideProcessToast(
    toast:
        | string
        | {
              id: string;
              element: JQuery<HTMLElement>;
              instance: bootstrap.Toast;
          }
): void {
    let toastId;

    if (typeof toast === 'string') {
        toastId = toast;
    } else if (toast && toast.id) {
        toastId = toast.id;
    } else {
        return console.warn('Invalid toast reference provided.');
    }

    const toastElement = $(`#${toastId}`);
    if (toastElement.length === 0) {
        return console.warn(`Toast with ID ${toastId} not found.`);
    }

    const toastInstance = bootstrap.Toast.getInstance(toastElement[0]);
    if (!toastInstance) {
        return console.warn(`No toast instance found for ID ${toastId}.`);
    }

    toastInstance.hide();
}
export { showToastFeedback, showProcessToast, hideProcessToast };
