<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FormDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormDraftController extends Controller
{
    public function store(Request $request)
    {
        try{
            $user_id = Auth::user()->id;
            $draftType = $request->validate([
                'draft_type' => 'required|string|in:Application',
            ]);

            $data = $request->except('draft_type');

            $draft = FormDraft::firstOrNew([
                'owner_id' => $user_id,
                'form_type' => $draftType['draft_type'],
            ]);

            $existingData = $draft->form_data ? json_decode($draft->form_data, true) : [];
            $mergedData = array_merge($existingData, $data);
            $draft->form_data = json_encode($mergedData);
            $draft->save();

            return response()->json([
                'success' => true, 'message' => 'Draft saved successfully'], 200);

        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

   public function get(Request $request, $draft_type)
   {
       try {
           $user_id = Auth::user()->id;

           // Find the draft for the specific user and draft type
           $draft = FormDraft::where('owner_id', $user_id)
               ->where('form_type', $draft_type)
               ->where('is_submitted', false)
               ->first();

           // If no draft exists, return an empty success response
           if (!$draft) {
               return response()->json([
                   'success' => true,
                   'message' => 'No draft found',
                   'draftData' => null
               ]);
           }

           // Decode the form data
           $draftData = json_decode($draft->form_data, true) ?? [];

           return response()->json([
               'success' => true,
               'message' => 'Draft retrieved successfully',
               'draftData' => $draftData
           ]);
       } catch (Exception $e) {
           return response()->json([
               'success' => false,
               'message' => 'Error retrieving draft',
               'error' => $e->getMessage()
           ], 500);
       }
   }
}
