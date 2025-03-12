import * as DataTables from 'datatables.net';
import { customDateFormatter, closeModal } from '../Utilities/utilFunctions';
import createConfirmationModal from '../Utilities/confirmation-modal';
import {
    hideProcessToast,
    showProcessToast,
    showToastFeedback,
} from '../Utilities/feedback-toast';
import { InitializeFilePond } from '../Utilities/FilepondHandlers';
import { FilePond } from 'filepond';

interface ProjectFileItem {
    id: number;
    file_name: string;
    is_external: boolean;
    file_link: string;
    access_url: string | null;
    created_at: string;
    updated_at: string;
}
export default class FileCoopRequirementHandler {
    private requirementContainer: JQuery<HTMLElement>;
    private actionModal: JQuery<HTMLElement>;
    private filePondInstance: FilePond | null;
    constructor() {
        this.requirementContainer = $('#requirementModal');
        this.actionModal = $('#projectLinkUpdateModal');
        this.filePondInstance = null;
    }

    private static projectlinkDataTable: DataTables.Api = $(
        '#linkTable'
    ).DataTable({
        autoWidth: false,
        columns: [
            {
                title: 'File Name',
            },
            {
                title: 'Link',
            },
            {
                title: 'Date Created',
            },
            {
                title: 'Action',
                className: 'text-center',
            },
        ],
        columnDefs: [
            {
                targets: 0,
                width: '15%',
            },
            {
                targets: 1,
                width: '40%',
            },
            {
                targets: 2,
                width: '20%',
            },
            {
                targets: 3,
                width: '10%',
            },
        ],
    });

    private async _getProjectLinks(project_id: string) {
        try {
            const response = await $.ajax({
                type: 'GET',
                url:
                    DASHBOARD_TAB_ROUTE.GET_PROJECT_LINKS +
                    '?project_id=' +
                    project_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            });
            FileCoopRequirementHandler.projectlinkDataTable.clear();
            FileCoopRequirementHandler.projectlinkDataTable.rows.add(
                response.data.map((item: ProjectFileItem) => {
                    // For internal files, create a route to view the file using its ID
                    const viewButton = item.is_external
                        ? item.file_link.match(/^https?:\/\//i)
                            ? /*html*/ `<a
                                  class="btn btn-outline-primary btn-sm"
                                  target="_blank"
                                  href="${item.file_link}"
                                  ><i class="ri-eye-fill"></i
                              ></a>`
                            : /*html*/ `<a
                                  class="btn btn-outline-primary btn-sm"
                                  target="_blank"
                                  href="https://${item.file_link}"
                                  ><i class="ri-eye-fill"></i
                              ></a>`
                        : /*html*/ `<a
                              class="btn btn-outline-primary btn-sm"
                              target="_blank"
                              href="${item.access_url}"
                              ><i class="ri-eye-fill"></i
                          ></a>`;

                    return [
                        /*html*/ `${item.file_name}
                            <input
                                type="hidden"
                                class="linkID"
                                value="${item.id}"
                            />`,
                        item.is_external
                            ? `<span class="badge badge-pill bg-secondary ml-2">External</span>&nbsp;${item.file_link} `
                            : `<span class="badge badge-pill bg-primary ml-2">Internal</span>&nbsp;Internal Saved File `,
                        customDateFormatter(item.created_at),
                        /*html*/ `${viewButton}
                            <button
                                class="btn btn-primary btn-sm updateLinkRecord"
                                data-is-external="${item.is_external}"
                                data-bs-toggle="modal"
                                data-bs-target="#projectLinkUpdateModal"
                            >
                                <i class="ri-pencil-fill"></i>
                            </button>
                            <button
                                class="btn btn-danger btn-sm deleteRecord"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteRecordModal"
                                data-delete-record-type="projectLink"
                            >
                                <i class="ri-delete-bin-6-fill"></i>
                            </button>`,
                    ];
                })
            );
            FileCoopRequirementHandler.projectlinkDataTable.draw();
        } catch (error: any) {
            throw new Error(
                'Error fetching project links: ' +
                    error?.responseJSON?.message || error?.responseJSON?.error
            );
        }
    }

    private async _saveProjectFileLink(project_id: string, action: string) {
        try {
            showProcessToast('Saving Project Link...');
            let requirementLinks: { [key: string]: string } = {};
            const linkContainer =
                this.requirementContainer.find('.linkContainer');
            linkContainer.each(function () {
                let name = $(this)
                    .find('input[name="requirements_name"]')
                    .val();
                let link = $(this)
                    .find('input[name="requirements_link"]')
                    .val();
                requirementLinks[name as string] = link as string;
            });

            const response = await $.ajax({
                type: 'POST',
                url: DASHBOARD_TAB_ROUTE.STORE_PROJECT_FILES,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                data: {
                    action: action,
                    project_id: project_id,
                    linklist: requirementLinks,
                },
            });

            this._getProjectLinks(project_id);
            closeModal('#projectLinkUpdateModal');
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
        } catch (error: any) {
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.responseJSON?.error ||
                    'An unexpected error occurred. Please try again later.'
            );
        }
    }

