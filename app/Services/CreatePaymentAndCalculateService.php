<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;
use App\Services\StructurePaymentYearService;

class CalculateQuarterlyPayments
{
    /**
     * Execute the payment calculation and creation
     *
     * @param string $startDate The starting date in Y-m-d format
     * @param array $paymentStructure Array of yearly payment structure
     * @param string $projectId Project identifier
     * @return void
     */
    public static function processPayments(string $startDate, array $paymentStructure, string $projectId): void
    {
        // Calculate year totals using the service
        $yearTotals = StructurePaymentYearService::calculateTotals($paymentStructure);

        // Calculate active years (years with payments > 0)
        $activeYears = self::calculateActiveYears($yearTotals);

        // Set the payment start date
        $startDateCarbon = Carbon::parse($startDate);

        // Process each year's payments
        foreach ($activeYears as $year => $amount) {
            self::processYearlyPayments(
                $year,
                $startDateCarbon->copy(),
                $projectId,
                $paymentStructure
            );
        }
    }

    /**
     * Calculate which years have payments
     */
    private static function calculateActiveYears(array $yearTotals): array
    {
        $activeYears = [];
        foreach ($yearTotals as $key => $value) {
            if (str_starts_with($key, 'y') && str_ends_with($key, '_total')) {
                $amount = StructurePaymentYearService::parseNumber($value);
                if ($amount > 0) {
                    $year = (int) substr($key, 1, 1);
                    $activeYears[$year] = $amount;
                }
            }
        }
        return $activeYears;
    }

    /**
     * Process payments for a specific year
     */
    private static function processYearlyPayments(
        int $yearNumber,
        Carbon $startDate,
        string $projectId,
        array $paymentStructure
    ): void {
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        // Calculate the starting month based on the start date
        $startingMonth = (int) $startDate->format('n') - 1; // 0-based index

        foreach ($months as $monthIndex => $month) {
            $key = "{$month}_Y{$yearNumber}";
            $monthAmount = StructurePaymentYearService::parseNumber($paymentStructure[$key] ?? '0');

            if ($monthAmount > 0) {
                // For first year, adjust dates based on start date
                if ($yearNumber === 1) {
                    if ($monthIndex < $startingMonth) {
                        // Skip months before the start date in the first year
                        continue;
                    }

                    if ($monthIndex === $startingMonth) {
                        // For the starting month, use exact one year date
                        $dueDate = $startDate->copy()->addYear();
                    } else {
                        // For subsequent months in first year, use the 15th
                        $dueDate = $startDate->copy()
                            ->addYear()
                            ->addMonths($monthIndex - $startingMonth)
                            ->startOfMonth()
                            ->addDays(14);
                    }
                } else {
                    // For subsequent years, calculate based on the first year's pattern
                    $dueDate = $startDate->copy()
                        ->addYears($yearNumber - 1)
                        ->addMonths($monthIndex - $startingMonth)
                        ->startOfMonth()
                        ->addDays(14);
                }

                PaymentRecord::create([
                    'Project_id' => $projectId,
                    'reference_number' => Str::random(10),
                    'amount' => $monthAmount,
                    'payment_status' => 'Due',
                    'payment_method' => 'N/A',
                    'quarter' => 'Q' . ceil(($dueDate->month) / 3) . ' ' . $dueDate->year,
                    'due_date' => $dueDate->toDateString(),
                    'date_completed' => null,
                ]);
            }
        }
    }
}
