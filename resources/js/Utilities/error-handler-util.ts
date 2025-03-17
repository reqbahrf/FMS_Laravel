import { showToastFeedback } from './feedback-toast';

const processError = (
    prefix: string,
    error: any,
    withToast: boolean = false
) => {
    console.error(prefix + processErrorMessage(error));
    if (withToast)
        showToastFeedback(
            'text-bg-danger',
            prefix + processErrorMessage(error)
        );
};

const processErrorMessage = (error: any): string => {
    return (
        error?.responseJSON?.message ||
        error?.message ||
        error?.error ||
        'An unexpected error occurred.'
    );
};

export { processError };
