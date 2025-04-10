import { processError } from './error-handler-util';
import '../../css/pdf-loading.css';
// Create loading overlay with classes instead of inline styles
export default async function generatePDF(
    generateUrl: string,
    fileName: string
) {
    const loadingOverlay = $('<div>', {
        class: 'pdf-loading-overlay',
    });

    const loadingSpinner = $('<div>', {
        class: 'spinner-border text-light',
        role: 'status',
    });

    const loadingText = $('<div>', {
        class: 'mt-3 text-light',
        text: 'Generating PDF, please wait...',
    });

    loadingOverlay.append(loadingSpinner, loadingText);
    $('body').append(loadingOverlay);

    try {
        // Open the PDF in a new window/tab

        // Fetch the PDF content
        const response = await fetch(generateUrl);

        if (!response.ok) {
            throw new Error(`Failed to generate PDF: ${response.statusText}`);
        }

        // Get the PDF blob
        const pdfBlob = await response.blob();

        // Create object URL
        const pdfUrl = URL.createObjectURL(pdfBlob);

        const newWindow = window.open('about:blank', '_blank');
        // Navigate the new window to the PDF
        if (newWindow) {
            newWindow.location.href = pdfUrl;
        }
    } catch (error: any) {
        processError(`Error generating PDF for ${fileName}:`, error, true);
    } finally {
        loadingOverlay.remove();
    }
}
