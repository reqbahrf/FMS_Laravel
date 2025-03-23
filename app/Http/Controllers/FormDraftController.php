<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FormDraft;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FormDraftController extends Controller
{

    public function store(Request $request)
    {
        try {
            $user_id = $request->user()->id;
            $draftType = $request->validate([
                'draft_type' => 'required|string',
            ]);

            $data = $request->except('draft_type');

            $draft = FormDraft::firstOrNew([
                'owner_id' => $user_id,
                'form_type' => $draftType['draft_type'],
            ]);

            $existingData = $draft->form_data ? $draft->form_data : [];
            $mergedData = array_merge($existingData, $data);
            $draft->form_data = $mergedData;
            $draft->save();

            return response()->json([
                'success' => true,
                'message' => 'Draft saved successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function get(Request $request, $draft_type)
    {
        try {
            $user_id = $request->user()->id;
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
            $draftData = $draft->form_data ?? [];

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

    public function getFiles($uniqueId)
    {
        try {
            $tempFile = TemporaryFile::where('unique_id', $uniqueId)
                ->first();

            if (!$tempFile || !Storage::disk('public')->exists($tempFile->file_path)) {
                throw new Exception('File not found on the server or has been expired. Please try again');
            }
            $filePath = $tempFile->file_path;
            $file = Storage::disk('public')->get($filePath);

            return Response::make($file, 200)
                ->header('Content-Type', $tempFile->mime_type)
                ->header('X-File-Name', $tempFile->file_name)
                ->header('X-File-Size', $tempFile->file_size)
                ->header('X-File-Type', $tempFile->type)
                ->header('X-File-path', $tempFile->owner_id)
                ->header('X-Unique-Id', $tempFile->unique_id);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
