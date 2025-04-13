import createConfirmationModal from './Utilities/confirmation-modal';
import {
    showProcessToast,
    hideProcessToast,
    showToastFeedback,
} from './Utilities/feedback-toast';
const newFileUpload = document.querySelector('#updateFile');
const pondInstance = FilePond.create(newFileUpload, {
    allowMultiple: false,
    allowFileTypeValidation: true,
    allowFileSizeValidation: true,
    maxFileSize: '10MB',
    instantUpload: false,
});

const updateForm = $('#updateFileForm');
const submitBtn = $('#updateFileSubmit');
const updateFileModal = new bootstrap.Modal($('#updateFileModal'));

$('#requirementsTableBody').on(
    'click',
    '[data-bs-target="#updateFileModal"]',
    function () {
        const fileType = $(this).closest('tr').find('td:nth-child(2)').text();
        const FileId = $(this).data('id');
        const FileLink = $(this).data('file-link');

        updateForm.find('#file_id').val(FileId);
        updateForm.find('#file_link').val(FileLink);

        pondInstance.setOptions({
            acceptedFileTypes: [
                fileType === 'pdf' ? 'application/pdf' : 'image/*',
            ],
        });
    }
);
$('#updateFileSubmit').click(function () {
    updateFileModal.hide();
    updateForm.submit();
});

updateForm.on('submit', async function (e) {
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
    const file = pondInstance.getFiles()[0].file;
    formData.append('file', file);
    formData.append('_method', 'PUT');

    $.ajax({
        url: UPDATEFILE.replace(':id', updateForm.find('#file_id').val()),
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
    updateForm.submit();
});
