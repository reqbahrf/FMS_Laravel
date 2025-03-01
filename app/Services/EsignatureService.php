<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EsignatureService
{
    public function create(
        array $esignatures,
        string $startAt = 'left',
        int $signaturePerRow = 3,
        string $layout = 'formal',
    ): string {
        try {
            // Validate parameters
            $startAt = in_array(strtolower($startAt), ['left', 'center', 'right']) ? strtolower($startAt) : 'left';
            $signaturePerRow = max(1, $signaturePerRow); // Ensure at least 1 signature per row
            $layout = in_array(strtolower($layout), ['default', 'formal']) ? strtolower($layout) : 'default';

            $html = '<table style="width: 100%; border-collapse: collapse;">';
            $html .= '<tbody>';

            // Calculate initial offset for the first row based on startAt parameter
            $initialOffset = 0;
            $cellWidth = 100 / $signaturePerRow;

            if ($startAt == 'center' && count($esignatures) > 0) {
                // For center alignment, calculate how many empty cells to add at the start
                $initialOffset = floor(($signaturePerRow - 1) / 2);
            } elseif ($startAt == 'right' && count($esignatures) > 0) {
                // For right alignment, start at the rightmost cell
                $initialOffset = $signaturePerRow - 1;
            }

            $count = 0;
            $totalSignatures = count($esignatures);

            // Handle the first row with potential alignment offset
            if ($totalSignatures > 0) {
                $html .= '<tr>';

                // Add empty cells for offset on the first row
                for ($i = 0; $i < $initialOffset; $i++) {
                    $html .= '<td style="width: ' . $cellWidth . '%;"></td>';
                }

                // Calculate how many signatures to render in the first row after the offset
                $signaturesInFirstRow = min($signaturePerRow - $initialOffset, $totalSignatures);

                // Render signatures for the first row
                for ($i = 0; $i < $signaturesInFirstRow; $i++) {
                    if ($layout === 'formal') {
                        $html .= $this->renderFormalSignatureCell($esignatures[$count], $cellWidth);
                    } else {
                        $html .= $this->renderDefaultSignatureCell($esignatures[$count], $cellWidth);
                    }
                    $count++;
                }

                // Close the first row
                $html .= '</tr>';
            }

            // Process remaining signatures in full rows
            while ($count < $totalSignatures) {
                $html .= '<tr>';

                // Calculate remaining signatures for this row
                $signaturesInRow = min($signaturePerRow, $totalSignatures - $count);

                // Render signatures for this row
                for ($i = 0; $i < $signaturesInRow; $i++) {
                    if ($layout === 'formal') {
                        $html .= $this->renderFormalSignatureCell($esignatures[$count], $cellWidth);
                    } else {
                        $html .= $this->renderDefaultSignatureCell($esignatures[$count], $cellWidth);
                    }
                    $count++;
                }

                // If the row isn't full, add empty cells
                for ($i = $signaturesInRow; $i < $signaturePerRow; $i++) {
                    $html .= '<td style="width: ' . $cellWidth . '%;"></td>';
                }

                $html .= '</tr>';
            }

            $html .= '</tbody></table>';
            return $html;
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1, $e);
        }
    }

    /**
     * Render an individual signature cell in the default layout
     *
     * @param array $signature Signature data
     * @param float $cellWidth Width percentage for the cell
     * @return string HTML for the signature cell
     */
    private function renderDefaultSignatureCell(array $signature, float $cellWidth): string
    {
        $html = '<td style="width: ' . $cellWidth . '%; padding: 7.5pt; vertical-align: top;">';
        $html .= '<div style="position: relative; min-height: 90pt;">';

        // Top text
        $html .= '<p style="margin: 0 0 1pt 0; text-align: left; z-index: -1;">' . e($signature['topText'] ?? '') . '</p>';

        // Signature container with relative positioning
        $html .= '<div style="position: absolute;top: 50%; left: 0; transform: translateY(-50%); height: auto; margin: 2pt 0; width: 100%;">';
        $html .= '<img src="' . $signature['signatureData'] . '" alt="Signature" style="position: relative; left: 0; top: -50%; width: 190pt; height: auto; opacity: 0.9; z-index: 1;">';
        $html .= '</div>';

        // Name and bottom text
        $html .= '<p style="margin: 0 0 1pt 0; text-align: center; z-index: -1;">' . e($signature['name'] ?? '') . '</p>';
        $html .= '<div style="border-bottom: 0.75pt solid black; margin-bottom: 2pt;"></div>';
        $html .= '<p style="margin: 0; text-align: left; font-weight: bold;">' . e($signature['bottomText'] ?? '') . '</p>';

        $html .= '</div>';
        $html .= '</td>';

        return $html;
    }

    /**
     * Render an individual signature cell in the formal layout with date
     * This layout matches the format shown in the new example image
     *
     * @param array $signature Signature data
     * @param float $cellWidth Width percentage for the cell
     * @return string HTML for the formal signature cell
     */
    private function renderFormalSignatureCell(array $signature, float $cellWidth): string
    {
        $html = '<td style="width: ' . $cellWidth . '%; padding: 10pt; vertical-align: top; text-align: center;">';
        $html .= '<div style="position: relative; min-height: 150pt;">';

        // Add signature image at the top
        if (!empty($signature['signatureData'])) {
            $html .= '<div style="margin-bottom: 5pt;">';
            $html .= '<img src="' . $signature['signatureData'] . '" alt="Signature" style="max-width: 200pt; height: auto; opacity: 0.9;">';
            $html .= '</div>';
        }

        // Name with underline
        $html .= '<div style="margin-bottom: 5pt;">';
        $html .= '<p style="margin: 0; font-weight: bold; text-decoration: underline;">' . e($signature['name'] ?? '') . '</p>';
        $html .= '<p style="margin: 0; font-size: 9pt;">Signature over Printed Name</p>';
        $html .= '</div>';

        // Position
        $html .= '<div style="margin-top: 10pt; margin-bottom: 5pt;">';
        $html .= '<p style="margin: 0; font-weight: bold; text-decoration: underline;">' . e($signature['position'] ?? '') . '</p>';
        $html .= '<p style="margin: 0; font-size: 9pt;">Position in the Enterprise</p>';
        $html .= '</div>';

        // Date
        $html .= '<div style="margin-top: 10pt;">';
        $html .= '<p style="margin: 0; font-weight: bold; text-decoration: underline;">' . e($signature['date'] ?? '') . '</p>';
        $html .= '<p style="margin: 0; font-size: 9pt;">Date</p>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</td>';

        return $html;
    }

    public function storeSignature(
        mixed $uniqueId,
        string $documentIdentifier,
        array $signatureData,
    ): array {
        return $this->processMultipleSignatures($signatureData, $uniqueId, $documentIdentifier);
    }

    public function processSignature(
        array $signatureData,
        mixed $uniqueId,
        string $documentIdentifier
    ): array {
        try {
            // Extract the base64 image data
            $base64Data = $signatureData['signatureData'] ?? null;

            if (empty($base64Data)) {
                throw new Exception('Signature data is missing or empty');
            }

            // Validate that it's a base64 image
            if (!preg_match('/^data:image\/(\w+);base64,/', $base64Data, $matches)) {
                throw new Exception('Invalid signature data format');
            }

            // Extract the image type and actual base64 content
            $imageType = $matches[1];
            $base64Content = substr($base64Data, strpos($base64Data, ',') + 1);
            $decodedImage = base64_decode($base64Content);

            if (!$decodedImage) {
                throw new Exception('Failed to decode base64 image data');
            }

            // Generate a unique filename
            $filename = 'signature_' . $uniqueId . '_' . $documentIdentifier . '_' . Str::uuid() . '.' . $imageType;
            $storagePath = 'signatures/' . $filename;

            // Store the file in Laravel's storage
            if (!Storage::disk('private')->put($storagePath, $decodedImage)) {
                throw new Exception('Failed to store signature image');
            }

            // Create a reference to the stored file
            $fileReference = storage_path('app/private/' . $storagePath);

            // Return modified array with file reference instead of base64 data
            $result = $signatureData;
            $result['signatureData'] = $fileReference;

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function processMultipleSignatures(
        array $signaturesData,
        mixed $uniqueId,
        string $documentIdentifier
    ): array {
        try {

            $processedSignatures = [];
            foreach ($signaturesData as $signatureData) {
                $processedSignatures[] = $this->processSignature(
                    $signatureData,
                    $uniqueId,
                    $documentIdentifier
                );
            }
            return $processedSignatures;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getBase64Signature(array $signatureData): array
    {
        try {
            $restoredSignatures = [];
            foreach ($signatureData as $signature) {
                $base64Data = Storage::disk('private')->get($signature['signatureData']);
                $signature['signatureData'] = base64_encode($base64Data);
                $restoredSignatures[] = $signature;
            }
            return $restoredSignatures;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
