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
    
                $html .= '<td style="width: 33.33%; text-align: center; border: 1px solid black; padding: 10px;">';
                $html .= '<p style="margin-bottom: 0;">' . $signature['top'] . '</p>';
                $html .= '<img src="' . $signature['image'] . '" alt="Signature" style="width: 200px; height: auto;">';
                $html .= '<p style="margin-top: 0;">' . $signature['name'] . '</p>';
                $html .= '<p style="margin-top: 0;">' . $signature['bottom'] . '</p>';
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