    private async _saveProjectFile(
        project_id: string,
        action: string,
        business_id: string
    ) {
        try {
            showProcessToast('Saving Project File...');
            const name = this.requirementContainer
                .find('#requirements_file_name')
                .val();
            const file_path = this.requirementContainer
                .find('#requirements_link')
                .val();
            const response = await $.ajax({
                type: 'POST',
                url: DASHBOARD_TAB_ROUTE.STORE_PROJECT_FILES,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                data: {
                    action: action,
                    business_id: business_id,
                    project_id: project_id,
                    name: name,
                    file_path: file_path,
                },
            });
            this._getProjectLinks(project_id);
            closeModal('#requirementModal');
            hideProcessToast();
            showToastFeedback('text-bg-success', response.message);
            //toggleRequirementUploadType();
        } catch (error: any) {
            hideProcessToast();
            showToastFeedback(
                'text-bg-danger',
                error?.responseJSON?.message ||
                    error?.responseJSON?.error ||
                    'An unexpected error occurred. Please try again later.'
            );
        }
    }
    private _toggleRequirementUploadType() {
        const self = this;
        const uploadTypeRadios = $('[name="requirement_upload_type"]');
        const linkContainer = $('.linkContainer');
        const fileContainer = $('.FileContainer');
        const saveButton = $('button[data-selected-action]');

        // Remove any existing event listeners first
        uploadTypeRadios.off('change');

        // Reset containers and inputs to initial state
        linkContainer.show();
        fileContainer.hide();
        saveButton.attr('data-selected-action', 'ProjectLink');

        // Reset all inputs
        $('#requirements_name').val('');
        $('#requirements_link').val('');
        $('#requirements_file').val('');
        $('#requirements_file_name').val('');

        // Re-add event listeners
        uploadTypeRadios.on('change', function () {
            const instance = this as HTMLInputElement;
            if (instance.value === 'link') {
                linkContainer.show();
                fileContainer.hide();
                self.filePondInstance?.destroy();

                // Reset file input
                $('#requirements_file').val('');
                $('#requirements_file_name').val('');

                // Update save button action
                saveButton.attr('data-selected-action', 'ProjectLink');
            } else {
                linkContainer.hide();
                fileContainer.show();

                self.filePondInstance = InitializeFilePond(
                    'requirements_file',
                    {
                        allowMultiple: false,
                        allowFileTypeValidation: true,
                        allowFileSizeValidation: true,
                        acceptedFileTypes: ['application/pdf', 'image/*'],
                        allowRevert: true,
                        maxFileSize: '15MB',
                    },
                    'uploaded_requirement_unique_id'
                );

                // Reset link inputs
                $('#requirements_name').val('');
                $('#requirements_link').val('');

                // Update save button action
                saveButton.attr('data-selected-action', 'ProjectFile');
            }
        });
    }

