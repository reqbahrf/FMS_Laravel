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
            ini_set('pcre.backtrack_limit', '10000000'); // Set to 10 million

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

            // Try to write the entire HTML content
            try {
                $mpdf->WriteHTML($htmlDocument);
            } catch (MpdfException $e) {

                if (strpos($e->getMessage(), 'pcre.backtrack_limit') !== false) {
                    Log::info('Falling back to chunked HTML processing for large document');


                    $mpdf = new Mpdf($config);

                    // Set document metadata again
                    $mpdf->SetTitle($documentTitle);
                    $mpdf->SetAuthor(config('app.name'));
                    $mpdf->SetCreator('Funding Monitoring Sys');

                    // Set header again if needed
                    if ($withHeader) {
                        if ($customHeader) {
                            $mpdf->SetHTMLHeader($customHeader);
                        } else {
                            $headerHtml = view('components.document-header')->render();
                            $mpdf->SetHTMLHeader($headerHtml);
                        }
                    }


                    $chunkSize = 500000;
                    $htmlChunks = self::splitHtmlIntoChunks($htmlDocument, $chunkSize);

                    foreach ($htmlChunks as $chunk) {
                        $mpdf->WriteHTML($chunk);
                    }
                } else {
                    // If it's a different error, rethrow it
                    throw $e;
                }
            }

            // Validate output mode
            $validOutputModes = ['I', 'D', 'F', 'S'];
            if (!in_array(strtoupper($outputMode), $validOutputModes)) {
                throw new InvalidArgumentException("Invalid output mode. Must be one of: " . implode(', ', $validOutputModes));
            }

            // Generate PDF
            $outputFilename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $documentTitle) . '.pdf';

            // Restore original backtrack limit
            ini_set('pcre.backtrack_limit', $originalBacktrackLimit);

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

    /**
     * Split HTML content into smaller chunks while preserving HTML structure
     *
     * @param string $html The HTML content to split
     * @param int $chunkSize The approximate size of each chunk
     * @return array Array of HTML chunks
     */
    private static function splitHtmlIntoChunks(string $html, int $chunkSize): array
    {
        // If the HTML is already small enough, return it as a single chunk
        if (strlen($html) <= $chunkSize) {
            return [$html];
        }

        $chunks = [];
        $dom = new \DOMDocument();

        // Use internal errors for HTML5 tags
        $previousValue = libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        libxml_use_internal_errors($previousValue);

        $body = $dom->getElementsByTagName('body')->item(0);

        if (!$body) {
            // If we can't parse the HTML properly, use a simpler approach
            return str_split($html, $chunkSize);
        }

        $currentChunk = '';
        $currentSize = 0;

        // Process each child of the body
        foreach ($body->childNodes as $node) {
            $nodeHtml = $dom->saveHTML($node);
            $nodeSize = strlen($nodeHtml);

            // If adding this node would exceed the chunk size, start a new chunk
            if ($currentSize + $nodeSize > $chunkSize && $currentSize > 0) {
                $chunks[] = $currentChunk;
                $currentChunk = '';
                $currentSize = 0;
            }

            // Add the node to the current chunk
            $currentChunk .= $nodeHtml;
            $currentSize += $nodeSize;
        }

        // Add the last chunk if it's not empty
        if ($currentSize > 0) {
            $chunks[] = $currentChunk;
        }

        return $chunks;
    }
}
