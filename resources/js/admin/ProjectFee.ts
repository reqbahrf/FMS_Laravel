import createConfirmationModal from '../Utilities/confirmation-modal';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../Utilities/utilFunctions';
export default class ProjectFee {
    private ProjectFeeForm: JQuery<HTMLFormElement>;
    constructor() {
        this.ProjectFeeForm = $('#projectFeeForm');
        this.initializeProjectFee();
    }

    private initializeProjectFee(): void {
        this.ProjectFeeForm.on('submit', async function (event) {
            event.preventDefault();
            const isConfirmed = await createConfirmationModal({
                title: 'Update Project Fee',
                titleBg: 'bg-primary',
                message: 'Are you sure you want to update the project fee?',
                confirmText: 'Yes',
                confirmButtonClass: 'btn-primary',
                cancelText: 'No',
            });
            if (!isConfirmed) {
                return;
            }
            showProcessToast('Updating Project Fee...');
            try {
                const formData = new FormData(this);
                const response = await $.ajax({
                    type: 'POST',
                    url: PROJECT_SETTINGS_ROUTE.UPDATE_PROJECT_FEE,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                    processData: false, // Don't process the data
                    contentType: false, // Let jQuery set the content type based on formData
                    data: formData,
                });
                hideProcessToast();
                showToastFeedback('text-bg-success', response.message);
            } catch (error: any) {
                hideProcessToast();
                showToastFeedback(
                    'text-bg-danger',
                    error?.responseJSON?.message ||
                        error?.message ||
                        'Error in updating project fee'
                );
            }
        });
    }
}