    private _initEventListener() {
        const self = this;
        this.requirementContainer.on(
            'blur',
            'input[name="requirements_link"]',
            async function () {
                const linkConstInstance = $(this).closest('.linkContainer');
                const inputField = $(this);
                const inputtedLink = $(this).val();
                const proxyUrl = `/proxy?url=${encodeURIComponent(
                    inputtedLink
                )}`;

                if (inputtedLink) {
                    const spinner = /*html*/ `<div
                        class="spinner-border spinner-border-sm text-primary ms-3"
                        role="status"
                        style="width: 1rem; height: 1rem; border-width: 2px; border-radius: 50%;"
                    >
                        <span class="visually-hidden"></span>
                    </div>`;

                    inputField.after(spinner);
                    try {
                        const response = await fetch(proxyUrl);
                        const data = await response.json();
                        if (data.status === 200) {
                            linkConstInstance
                                .find('input[name="requirements_link"]')
                                .addClass('is-valid')
                                .removeClass('is-invalid');
                        } else {
                            linkConstInstance
                                .find('input[name="requirements_link"]')
                                .addClass('is-invalid')
                                .removeClass('is-valid');
                        }
                    } catch (error) {
                        console.warn('Error fetching the link:', error);
                        linkConstInstance
                            .find('input[name="requirements_link"]')
                            .addClass('is-invalid')
                            .removeClass('is-valid');
                    } finally {
                        linkConstInstance.find('.spinner-border').remove();
                    }
                } else {
                    linkConstInstance
                        .find('input[name="requirements_link"]')
                        .removeClass(['is-valid', 'is-invalid']);
                }
            }
        );

        this.requirementContainer
            .find('button[data-selected-action]')
            .on('click', async function () {
                let action = $(this).attr('data-selected-action');
                const projectID = $('#ProjectID').val() as string;
                const businesID = $('input#hiddenbusiness_id').val() as string;

                const isConfirmed = await createConfirmationModal({
                    title: 'Save Requirements',
                    titleBg: 'bg-primary',
                    message: 'Are you sure you want to save this requirements?',
                    confirmText: 'Yes',
                    confirmButtonClass: 'btn-primary',
                    cancelText: 'No',
                });
                if (!isConfirmed) {
                    return;
                }
                action === 'ProjectLink'
                    ? self._saveProjectFileLink(projectID, action)
                    : action === 'ProjectFile'
                      ? self._saveProjectFile(projectID, action, businesID)
                      : null;
            });

        this.requirementContainer
            .find('button#UpdateProjectLink')
            .on('click', async function () {
                try {
                    const projectID = $('#ProjectID').val() as string;
                    const updatedProjectLinks =
                        $('#projectLinkForm').serialize();
                    const file_id = $(
                        'input#HiddenFileIDToUpdate'
                    ).val() as string;

                    const isConfirmed = await createConfirmationModal({
                        title: 'Update Requirements',
                        titleBg: 'bg-primary',
                        message:
                            'Are you sure you want to update this requirements?',
                        confirmText: 'Yes',
                        confirmButtonClass: 'btn-primary',
                        cancelText: 'No',
                    });

                    if (!isConfirmed) {
                        return;
                    }

                    showProcessToast('Updating...');

                    const response = await $.ajax({
                        type: 'PUT',
                        url: DASHBOARD_TAB_ROUTE.UPDATE_PROJECT_LINKS.replace(
                            ':file_id',
                            file_id
                        ),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'
                            ),
                        },
                        data: updatedProjectLinks + '&project_id=' + projectID,
                    });

                    self._getProjectLinks(projectID);
                    closeModal('#projectLinkUpdateModal');
                    hideProcessToast();
                    showToastFeedback('text-bg-success', response.message);
                    //toggleRequirementUploadType();
                } catch (error: any) {
                    hideProcessToast();
                    showToastFeedback(
                        'text-bg-danger',
                        error?.responseJSON?.message ||
                            error?.responseJSON?.error ||
                            'An unexpected error occurred. Please try again later.'
                    );
                }
            });

        this.actionModal.on('show.bs.modal', function (event: any) {
            const triggeredbutton = $(event.relatedTarget);
            const selectedRow = triggeredbutton.closest('tr');
            const is_external = triggeredbutton.attr('data-is-external');

            const file_id = selectedRow.find('input.linkID').val() as string;
            const projectName = selectedRow.find('td:eq(0)').text().trim();

            console.log(is_external);
            // Extract only the link part, excluding the badge
            let projectLink = '';
            if (is_external == 'true') {
                // For external links, get the text after the badge
                const cellContent = selectedRow.find('td:eq(1)').text();
                projectLink = cellContent.split('External')[1].trim();
            } else {
                // For internal files, we don't need to extract the actual link
                projectLink = 'Internal Saved File';
            }

            const modal = $(this);
            modal.find('input#HiddenFileIDToUpdate').val(file_id);
            modal.find('input#HiddenProjectNameToUpdate').val(projectName);
            modal.find('input#projectNameUpdated').val(projectName);
            modal
                .find('textarea#projectLink')
                .val(projectLink)
                .prop('readonly', is_external == '1' ? false : true);
        });
    }
}
