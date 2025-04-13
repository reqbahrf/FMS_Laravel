import { processError } from './error-handler-util';
import '../../css/pdf-loading.css';

export default async function generatePDF(
    generateUrl: string,
    fileName: string
) {
    // Open the new window immediately to avoid popup blockers
    const newWindow = window.open('', '_blank');

    if (!newWindow) {
        processError(`Popup blocked for ${fileName} PDF`, new Error(), true);
        return;
    }

    // Preload spinner UI in the new window
    newWindow.document.write(/*html*/ `
        <html>
            <head>
                <title>Generating PDF...</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        background-color: rgba(0, 0, 0, 0.5);
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                        height: 100vh;
                        color: white;
                        font-family: sans-serif;
                    }
                    .spinner {
                        width: 3rem;
                        height: 3rem;
                        border: 4px solid #fff;
                        border-top: 4px solid #888;
                        border-radius: 50%;
                        animation: spin 1s linear infinite;
                    }
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            </head>
            <body>
                <div class="spinner"></div>
                <p>Generating PDF, please wait...</p>
            </body>
        </html>
    `);

    // Optional overlay in current tab (if you want to keep this)
    const overlay = $(/*html*/ `
        <div class="pdf-loading-overlay">
            <div class="spinner-border text-light" role="status"></div>
            <div class="mt-3 text-light">Generating PDF, please wait...</div>
        </div>
    `);
    $('body').append(overlay);

    try {
        const response = await fetch(generateUrl);

        if (!response.ok) {
            throw new Error(`Failed to generate PDF: ${response.statusText}`);
        }

        const pdfBlob = await response.blob();
        const pdfUrl = URL.createObjectURL(pdfBlob);

        newWindow.location.href = pdfUrl;
    } catch (error: any) {
        processError(`Error generating PDF for ${fileName}:`, error, true);

        newWindow.document.body.innerHTML = `
            <p style="color: red; font-family: sans-serif;">Failed to generate PDF. Please try again later.</p>
        `;
    } finally {
        overlay.remove();
    }
}
