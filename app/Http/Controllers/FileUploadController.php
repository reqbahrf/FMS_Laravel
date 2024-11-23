<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
public function upload(Request $request)
{
    $request->validate([
        'filepond' => [
            'required',
            'file',
            'max:10240', // 10MB max
            'mimes:pdf,jpg,jpeg,png,webp' // allowed file types
        ]
    ]);

    $uniqueId = '_' . uniqid();
    $file = $request->file('filepond');

    $fileName = $file->hashName();
    $filePath = $file->storeAs("temp/$uniqueId", $fileName, 'public');

    return response()->json([
        'unique_id' => $uniqueId,
        'file_path' => $filePath,
    ]);
}

    public function destroy(Request $request, $uniqueId)
    {
        try {
            //code...
            $filePath = $request->input('file_path');

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                return response()->json(['status' => 'success'], 200);
            }

            return response()->json(['status' => 'error'], 404);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }
}
