import createConfirmationModal from './Utilities/confirmation-modal';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from './Utilities/feedback-toast';
const newFileUpload = document.querySelector('#updateFile');
const newFileUploadAdditional = document.querySelector('#uploadFile');
const FILE_POND_INSTANCE = {
    updateRequirement: null,
    uploadAdditional: null,
};

const ID = {
    file_id: null,
    business_id: null,
    application_id: null,
};

const initializeFilePond = (newFileUpload) => {
    return FilePond.create(newFileUpload, {
        allowMultiple: false,
        allowFileTypeValidation: true,
        allowFileSizeValidation: true,
        maxFileSize: '10MB',
        allowedFileTypes: ['application/pdf', 'image/*'],
        instantUpload: false,
    });
};

const UPDATE_MODAL_ELEMENT = $('#updateFileModal');
const UPLOAD_NEW_REQUIRED_FILE_ELEMENT = $('#fileUploadModal');
const UPDATE_FORM = UPDATE_MODAL_ELEMENT.find('#updateFileForm');
const SUBMIT_BTN = UPDATE_MODAL_ELEMENT.find('#updateFileSubmit');
const UPLOAD_NEW_REQUIRED_FILE_FORM =
    UPLOAD_NEW_REQUIRED_FILE_ELEMENT.find('#fileUploadForm');
const UPLOAD_NEW_REQUIRED_FILE_MODAL = new bootstrap.Modal(
    UPLOAD_NEW_REQUIRED_FILE_ELEMENT
);
const UPDATE_FILE_MODAL = new bootstrap.Modal(UPDATE_MODAL_ELEMENT);

UPDATE_MODAL_ELEMENT.on('show.bs.modal', () => {
    FILE_POND_INSTANCE.updateRequirement = initializeFilePond(newFileUpload);
});

UPLOAD_NEW_REQUIRED_FILE_ELEMENT.on('show.bs.modal', (e) => {
    FILE_POND_INSTANCE.uploadAdditional = initializeFilePond(
        newFileUploadAdditional
    );
    ID.file_id = $(e.relatedTarget).data('id');
    ID.business_id = $(e.relatedTarget).data('business-id');
    ID.application_id = $(e.relatedTarget).data('application-id');
});

UPDATE_MODAL_ELEMENT.on('hide.bs.modal', () => {
    FILE_POND_INSTANCE.updateRequirement.destroy();
});

UPLOAD_NEW_REQUIRED_FILE_ELEMENT.on('hide.bs.modal', () => {
    FILE_POND_INSTANCE.uploadAdditional.destroy();
    ID.file_id = null;
    ID.business_id = null;
    ID.application_id = null;
});

$('#requirementsTableBody').on(
    'click',
    '[data-bs-target="#updateFileModal"]',
    function () {
        const fileType = $(this).closest('tr').find('td:nth-child(2)').text();
        const FileId = $(this).data('id');
        const FileLink = $(this).data('file-link');

        UPDATE_FORM.find('#file_id').val(FileId);
        UPDATE_FORM.find('#file_link').val(FileLink);

        FILE_POND_INSTANCE.updateRequirement.setOptions({
            acceptedFileTypes: [
                fileType === 'pdf' ? 'application/pdf' : 'image/*',
            ],
        });
    }
);
$('#updateFileSubmit').click(function () {
    UPDATE_MODAL_ELEMENT.hide();
    UPDATE_FORM.submit();
});

$('#fileUploadSubmit').click(function () {
    UPLOAD_NEW_REQUIRED_FILE_ELEMENT.hide();
    UPLOAD_NEW_REQUIRED_FILE_FORM.submit();
});

UPLOAD_NEW_REQUIRED_FILE_FORM.on('submit', async function (e) {
    e.preventDefault();
    const isConfirmed = await createConfirmationModal({
        title: 'Upload New File',
        titleBg: 'bg-primary',
        message: 'Are you sure you want to upload this file?',
        confirmText: 'Yes',
        cancelText: 'No',
    });

    if (!isConfirmed) return;

    const processToast = showProcessToast('Uploading File...');
    const formData = new FormData(this);
    const file = FILE_POND_INSTANCE.uploadAdditional.getFiles()[0].file;
    formData.append('file', file);
    formData.append('_method', 'PUT');

    $.ajax({
        url: REQUIREMENT_ROUTE.UPLOAD_NEW_REQUIRED_FILE,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showToastFeedback('text-bg-success', response.success);
            hideProcessToast(processToast);
            window.location.reload();
        },
        error: function (xhr, status, error) {
            console.log(error);
            showToastFeedback('text-bg-danger', error);
            hideProcessToast(processToast);
        },
    });
});

UPDATE_FORM.on('submit', async function (e) {
    e.preventDefault();
    const isConfirmed = await createConfirmationModal({
        title: 'Update File',
        titleBg: 'bg-primary',
        message: 'Are you sure you want to update this file?',
        confirmText: 'Yes',
        cancelText: 'No',
    });

    if (!isConfirmed) return;

    const processToast = showProcessToast('Updating File...');
    const formData = new FormData(this);
    const fileId = UPDATE_FORM.find('#file_id').val();
    const file = FILE_POND_INSTANCE.updateRequirement.getFiles()[0].file;
    formData.append('file', file);
    formData.append('_method', 'PUT');

    $.ajax({
        url: REQUIREMENT_ROUTE.UPDATE_FILE.replace(':id', fileId),
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showToastFeedback('text-bg-success', response.success);
            hideProcessToast(processToast);
            window.location.reload();
        },
        error: function (xhr, status, error) {
            console.log(error);
            showToastFeedback('text-bg-danger', error);
            hideProcessToast(processToast);
        },
    });
});

$('#confirmUpdate').click(function () {
    UPDATE_FORM.submit();
});
