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
    public static function parseFormattedNumber($number)
    {
        if (is_null($number)) {
            return 0;
        }

        // Remove thousand separators and convert to float
        return (float) str_replace(',', '', $number);
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
