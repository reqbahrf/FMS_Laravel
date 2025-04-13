import createConfirmationModal from './Utilities/confirmation-modal';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from './Utilities/feedback-toast';
const newFileUpload = document.querySelector('#updateFile');
const FILE_POND_INSTANCE = {
    updateRequirement: null,
    uploadAdditional: null,
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
const UPDATE_FORM = UPDATE_MODAL_ELEMENT.find('#updateFileForm');
const SUBMIT_BTN = UPDATE_MODAL_ELEMENT.find('#updateFileSubmit');
const UPDATE_FILE_MODAL = new bootstrap.Modal(UPDATE_MODAL_ELEMENT);

UPDATE_MODAL_ELEMENT.on('show.bs.modal', () => {
    FILE_POND_INSTANCE.updateRequirement = initializeFilePond(newFileUpload);
});

UPDATE_MODAL_ELEMENT.on('hide.bs.modal', () => {
    FILE_POND_INSTANCE.updateRequirement.destroy();
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
    const file = FILE_POND_INSTANCE.updateRequirement.getFiles()[0].file;
    formData.append('file', file);
    formData.append('_method', 'PUT');

    $.ajax({
        url: UPDATEFILE.replace(':id', UPDATE_FORM.find('#file_id').val()),
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
