<?php

namespace App\Services;

class NumberFormatterService
{

     /**
     * Convert a formatted number string to a float
     *
     * @param string|null $number Number string with possible thousand separators
     * @return float
     */
    public static function parseFormattedNumber(string $number): float
    {
        if (is_null($number)) {
            return 0;
        }

         // Remove thousand separators, format to 2 decimal places
         $cleanNumber = str_replace(',', '', $number);
         return floatval(number_format((float)$cleanNumber, 2, '.', ''));
    }

    /**
     * Format a number with thousand separators and decimal places
     *
     * @param float $number Number to format
     * @param int $decimals Number of decimal places
     * @return string
     */
    public static function formatNumber($number, $decimals = 2)
    {
        return number_format($number, $decimals, '.', ',');
    }

}
