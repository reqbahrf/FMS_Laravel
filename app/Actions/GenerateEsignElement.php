<?php

namespace App\Actions;

use Exception;

class GenerateEsignElement
{
    public function execute(array $esignatures): string
    {
        try{
            $html = '<table style="width: 100%; border-collapse: collapse;">';
            $html .= '<tbody>';

            $count = 0;
            foreach ($esignatures as $signature) {
                if ($count % 3 === 0) {
                    $html .= '<tr>'; // Start a new row for every 3 signatures
                }

                $html .= '<td style="width: 33.33%; padding: 7.5pt; vertical-align: top;">';
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

                if (($count + 1) % 3 === 0 || ($count + 1) == count($esignatures)) {
                    $html .= '</tr>'; // Close the row
                }

                $count++;
            }

            $html .= '</tbody></table>';
            return $html;
        }catch(Exception $e){
            throw new Exception("Error Processing Request", 1, $e);
        }

    }
}
