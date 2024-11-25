<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        $filePath = $file->storeAs("tmp/$uniqueId", $fileName, 'public');

        // Store file information in the database
        $tempFile = TemporaryFile::create([
            'unique_id' => $uniqueId,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return response()->json([
            'unique_id' => $uniqueId,
            'file_path' => $filePath,
        ]);
    }

    public function destroy(Request $request, $uniqueId)
    {
        try {
            $tempFile = TemporaryFile::where('unique_id', $uniqueId)->first();

            if (!$tempFile) {
                return response()->json(['status' => 'error', 'message' => 'File not found'], 404);
            }

            // Delete from storage
            if (Storage::disk('public')->exists($tempFile->file_path)) {
                Storage::disk('public')->delete($tempFile->file_path);
            }

            // Delete from database
            $tempFile->delete();

            return response()->json(['status' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
