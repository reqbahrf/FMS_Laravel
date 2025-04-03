import createConfirmationModal from './confirmation-modal';
import { processError } from './error-handler-util';
import {
    hideProcessToast,
    showProcessToast,
    showToastFeedback,
} from './feedback-toast';

export default class ChangePassword {
    private form: JQuery<HTMLFormElement>;
    constructor(form: JQuery<HTMLFormElement>) {
        this.form = form;
        this.init();
    }

    public init() {
        this.form.on('submit', (e) => {
            e.preventDefault();
            this.resetPassword();
        });
        this.initPasswordToggle();
    }

    private async resetPassword() {
        const isConfirmed = await createConfirmationModal({
            title: 'Confirm Password Reset',
            message: 'Are you sure you want to reset your password?',
            confirmText: 'Yes',
            cancelText: 'No',
        });
        if (!isConfirmed) return;
        const processToast = showProcessToast('Resetting Password...');
        try {
            const response = await $.ajax({
                url: '/change-password',
                type: 'POST',
                data: this.form.serialize(),
                headers: {
                    'X-CSRF-TOKEN':
                        $('meta[name="csrf-token"]').attr('content') || '',
                },
            });

            if (response.success) {
                hideProcessToast(processToast);
                showToastFeedback(
                    'text-bg-success',
                    response.message || 'Password reset successfully'
                );
            }
        } catch (error: any) {
            hideProcessToast(processToast);
            const errorResponse = error.responseJSON;
            if (errorResponse && errorResponse.errors) {
                const errorMessages = Object.values(errorResponse.errors)
                    .flat()
                    .join('\n');
                showToastFeedback('text-bg-danger', errorMessages);
            } else {
                processError('Error resetting password: ', error);
            }
        }
    }

    private initPasswordToggle() {
        console.log(this.form);
        this.form.on('click', '.password-toggle', (e) => {
            const icon = $(e.currentTarget);
            const input = icon.closest('.input-group').find('input');

            // Toggle between password and text type
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.find('i')
                    .removeClass('ri-eye-off-line')
                    .addClass('ri-eye-line');
            } else {
                input.attr('type', 'password');
                icon.find('i')
                    .removeClass('ri-eye-line')
                    .addClass('ri-eye-off-line');
            }
        });
    }
}
