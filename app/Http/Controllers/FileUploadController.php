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
            $sanitizedFileName = $this->sanitizeFileName($originalFileName);

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

    /**
     * Sanitize a filename to make it safe for storage
     *
     * @param string $fileName The original filename
     * @return string The sanitized filename
     */
    private function sanitizeFileName($fileName)
    {
        // Get file extension
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Get filename without extension and sanitize it
        $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);

        // Remove any characters that aren't alphanumeric, dashes, underscores or dots
        $nameWithoutExt = preg_replace('/[^a-zA-Z0-9-_.]/', '', $nameWithoutExt);

        // Replace spaces with underscores
        $nameWithoutExt = str_replace(' ', '_', $nameWithoutExt);

        // Limit the length of the filename (optional)
        $nameWithoutExt = Str::limit($nameWithoutExt, 100, '');

        // If the filename is empty after sanitization, use a default name
        if (empty($nameWithoutExt)) {
            $nameWithoutExt = 'file_' . Str::random(8);
        }

        // Combine sanitized name with extension
        return $nameWithoutExt . '.' . $extension;
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
