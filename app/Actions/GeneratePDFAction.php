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
        string $customHeader = '',
        array $customConfig = [],
        string $outputMode = 'I'
    ): StreamedResponse {
        try {
            // Increase PCRE backtrack limit to handle larger HTML content
            $originalBacktrackLimit = ini_get('pcre.backtrack_limit');
            ini_set('pcre.backtrack_limit', '20000000'); // Increased from 10 million

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

            if ($withHeader) {
                if ($customHeader) {
                    $mpdf->SetHTMLHeader($customHeader);
                } else {
                    $headerHtml = view('components.document-header')->render();
                    $mpdf->SetHTMLHeader($headerHtml);
                }
            }

            // Try to write the entire HTML content with more robust error handling
            $chunkSize = 500000; // 500 KB chunks
            $htmlChunks = self::splitHtmlIntoChunks($htmlDocument, $chunkSize);

            foreach ($htmlChunks as $index => $chunk) {
                try {
                    $mpdf->WriteHTML($chunk, $index === 0 ? 0 : 2); // First chunk with mode 0, subsequent with mode 2
                } catch (MpdfException $e) {
                    Log::error('PDF Generation Chunk Error', [
                        'chunk_index' => $index,
                        'chunk_size' => strlen($chunk),
                        'error' => $e->getMessage()
                    ]);
                    throw $e;
                }
            }

            // Validate output mode
            $validOutputModes = ['I', 'D', 'F', 'S'];
            if (!in_array($outputMode, $validOutputModes)) {
                throw new InvalidArgumentException("Invalid output mode: $outputMode");
            }

            // Generate and return PDF
            return response()->stream(
                function () use ($mpdf, $outputMode) {
                    $mpdf->Output($mpdf->title, $outputMode);
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . $mpdf->title . '.pdf"',
                ]
            );
        } catch (Exception $e) {
            Log::error('PDF Generation Error', [
                'document_title' => $documentTitle,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        } finally {
            // Restore original backtrack limit
            ini_set('pcre.backtrack_limit', $originalBacktrackLimit);
        }
    }

    public static function splitHtmlIntoChunks(string $html, int $chunkSize): array
    {
        $chunks = [];
        $offset = 0;

        while ($offset < strlen($html)) {
            $chunk = substr($html, $offset, $chunkSize);
            $chunks[] = $chunk;
            $offset += $chunkSize;
        }

        return $chunks;
    }
}
