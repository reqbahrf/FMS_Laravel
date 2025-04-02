<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemporaryFileUploadRequest;
use App\Models\TemporaryFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function upload(TemporaryFileUploadRequest $request)
    {
        try {
            // The request is already validated by TemporaryFileUploadRequest

            $file = $request->file(key($request->allFiles()));
            $uniqueId = '_' . uniqid();

            // Get original filename and sanitize it
            $originalFileName = $file->getClientOriginalName();
            $sanitizedFileName = $file->hashName();

            $filePath = $file->storeAs("tmp/$uniqueId", $sanitizedFileName, 'public');

            // Get authenticated user ID if available
            $ownerId = Auth::id() ?? null;

            // Store file information in the database
            TemporaryFile::create([
                'owner_id' => $ownerId,
                'unique_id' => $uniqueId,
                'file_name' => $sanitizedFileName,
                'original_file_name' => $originalFileName,
                'file_path' => $filePath,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);

            return response()->json([
                'status' => 'success',
                'unique_id' => $uniqueId,
                'file_path' => $filePath,
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
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
