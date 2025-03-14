<?php

namespace App\Actions;

use Exception;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GeneratePDFAction
{
    public static function execute(
        string $documentTitle,
        string $htmlDocument,
        bool $withHeader = false,
        array $customConfig = [],
        string $outputMode = 'I'
    ): StreamedResponse {
        try {
            // Default configuration
            $defaultConfig = [
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_top' => 35,
                'margin_left' => 20.4,
                'margin_right' => 20.4,
                'margin_bottom' => 25.4,
                'default_font_size' => 9,
                'default_font' => 'arial',
                'autoPageBreak' => true,
            ];

            // Merge default and custom configurations
            $config = array_merge($defaultConfig, $customConfig);

            // Create Mpdf instance with merged configuration
            $mpdf = new Mpdf($config);

            // Set document metadata
            $mpdf->SetTitle($documentTitle);
            $mpdf->SetAuthor(config('app.name'));
            $mpdf->SetCreator('Funding Monitoring Sys');

            // Add header if requested
            if ($withHeader) {
                $headerHtml = view('components.document-header')->render();
                $mpdf->SetHTMLHeader($headerHtml);
            }

            // Write HTML content
            $mpdf->WriteHTML($htmlDocument);

            // Validate output mode
            $validOutputModes = ['I', 'D', 'F', 'S'];
            if (!in_array(strtoupper($outputMode), $validOutputModes)) {
                throw new InvalidArgumentException("Invalid output mode. Must be one of: " . implode(', ', $validOutputModes));
            }

            // Generate PDF
            $outputFilename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $documentTitle) . '.pdf';
            return response()->stream(
                function () use ($mpdf, $outputFilename, $outputMode) {
                    $mpdf->Output($outputFilename, $outputMode);
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $outputFilename . '"',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]
            );
        } catch (MpdfException $e) {
            // Log Mpdf specific errors
            Log::error('PDF Generation Error (Mpdf): ' . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            // Log other unexpected errors
            Log::error('PDF Generation Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
