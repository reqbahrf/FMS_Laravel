<?php

namespace App\Services;

class StructurePaymentYearService
{

    /**
     * Parse formatted number string to float
     */
    public static function parseNumber(string $value): float
    {
        if (empty($value)) return 0;
        return (float) str_replace(',', '', $value);
    }

    /**
     * Calculate yearly totals from ProjectProposaldata
     */
    public static function calculateTotals(array $ProjectProposaldata): array
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $totals = [
            'y1_total' => 0,
            'y2_total' => 0,
            'y3_total' => 0,
            'y4_total' => 0,
            'y5_total' => 0
        ];

        foreach ($months as $month) {
            for ($year = 1; $year <= 5; $year++) {
                $key = "{$month}_Y{$year}";
                $totals["y{$year}_total"] += self::parseNumber($ProjectProposaldata[$key] ?? 0);
            }
        }

        $totals['grand_total'] = array_sum($totals);

        // Format all totals with thousand separator
        foreach ($totals as &$total) {
            $total = number_format($total, 2, '.', ',');
        }

        return $totals;
    }
}
