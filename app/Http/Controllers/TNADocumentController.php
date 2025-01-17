<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\TNAdataHandlerService;

class TNADocumentController extends Controller
{
    public function __construct(private TNAdataHandlerService $TNA)
    {
        $this->TNA = $TNA;
    }

    public function getTNAData(Request $request)
    {
        try {
            $business_id = $request->business_id;
            $TNAdata = $this->TNA->getTNAData($business_id);

            if (!$TNAdata) {
                Log::alert('TNA Data not found', ['business_id' => $business_id]);
                return response()->json(['message' => 'TNA Data not found'], 404);
            }

            return view('components.t-n-a-form.main', compact('TNAdata'));
        } catch (\Exception $e) {
            Log::error('Error retrieving TNA data', [
                'business_id' => $business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error retrieving TNA data'], 500);
        }
    }
}
