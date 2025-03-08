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
function showProcessToast(message = 'Processing...'): void {
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
function hideProcessToast(): void {
    const toastInstance = bootstrap.Toast.getInstance(ProcessToast[0]);
    if (!toastInstance) {
        return console.warn('No process toast instance found.');
    }
    toastInstance.hide();
}
export { showToastFeedback, showProcessToast, hideProcessToast };
