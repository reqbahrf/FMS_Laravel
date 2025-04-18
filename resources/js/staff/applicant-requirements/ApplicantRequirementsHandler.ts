import * as bootstrap from 'bootstrap';
import { processError } from '../../Utilities/error-handler-util';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from '../../Utilities/feedback-toast';
import createConfirmationModal from '../../Utilities/confirmation-modal';
import {
    customDateFormatter,
    sanitizeNullableString,
} from '../../Utilities/utilFunctions';
export default class ApplicantRequirementsHandler {
    private reviewForm: JQuery<HTMLFormElement>;
    private businessId: string | null;
    private applicationId: string | null;
    constructor(
        private requirementTable: JQuery<HTMLTableElement>,
        private reviewFileModal: JQuery<HTMLElement>
    ) {
        this.businessId = null;
        this.applicationId = null;
        this.requirementTable = requirementTable;
        this.reviewFileModal = reviewFileModal;
        this.reviewForm = reviewFileModal.find('#reviewedFileForm');
    }
    public setId(businessId: string, applicationId: string) {
        this.businessId = businessId;
        this.applicationId = applicationId;
        return this;
    }

    public async getApplicantRequirements() {
        try {
            if (!this.businessId) return;
            const response = await $.ajax({
                type: 'GET',
                url: APPLICANT_TAB_ROUTE.GET_APPLICANT_REQUIREMENTS.replace(
                    ':id',
                    this.businessId
                ),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });
            this._populateReqTable(response);
        } catch (error: any) {
            processError(
                'Error in getting applicant requirements',
                error.message || error,
                false
            );
        }
    }

    private _populateReqTable(response: any) {
        this.requirementTable.empty();
        this.cleanUpEventListeners();
        $.each(response, (index, requirement) => {
            const row = $('<tr>');
            row.append('<td>' + requirement.file_name + '</td>');
            row.append(
                '<td>' + sanitizeNullableString(requirement.file_type) + '</td>'
            );
            row.append(/*html*/ `<td class="text-center">
                <span class="badge bg-${(() => {
                    switch (requirement.remarks) {
                        case 'Approved':
                            return 'success';
                        case 'Pending':
                            return 'secondary';
                        case 'For Submission':
                            return 'info';
                        default:
                            return 'danger';
                    }
                })()}">${requirement.remarks}</span>
                </td>`);
            row.append(/*html*/ `<td class="text-center">
                            <button
                                class="btn btn-primary viewReq position-relative btn-sm"
                                ${requirement.remarks === 'For Submission' ? 'disabled' : ''}
                            >
                            <i class="ri-eye-line"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-2 ${
                                    requirement.remarks === 'Pending'
                                        ? 'bg-info'
                                        : requirement.remarks === 'Approved'
                                          ? 'bg-primary'
                                          : 'bg-danger'
                                } border border-light rounded-circle"
                            >
                                <span class="visually-hidden"
                                    >New alerts</span
                                >
                            </span>
                            </button>
                            <button class="btn btn-sm btn-danger">
                            <i class="ri-delete-bin-2-line"></i>
                            </button>
                        </td>`);
            row.append(
                '<input type="hidden"  name="file_id" value="' +
                    requirement.id +
                    '">'
            );
            row.append(
                '<input type="hidden"  name="file_url" value="' +
                    requirement.full_url +
                    '">'
            );
            row.append(
                '<input type="hidden"  name="can_edit" value="' +
                    requirement.can_edit +
                    '">'
            );
            row.append(
                '<input type="hidden"  name="remark" value="' +
                    requirement.remarks +
                    '">'
            );
            row.append(
                '<input type="hidden"  name="remark_comments" value="' +
                    requirement.remark_comments +
                    '">'
            );
            row.append(
                '<input type="hidden"  name="created_at" value="' +
                    requirement.created_at +
                    '">'
            );
            row.append(
                '<input type="hidden"  name="updated_at" value="' +
                    requirement.updated_at +
                    '">'
            );
            this.requirementTable.append(row);
        });
        this.initializeEventListeners();
    }

