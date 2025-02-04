<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;

class CalculateQuarterlyPayments
{
    public static function execute(int $yearDuration, float $totalAmount, string $projectId)
    {
        $numberOfQuarter = $yearDuration * 4;
        $amountPerQuarter = floatval(number_format($totalAmount / $numberOfQuarter, 2, '.', ''));

        $currentDate = Carbon::now()->addQuarter()->startOfQuarter();

        for ($i = 1; $i < $numberOfQuarter; $i++) {
            $quarter = 'Q' . ($currentDate->quarter) . ' ' . $currentDate->year;

            $transactionId = Str::random(10);

            PaymentRecord::create([
                'Project_id' => $projectId,
                'reference_number' => $transactionId,
                'amount' => $amountPerQuarter,
                'payment_status' => 'Due',
                'payment_method' => 'N/A',
                'quarter' => $quarter,
                'due_date' => $currentDate,
            ]);

            $currentDate->addQuarter();
        }

        
    }
}
