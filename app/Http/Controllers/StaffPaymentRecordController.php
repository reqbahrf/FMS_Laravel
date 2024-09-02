<?php

namespace App\Http\Controllers;

use App\Models\PaymentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffPaymentRecordController extends Controller
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
                ->select('transaction_id', 'amount', 'payment_method', 'payment_status', 'created_at')
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
            'TransactionID' => 'required|string|max:15',
            'amount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'paymentMethod' => 'required|string|max:15',
            'paymentStatus' => 'required|string|max:15',
        ]);

        try {
            $exists = PaymentRecord::where('transaction_id', $validated['TransactionID'])->exists();

            if ($exists) {
                return response()->json(['message' => 'Transaction ID already exists'], 409);
            }

            // Use mass assignment to create the record
            PaymentRecord::create([
                'Project_id' => $validated['project_id'],
                'transaction_id' => $validated['TransactionID'],
                'amount' => number_format(str_replace(',', '', $validated['amount']), 2, '.', ''),
                'payment_status' => $validated['paymentStatus'],
                'payment_method' => $validated['paymentMethod'],
            ]);

            return response()->json(['success' => true, 'message' => 'Payment record created successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Error creating payment record: ' . $e->getMessage());

            return response()->json(['message' => 'Error creating payment record'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

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
            'TransactionID' => 'required|string|max:15',
            'amount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'paymentMethod' => 'required|string|max:15',
            'paymentStatus' => 'required|string|max:15',
        ]);

        try {
            $exists = PaymentRecord::where('transaction_id', $validated['TransactionID'])->exists();
            if (!$exists) {
                return response()->json(['message' => 'Transaction ID does not exist'], 404);
            }

            $record = PaymentRecord::where('transaction_id', $validated['TransactionID'])->first();
            $record->update([
                'Project_id' => $validated['project_id'],
                'transaction_id' => $validated['TransactionID'],
                'amount' => number_format(str_replace(',', '', $validated['amount']), 2, '.', ''),
                'payment_status' => $validated['paymentStatus'],
                'payment_method' => $validated['paymentMethod'],
            ]);

            return response()->json(['success' => true, 'message' => 'Payment record updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating payment record: ' . $e->getMessage());
            return response()->json(['message' => 'Error updating payment record'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $transaction_id)
    {

        try {
            $exists = PaymentRecord::where('transaction_id', $transaction_id)->exists();
            if (!$exists) {
                return response()->json(['message' => 'Transaction ID does not exist'], 404);
            }

            $record = PaymentRecord::where('transaction_id', $transaction_id)->first();
            $record->delete();
            return response()->json(['success' => true, 'message' => 'Payment record deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting payment record: ' . $e->getMessage());
            return response()->json(['message' => 'Error deleting payment record'], 500);
        }
    }
}
