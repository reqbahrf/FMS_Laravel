import createConfirmationModal from '../Utilities/confirmation-modal';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../Utilities/utilFunctions';
export default class ProjectSettings {
    private ProjectSettingsForm: JQuery<HTMLFormElement>;
    constructor() {
        this.ProjectSettingsForm = $('#projectSettingsForm');
        this.initializeProjectSettings();
    }

    private initializeProjectSettings(): void {
        this.ProjectSettingsForm.on('submit', async function (event) {
            event.preventDefault();
            const isConfirmed = await createConfirmationModal({
                title: 'Update Project Settings',
                titleBg: 'bg-primary',
                message:
                    'Are you sure you want to update the project settings?',
                confirmText: 'Yes',
                confirmButtonClass: 'btn-primary',
                cancelText: 'No',
            });
            if (!isConfirmed) {
                return;
            }

            showProcessToast('Updating Project Settings...');
            try {
                const formData = new FormData(this);
                const response = await $.ajax({
                    type: 'POST',
                    url: PROJECT_SETTINGS_ROUTE.UPDATE_PROJECT_SETTINGS,
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
