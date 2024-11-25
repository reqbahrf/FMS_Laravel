function showToastFeedback(status, message) {
    const toast = $("#ActionFeedbackToast");
    const toastInstance = new bootstrap.Toast(toast);

    toast
        .find(".toast-header")
        .removeClass([
            "text-bg-danger",
            "text-bg-success",
            "text-bg-warning",
            "text-bg-info",
            "text-bg-primary",
            "text-bg-light",
            "text-bg-dark",
        ]);

    toast.find(".toast-body").text("");
    toast.find(".toast-header").addClass(status);
    toast.find(".toast-body").text(message);

    toastInstance.show();
}

/**
 * Formats a number value to a string with a fixed number of decimal places.
 *
 * @param {number} value - The number to be formatted.
 * @returns {string} The formatted number as a string with exactly 2 decimal places.
 */
const formatToString = (value) => {
    return value.toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
};

const dateFormatter = (date) => {
    const hasTime = /\d{1,2}:\d{2}/.test(date);

    const dateObj = new Date(date);

    const dateOptions = {
        month: "short",
        day: "2-digit",
        year: "2-digit",
    };
    if (hasTime) {
        dateOptions.hour = "numeric";
        dateOptions.minute = "2-digit";
        dateOptions.hour12 = true;
    }

    return dateObj.toLocaleString("en-US", dateOptions);
};

//close offcanvas
function closeOffcanvasInstances(offcanva_id) {
    const offcanvasElement = $(offcanva_id).get(0);
    const offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasElement);
    offcanvasInstance.hide();
}

function formatToNumber(selectorOrParent, inputSelectors = null) {
    // If only one argument is provided, treat it as input selector(s)
    if (inputSelectors === null) {
        inputSelectors = selectorOrParent;
        selectorOrParent = "body";
    }

    // Convert single string selector to array if needed
    const selectors = Array.isArray(inputSelectors)
        ? inputSelectors
        : [inputSelectors];

    // Join all selectors with comma for jQuery multiple selector
    const combinedSelector = selectors.join(", ");

    $(selectorOrParent).on("input", combinedSelector, function () {
        const value = $(this)
            .val()
            .replace(/[^0-9.]/g, "");
        if (value.includes(".")) {
            const parts = value.split(".");
            parts[1] = parts[1].substring(0, 2);
            value = parts.join(".");
        }
        const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $(this).val(formattedValue);
    });
}

function closeModal(modelId) {
    const model = bootstrap.Modal.getInstance(modelId);
    model.hide();
}

function sanitize(input) {
    return $("<div>").text(input).html(); // Escape special characters
}

export {
    showToastFeedback,
    formatToString,
    dateFormatter,
    closeOffcanvasInstances,
    formatToNumber,
    closeModal,
    sanitize,
};