    public initializeEventListeners() {
        const reviewFileModal = this.reviewFileModal;
        const reviewForm = this.reviewForm;
        const retrieveAndDisplayFile = this._retrieveAndDisplayFile.bind(this);
        const getApplicantRequirements =
            this.getApplicantRequirements.bind(this);
        this.requirementTable.on('click', '.viewReq', async function (event) {
            const processToast = showProcessToast('Retrieving file...');
            try {
                const row = $(this).closest('tr');
                const fileID = row
                    .find('input[type="hidden"][name="file_id"]')
                    .val() as string;
                const file_Name = row.find('td:nth-child(1)').text() as string;
                const fileUrl = row
                    .find('input[type="hidden"][name="file_url"]')
                    .val() as string;
                const fileType = row.find('td:nth-child(2)').text() as string;
                const uploadedDate = row
                    .find('input[type="hidden"][name="created_at"]')
                    .val() as string;
                const updatedDate = row
                    .find('input[type="hidden"][name="updated_at"]')
                    .val() as string;
                const uploader = $('#contact_person').val() as string;
                const remarkComments = row
                    .find('input[type="hidden"][name="remark_comments"]')
                    .val();

                const reviewFileModalInput =
                    reviewFileModal.find('input, textarea');

                reviewFileModalInput.filter('#selectedFile_ID').val(fileID);
                reviewFileModalInput.filter('#fileName').val(file_Name);
                reviewFileModalInput.filter('#filetype').val(fileType);
                reviewFileModalInput.filter('#file_url').val(fileUrl);
                reviewFileModalInput
                    .filter('#fileUploaded')
                    .val(customDateFormatter(uploadedDate));
                reviewFileModalInput
                    .filter('#fileUpdated')
                    .val(customDateFormatter(updatedDate));
                reviewFileModalInput.filter('#fileUploadedBy').val(uploader);
                reviewFileModalInput
                    .filter('#remark_comments')
                    .val(sanitizeNullableString(remarkComments));
                await retrieveAndDisplayFile(fileUrl, fileType);
            } catch (error) {
                processError(
                    'Error in getting applicant requirements',
                    error,
                    false
                );
            } finally {
                hideProcessToast(processToast);
            }
        });

        reviewForm.on('submit', async function (event: JQuery.SubmitEvent) {
            event.preventDefault();
            const submitter = (event.originalEvent as SubmitEvent).submitter as
                | HTMLElement
                | undefined;
            const action = submitter ? $(submitter).val() : undefined;

            const selected_id = reviewFileModal
                .find('input[type="hidden"]#selectedFile_ID')
                .val() as string;
            const isconfimed = await createConfirmationModal({
                title: 'Review File',
                titleBg: 'bg-primary',
                message: `Are you sure you want to ${action} this file?`,
                confirmText: 'Yes',
                confirmButtonClass: 'btn-primary',
                cancelText: 'No',
            });
            if (!isconfimed) {
                return;
            }
            const processToast = showProcessToast();
            const formData = reviewForm.serialize() + '&action=' + action;
            try {
                const response = await $.ajax({
                    method: 'PUT',
                    url: APPLICANT_TAB_ROUTE.UPDATE_APPLICANT_REQUIREMENTS.replace(
                        ':id',
                        selected_id
                    ),
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                    processData: false,
                });
                hideProcessToast(processToast);
                setTimeout(() => {
                    showToastFeedback('text-bg-success', response.success);
                }, 500);
                await getApplicantRequirements();
            } catch (error: any) {
                processError(
                    'Error in updating applicant requirement',
                    error,
                    true
                );
            } finally {
                hideProcessToast(processToast);
            }
        });
    }

    private async _retrieveAndDisplayFile(fileUrl: string, fileType: string) {
        const reviewFileModal = this.reviewFileModal;
        const fileContent = reviewFileModal.find('#fileContent');
        fileContent.empty();
        return new Promise((resolve, reject) => {
            try {
                if (fileType === 'pdf') {
                    const embed = $('<iframe>', {
                        src: fileUrl,
                        type: 'application/pdf',
                        width: '100%',
                        height: '100%',
                        frameborder: '0',
                        allow: 'fullscreen',
                    });

                    embed.on('load', function () {
                        resolve(true);
                    });

                    embed.on('error', function () {
                        reject(new Error('Failed to load PDF'));
                    });

                    fileContent.append(embed);
                } else {
                    const img = $('<img>', {
                        src: fileUrl,
                        class: 'img-fluid',
                    });
                    img.on('load', function () {
                        resolve(true);
                    });
                    img.on('error', function () {
                        reject(new Error('Failed to load image'));
                    });

                    fileContent.append(img);
                }

                // Show the modal
                const reviewFileModal = new bootstrap.Modal(
                    this.reviewFileModal[0]
                );
                reviewFileModal.show();
            } catch (error) {
                reject(
                    new Error('Error in file retrieval and display: ' + error)
                );
            }
        });
    }

    private cleanUpEventListeners() {
        this.requirementTable.off('click', '.viewReq');
        this.reviewForm[0].reset();
        this.reviewForm.off('submit');
    }
}
