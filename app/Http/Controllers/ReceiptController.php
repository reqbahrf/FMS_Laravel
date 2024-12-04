<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BusinessInfo;
use Illuminate\Http\Request;
use App\Models\ReceiptUpload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{

    /**
     * Display a listing of the resource.
     */

     //TODO: adjust the Foreign key to accept multiple ongoing_project_id
    public function index()
    {
        $projectId = Session::get('project_id');

        $receiptUploads = ReceiptUpload::where('ongoing_project_id', $projectId)
            ->select(
                'ongoing_project_id',
                'receipt_name',
                'receipt_description',
                'receipt_file_link',
                'remark',
                'created_at')
            ->get();

        $receiptData = [];
        foreach ($receiptUploads as $receiptUpload) {
            $fileContent = Storage::disk('private')->get($receiptUpload->receipt_file_link);
            $base64File = base64_encode($fileContent);

            $receiptData[] = [
                'ongoing_project_id' => $receiptUpload->ongoing_project_id,
                'receipt_name' => $receiptUpload->receipt_name,
                'receipt_description' => $receiptUpload->receipt_description,
                'receipt_image' => $base64File,
                'remark' => $receiptUpload->remark,
                'created_at' => $receiptUpload->created_at->format('Y-m-d H:i:s'),
            ];
        }

        return response()->json($receiptData);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'receiptName' => 'required|string|max:30',
                'receiptShortDescription' => 'required|string|max:255',
                'unique_id' => 'required|string'
            ]);

            // Check for required session data
            if (!$project_id = Session::get('project_id')) {
                return $this->errorResponse('Project ID not found.');
            }

            if (!$business_id = Session::get('business_id')) {
                return $this->errorResponse('Business ID not found.');
            }

            // Find temporary file
            $tempFilePath = $this->findTemporaryFile($validated['unique_id']);
            if (!$tempFilePath) {
                return $this->errorResponse('Temporary file not found.');
            }

            // Get business info and prepare paths
            $firmName = BusinessInfo::where('id', $business_id)
                ->value('firm_name');

            if (!$firmName) {
                return $this->errorResponse('Business information not found.');
            }

            // Prepare file paths
            $paths = $this->preparePaths($firmName, $business_id, $project_id, $validated['receiptName'], $validated['unique_id']);

            // Move file from temporary to final location
            if (!$this->moveFile($tempFilePath, $paths['finalPath'])) {
                return $this->errorResponse('Failed to move file to final location.');
            }

            // Create receipt record
            ReceiptUpload::create([
                'ongoing_project_id' => $project_id,
                'receipt_name' => $validated['receiptName'],
                'receipt_description' => $validated['receiptShortDescription'],
                'receipt_file_link' => $paths['finalPath'],
                'can_edit' => false,
                'remark' => 'Pending',
            ]);

            return response()->json(['success' => 'Receipt uploaded and saved successfully.']);
        } catch (Exception $e) {
            Log::error('Receipt upload failed: ' . $e->getMessage());
            return $this->errorResponse('Failed to process receipt upload.');
        }
    }

    private function findTemporaryFile($uniqueId)
    {
        $filePaths = Storage::disk('public')->files("tmp/{$uniqueId}");
        return $filePaths[0] ?? null;
    }

    private function getFileExtension($filePath)
    {
        return pathinfo(Storage::disk('public')->path($filePath), PATHINFO_EXTENSION);
    }

    private function preparePaths($firmName, $businessId, $projectId, $receiptName, $uniqueId)
    {
        $business_path = "Businesses/{$firmName}_{$businessId}";
        $projectFilePath = "{$business_path}/project_files{$projectId}/receipts";

        if (!Storage::disk('private')->exists($projectFilePath)) {
            Storage::disk('private')->makeDirectory($projectFilePath, 0777, true);
        }

        // Get original file extension
        $tempFilePath = $this->findTemporaryFile($uniqueId);
        $extension = $this->getFileExtension($tempFilePath);

        $newFileName = uniqid(time() . '_') . '_' . $receiptName;
        // Add the extension to the filename
        $newFileName = $newFileName . '.' . $extension;

        $finalPath = str_replace(' ', '_', "{$projectFilePath}/{$newFileName}");

        return [
            'projectPath' => $projectFilePath,
            'finalPath' => $finalPath
        ];
    }

    private function moveFile($sourcePath, $destinationPath)
    {
        try {
            $sourceStream = Storage::disk('public')->readStream($sourcePath);
            $result = Storage::disk('private')->writeStream($destinationPath, $sourceStream);

            if (is_resource($sourceStream)) {
                fclose($sourceStream);
            }

            // Clean up temporary file
            Storage::disk('public')->delete($sourcePath);

            return $result;
        } catch (Exception $e) {
            Log::error('File move failed: ' . $e->getMessage());
            return false;
        }
    }

    private function errorResponse($message)
    {
        return response()->json(['error' => $message], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $validated = validator()->make(['id' => $id], [
            'id' => 'required|string|max:32',
        ]);

        $receiptUploads = ReceiptUpload::where('ongoing_project_id', $validated->validated()['id'])
            ->select(
                'id',
                'ongoing_project_id',
                'receipt_name',
                'receipt_description',
                'receipt_file_link',
                'remark',
                'comment',
                'created_at')
            ->get();

            $receiptData = [];
            foreach ($receiptUploads as $receiptUpload) {
                $fileContent = Storage::disk('private')->get($receiptUpload->receipt_file_link);
                $base64File = base64_encode($fileContent);

                $receiptData[] = [
                    'id' => $receiptUpload->id,
                    'ongoing_project_id' => $receiptUpload->ongoing_project_id,
                    'receipt_name' => $receiptUpload->receipt_name,
                    'receipt_description' => $receiptUpload->receipt_description,
                    'receipt_image' => $base64File,
                    'remark' => $receiptUpload->remark,
                    'comment' => $receiptUpload->comment,
                    'created_at' => $receiptUpload->created_at->format('Y-m-d H:i:s'),
                ];
            }

            return response()->json($receiptData);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
