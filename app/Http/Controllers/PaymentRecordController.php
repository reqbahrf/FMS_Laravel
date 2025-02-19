<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecord;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
        ]);
        try {
            return DB::table('payment_records')->where('Project_id', $validated['project_id'])
                ->select('reference_number', 'amount', 'payment_method', 'payment_status', 'quarter', 'due_date', 'date_completed', 'updated_at')
                ->get();
        } catch (\Exception $e) {
            Log::error('Error fetching payment records: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching payment records'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
            'reference_number' => 'required|string|max:15',
            'amount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'paymentMethod' => 'required|string|max:15',
            'paymentStatus' => 'required|string|max:15',
        ]);

        try {
            $exists = PaymentRecord::where('reference_number', $validated['reference_number'])->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction ID already exists'
                ], 409);
            }


            $paymentRecord = new PaymentRecord();
            $paymentRecord->Project_id = $validated['project_id'];
            $paymentRecord->reference_number = $validated['reference_number'];
            $paymentRecord->amount = number_format(str_replace(',', '', $validated['amount']), 2, '.', '');
            $paymentRecord->payment_status = $validated['paymentStatus'];
            $paymentRecord->payment_method = $validated['paymentMethod'];

            $ActualRefundAmount = $paymentRecord->projectInfo->actual_amount_to_be_refund;
            $RefundedAmount = $paymentRecord->projectInfo->refunded_amount;


            if ($ActualRefundAmount < $paymentRecord->amount + $RefundedAmount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment amount would exceed the total refund amount allowed'
                ], 422);
            }

            $paymentRecord->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment record created successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error creating payment record: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error creating payment record'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
            'reference_number' => 'required|string|max:15',
            'amount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'paymentMethod' => 'required|string|max:15',
            'paymentStatus' => 'required|string|max:15',
        ]);

        try {
            $exists = PaymentRecord::where('reference_number', $validated['reference_number'])
                ->exists();
            if (!$exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction ID does not exist'
                ], 404);
            }

            $record = PaymentRecord::where('reference_number', $validated['reference_number'])
                ->firstOrFail();
            $newAmount = number_format(str_replace(',', '', $validated['amount']), 2, '.', '');

            // Get the project info
            $projectInfo = $record->projectInfo;
            $actualRefundAmount = $projectInfo->actual_amount_to_be_refund;
            $refundedAmount = $projectInfo->refunded_amount;

            // Calculate the total refunded amount excluding the current record's amount
            $totalRefundedExcludingCurrent = $refundedAmount - $record->amount;
            $totalAfterNewAmount = $newAmount + $totalRefundedExcludingCurrent;
            $isExceedingRefundAmount = bccomp($totalAfterNewAmount, $actualRefundAmount, 2) > 0;

            if ($isExceedingRefundAmount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment amount would exceed the total refund amount allowed'
                ], 422);
            }

            $record->update([
                'Project_id' => $validated['project_id'],
                'reference_number' => $validated['reference_number'],
                'amount' => number_format(str_replace(',', '', $validated['amount']), 2, '.', ''),
                'payment_status' => $validated['paymentStatus'],
                'payment_method' => $validated['paymentMethod'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment record updated successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating payment record: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating payment record'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $reference_number)
    {

        try {
            $exists = PaymentRecord::where('reference_number', $reference_number)
                ->exists();
            if (!$exists) {
                return response()
                    ->json([
                        'message' => 'Transaction ID does not exist'
                    ], 404);
            }

            $record = PaymentRecord::where('reference_number', $reference_number)->first();
            $record->delete();
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Payment record deleted successfully'
                ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting payment record: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting payment record'
            ], 500);
        }
    }
}
