<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;
use App\Services\StructurePaymentYearService;
use PhpParser\Node\Stmt\TryCatch;

class PaymentProcessingService
{

    public function __construct(private StructurePaymentYearService $structurePaymentYearService) {}
    /**
     * Execute the payment calculation and creation
     *
     * @param string $startDate The starting date in Y-m-d format
     * @param array $paymentStructure Array of yearly payment structure
     * @param string $projectId Project identifier
     * @return void
     */
    public function processPayments(string $startDate, array $paymentStructure, string $projectId): void
    {
        try {

            // Clean the payment structure (remove _total keys and null values)
            $cleanedStructure = $this->cleanPaymentStructure($paymentStructure);

            // Get unique years with payments
            $activeYears = $this->getActiveYears($cleanedStructure);

            // Set the payment start date
            $startDateCarbon = Carbon::parse($startDate);

            // Process each year's payments
            foreach ($activeYears as $year) {
                $this->processYearlyPayments(
                    $year,
                    $startDateCarbon->copy(),
                    $projectId,
                    $cleanedStructure
                );
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Clean payment structure by removing total keys and null values
     */
    private function cleanPaymentStructure(array $paymentStructure): array
    {
        try {

            $cleaned = [];
            foreach ($paymentStructure as $key => $value) {
                // Skip if key ends with _total or value is null
                if (str_ends_with($key, '_total') || is_null($value)) {
                    continue;
                }
                $cleaned[$key] = $value;
            }
            return $cleaned;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get unique years that have payments
     */
    private function getActiveYears(array $cleanedStructure): array
    {
        try {

            $years = [];
            foreach ($cleanedStructure as $key => $value) {
                if (preg_match('/Y(\d+)$/', $key, $matches)) {
                    $year = (int) $matches[1];
                    if (!in_array($year, $years)) {
                        $years[] = $year;
                    }
                }
            }
            sort($years);
            return $years;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Process payments for a specific year
     */
    private function processYearlyPayments(
        int $yearNumber,
        Carbon $startDate,
        string $projectId,
        array $paymentStructure
    ): void {
        try {
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

                // Skip if key doesn't exist or value is null
                if (!isset($paymentStructure[$key])) {
                    continue;
                }

                $monthAmount = $this->structurePaymentYearService->parseNumber($paymentStructure[$key]);

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
        } catch (Exception $e) {
            throw $e;
        }
    }
}
