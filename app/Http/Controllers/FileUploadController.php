<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use App\Http\Requests\TemporaryFileUploadRequest;

class FileUploadController extends Controller
{
    public function upload(TemporaryFileUploadRequest $request)
    {
        try {
            // The request is already validated by TemporaryFileUploadRequest
            $file = $request->file(key($request->allFiles()));
            $uniqueId = '_' . uniqid();

            // Get original filename and sanitize it
            $originalFileName = $file->getClientOriginalName();
            $sanitizedFileName = $file->hashName();

            // Define the directory path for storing the file
            $directory = "tmp/$uniqueId";
            $path = "$directory/$sanitizedFileName";

            // Get authenticated user ID if available
            $ownerId = Auth::id() ?? null;

            // If the file is an image (compress), otherwise store as-is
            if (str_starts_with($file->getMimeType(), 'image/')) {
                // Create image instance
                $image = Image::read($file->getPathname());

                Log::info("Original image size: {$file->getSize()} bytes");

                // Compress the image without resizing (e.g., 75% quality)
                $format = $file->extension();
                switch (strtolower($format)) {
                    case 'jpg':
                    case 'jpeg':
                        $encoder = new JpegEncoder(quality: 50);
                        break;
                    case 'png':
                        $encoder = new PngEncoder();
                        break;
                    case 'webp':
                        $encoder = new WebpEncoder(quality: 50);
                        break;
                    default:
                        $encoder = new JpegEncoder(quality: 50); // fallback
                }
                $imageStream = $image->encode($encoder);
                Storage::disk('public')->put($path, $imageStream);

                $compressedSize = Storage::disk('public')->size($path);
                Log::info("Compressed image size: {$compressedSize} bytes");
            } else {
                // Store non-image files directly
                $path = $file->storeAs($directory, $sanitizedFileName, 'public');
            }

            // Store file information in the database
            TemporaryFile::create([
                'owner_id' => $ownerId,
                'unique_id' => $uniqueId,
                'file_name' => $sanitizedFileName,
                'original_file_name' => $originalFileName,
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => Storage::disk('public')->size($path),
            ]);

            return response()->json([
                'status' => 'success',
                'unique_id' => $uniqueId,
                'file_path' => $path,
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
