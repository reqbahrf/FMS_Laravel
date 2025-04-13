<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;
use Illuminate\Support\Facades\Log;
use App\Constants\ProjectRefundConstants;
use App\Services\StructurePaymentYearService;

class PaymentProcessingService
{

    public function __construct(private StructurePaymentYearService $structurePaymentYearService) {}
    /**
     * Execute the payment calculation and creation
     *
     * @param string $startDate The starting date in Y-m-d format (fund release date)
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

            // Set the payment start date - exactly one year after fund release
            $startDateCarbon = Carbon::parse($startDate)->addYear();

            // Track payment dates to avoid duplicates
            $processedDates = [];

            // Process each year's payments
            foreach ($activeYears as $year) {
                $this->processYearlyPayments(
                    $year,
                    $startDateCarbon->copy(),
                    $projectId,
                    $cleanedStructure,
                    $refundedPayments,
                    $processedDates
                );
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Extracts payment structure from validated data.
     *
     * @param array $validatedData The validated data containing payment structure
     * @return array The extracted payment structure with only valid keys
     * @throws Exception If extraction process fails
     */
    public static function extractPaymentStructure(array $validatedData): array
    {
        try {
            $keys = ProjectRefundConstants::PAYMENT_STRUCTURE_KEYS;

            $keysArray = array_fill_keys($keys, 0);

            $paymentStructure = array_intersect_key($validatedData, $keysArray);

            return $paymentStructure;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Extracts refunded payment flags from validated data.
     *
     * @param array $validatedData The validated data containing payment structure
     * @return array The extracted refunded payment flags with only valid keys
     * @throws Exception If extraction process fails
     */
    public static function extractRefundedPayments(array $validatedData): array
    {
        try {
            $keys = ProjectRefundConstants::REFUNDED_PAYMENT_KEYS;

            $refundedPayments = [];
            foreach ($keys as $key) {
                if (isset($validatedData[$key]) && !empty($validatedData[$key])) {
                    $refundedPayments[$key] = $validatedData[$key];
                }
            }

            return $refundedPayments;
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
        ?array $refundedPayments = null,
        array &$processedDates = []
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

            // Get the starting month (0-based index)
            $startingMonth = (int) $startDate->format('n') - 1;

            foreach ($months as $monthIndex => $month) {
                $key = "{$month}_Y{$yearNumber}";
                $refundedKey = "{$key}_refunded";

                // Skip if payment structure doesn't have this month/year
                if (!isset($paymentStructure[$key])) {
                    continue;
                }

                $monthAmount = $this->structurePaymentYearService->parseNumber($paymentStructure[$key]);

                // Skip if amount is zero
                if ($monthAmount <= 0) {
                    continue;
                }

                // Critical check: For Year 1, only process months starting from startingMonth
                if ($yearNumber === 1 && $monthIndex < $startingMonth) {
                    continue;
                }

                $isRefunded = isset($refundedPayments[$refundedKey]) &&
                    ($refundedPayments[$refundedKey] === true || $refundedPayments[$refundedKey] === '1' || $refundedPayments[$refundedKey] === 1);

                // Calculate the payment due date
                $dueDate = null;

                if ($yearNumber === 1) {
                    if ($monthIndex === $startingMonth) {
                        // First payment (same month as start date): use the start date
                        $dueDate = $startDate->copy();
                    } else {
                        // For months after the starting month in Year 1
                        $dueDate = $startDate->copy()
                            ->addMonths($monthIndex - $startingMonth)
                            ->startOfMonth()
                            ->addDays(14);
                    }
                } else {
                    // For subsequent years (Y2, Y3, etc.) - calculate relative to the start date
                    $dueDate = $startDate->copy()
                        ->addYears($yearNumber - 1)
                        ->addMonths($monthIndex - $startingMonth)
                        ->startOfMonth()
                        ->addDays(14);
                }

                // Check if we've already processed a payment for this date
                $dueDateStr = $dueDate->toDateString();
                if (in_array($dueDateStr, $processedDates)) {
                    // Log a warning about skipping a duplicate payment
                    Log::warning("Skipping duplicate payment for date: {$dueDateStr}, month: {$month}, year: Y{$yearNumber}");
                    continue;
                }

                // Add this date to our processed dates
                $processedDates[] = $dueDateStr;

                $referenceNumber = 'Temp-' . substr(Str::uuid(), 0, 15);
                $paymentStatus = $isRefunded ? 'Paid' : 'Pending';

                PaymentRecord::create([
                    'Project_id' => $projectId,
                    'reference_number' => $referenceNumber,
                    'amount' => $monthAmount,
                    'payment_status' => $paymentStatus,
                    'payment_method' => 'N/A',
                    'due_date' => $dueDateStr,
                    'date_completed' => $isRefunded ? $dueDateStr : null,
                ]);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
