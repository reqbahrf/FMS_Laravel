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
    position?: 'center' | 'top' | 'bottom';
    fullscreen?: boolean | 'sm' | 'md' | 'lg' | 'xl' | 'xxl';
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
 * @param {string} [options.position='center'] - Position of the modal ('center', 'top', 'bottom')
 * @param {boolean|string} [options.fullscreen=false] - Make modal fullscreen (true or breakpoint: 'sm', 'md', 'lg', 'xl', 'xxl')
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
 *
 * @example
 * // Predefined positions
 * const result = await createConfirmationModal({
 *     title: 'Top Modal',
 *     position: 'top' // 'center', 'top', 'bottom'
 * });
 *
 * @example
 * // Fullscreen modal
 * const result = await createConfirmationModal({
 *     title: 'Fullscreen Modal',
 *     fullscreen: true
 * });
 *
 * @example
 * // Responsive fullscreen modal (fullscreen below lg breakpoint)
 * const result = await createConfirmationModal({
 *     title: 'Responsive Modal',
 *     fullscreen: 'lg'
 * });
 */
function createConfirmationModal(
    options: ConfirmationModalOptions = {}
): Promise<boolean> {
    const {
        title = 'Confirm Action',
        titleBg = 'bg-primary',
        message = 'Are you sure you want to proceed?',
        confirmText = 'Confirm',
        cancelText = 'Cancel',
        confirmButtonClass = 'btn-primary',
        size = '',
        position = 'center',
        fullscreen = false,
    } = options;

    $('#confirmationModal').remove();

    let positionClass = '';
    let modalContentStyle = '';

    if (position === 'center') {
        positionClass = 'modal-dialog-centered';
    } else if (position === 'top') {
        modalContentStyle = 'margin-top: 0;';
    } else if (position === 'bottom') {
        modalContentStyle = 'margin-top: auto; margin-bottom: 0;';
    }

    let fullscreenClass = '';
    if (fullscreen === true) {
        fullscreenClass = 'modal-fullscreen';
    } else if (typeof fullscreen === 'string') {
        fullscreenClass = `modal-fullscreen-${fullscreen}-down`;
    }

    const modalHTML = /*html*/ `
        <div class="modal fade" style="z-index: 2000 !important;" data-bs-backdrop="static" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog ${size} ${positionClass} ${fullscreenClass}">
                <div class="modal-content" style="${modalContentStyle}">
                    <div class="modal-header ${titleBg}">
                        <h1 class="modal-title text-white" id="confirmationModalLabel">${sanitize(
                            title
                        )}</h1>
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

    $('body').append(modalHTML);

    return new Promise((resolve) => {
        const modalElement = document.getElementById('confirmationModal');
        if (!modalElement)
            return console.warn(
                `No modal element found with id #confirmationModal`
            );
        const modal = new bootstrap.Modal(modalElement);

        $('#confirmActionBtn').on('click', () => {
            modal.hide();
            resolve(true);
        });

        modalElement.addEventListener('hidden.bs.modal', () => {
            $('#confirmationModal').remove();
            resolve(false);
        });

        modal.show();
    });
}

export default createConfirmationModal;
