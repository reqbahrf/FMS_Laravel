<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;

class CalculateQuarterlyPayments
{
    public static function execute(int $yearDuration, float $totalAmount, string $projectId)
    {
         // 1. Calculate the number of quarters
         $numberOfQuarters = $yearDuration * 4;

         // 2. Calculate the amount per quarter with proper rounding
         $amountPerQuarter = round($totalAmount / $numberOfQuarters, 2);
 
         // 3. Get the current date, move to the NEXT quarter, and set to the start of that quarter
         $currentDate = Carbon::now()->addQuarter()->startOfQuarter();
 
         // 4. Handle the remainder separately
         $remainder = $totalAmount - ($amountPerQuarter * $numberOfQuarters);
         $increment = $remainder > 0 ? 0.01 : ($remainder < 0 ? -0.01 : 0);
 
         // 5. Loop through each quarter
         for ($i = 0; $i < $numberOfQuarters; $i++) {
             // a. Determine the quarter and year
             $quarter = 'Q' . ($currentDate->quarter) . ' ' . $currentDate->year;
 
             // b. Create a unique transaction ID
             $transactionId = Str::random(10);
 
             // c. Distribute the remainder across quarters
             $amount = $amountPerQuarter;
             if ($remainder > 0) {
                 $amount += $increment;
                 $remainder -= $increment;
             } elseif ($remainder < 0) {
                 $amount += $increment;
                 $remainder -= $increment;
             }
 
             // d. Create the payment record
             PaymentRecord::create([
                 'Project_id' => $projectId,
                 'reference_number' => $transactionId,
                 'amount' => $amount,
                 'payment_status' => 'Due',
                 'payment_method' => 'N/A',
                 'quarter' => $quarter,
                 'due_date' => $currentDate->toDateString(),
                 'date_completed' => null,
             ]);
 
             // e. Move to the next quarter
             $currentDate->addQuarter();
         }
    }
}
