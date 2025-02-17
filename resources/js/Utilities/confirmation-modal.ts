import { sanitize } from './utilFunctions';
import * as bootstrap from 'bootstrap';
interface ConfirmationModalOptions {
    title?: string;
    titleBg?: string;
    message?: string;
    confirmText?: string;
    cancelText?: string;
    confirmButtonClass?: string;
    size?: string;
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

export default createConfirmationModal;
