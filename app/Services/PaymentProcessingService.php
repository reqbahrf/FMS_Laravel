<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;
use App\Services\StructurePaymentYearService;

class PaymentProcessingService
{

    public function __construct(private StructurePaymentYearService $structurePaymentYearService) {}
    /**
     * Execute the payment calculation and creation
     *
     * @param string $startDate The starting date in Y-m-d format
     * @param array $paymentStructure Array of yearly payment structure
     * @param string $projectId Project identifier
     * @param array|null $refundedPayments Optional array of refunded payment flags
     * @return void
     */
    public function processPayments(
        string $startDate,
        array $paymentStructure,
        string $projectId,
        ?array $refundedPayments = null
    ): void {
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
                    $cleanedStructure,
                    $refundedPayments
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
                // Skip if key ends with _total or value is null or key ends with _refunded
                if (str_ends_with($key, '_total') || is_null($value) || str_ends_with($key, '_refunded')) {
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
        array $paymentStructure,
        ?array $refundedPayments = null
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
                $refundedKey = "{$key}_refunded";

                // Skip if key doesn't exist or value is null
                if (!isset($paymentStructure[$key])) {
                    continue;
                }

                $monthAmount = $this->structurePaymentYearService->parseNumber($paymentStructure[$key]);

                // Check if this payment is marked as refunded
                $isRefunded = isset($refundedPayments[$refundedKey]) && $refundedPayments[$refundedKey] === true;

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

                    // Set payment status based on refund flag
                    $paymentStatus = $isRefunded ? 'Paid' : 'Pending';

                    PaymentRecord::create([
                        'Project_id' => $projectId,
                        'reference_number' => Str::random(10),
                        'amount' => $monthAmount,
                        'payment_status' => $paymentStatus,
                        'payment_method' => 'N/A',
                        'due_date' => $dueDate->toDateString(),
                        'date_completed' => $isRefunded ? $dueDate->toDateString() : null,
                    ]);
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
