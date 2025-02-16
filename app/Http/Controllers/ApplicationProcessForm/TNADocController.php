<?php

namespace App\Http\Controllers\ApplicationProcessForm;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\TNAFormRequest;
use App\Services\TNAdataHandlerService;

class TNADocController extends Controller
{
    public function __construct(private TNAdataHandlerService $TNA)
    {
        $this->TNA = $TNA;
    }

    public function getTNAForm(Request $request)
    {
        try {
            $action = $request->action;
            $business_id = $request->business_id;
            $application_id = $request->application_id;
            $TNAdata = $this->TNA->getTNAData($business_id, $application_id);
            switch ($action) {
                case 'view':
                    $isEditable = false;
                    break;

                case 'edit':
                    $isEditable = true;
                    break;
                default:
                    throw new Exception('Invalid action');
                    break;
            }

            if (!$TNAdata) {
                Log::alert('TNA Data not found', ['business_id' => $business_id]);
                return response()->json(['message' => 'TNA Data not found'], 404);
            }

            return view('components.t-n-a-form.main', compact('TNAdata', 'isEditable'));
        } catch (\Exception $e) {
            Log::error('Error retrieving TNA data', [
                'business_id' => $business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error retrieving TNA data'], 500);
        }
    }

    public function setTNAForm(TNAFormRequest $request)
    {
        try{
            $validated = $request->validated();

            DB::transaction(function () use ($validated, $request) {
                $this->TNA->setTNAData(
                    $validated,
                    $request->business_id,
                    $request->application_id
                );
            });

            return response()->json(['message' => 'TNA data set successfully'], 200);

        }catch(Exception $e){
            Log::error('Error setting TNA data', [
                'business_id' => $request->business_id,
                'error' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Error setting TNA data' . $e->getMessage()], 500);
        }
    }
}
