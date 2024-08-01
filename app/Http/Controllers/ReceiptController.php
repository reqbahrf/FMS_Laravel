<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\ReceiptUpload;
use Illuminate\Support\Facades\Log;

class ReceiptController extends Controller
{

    public function img_upload(Request $request)
    {
        // Validate the request
        $request->validate([
            'receipt_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $project_id = Session::get('project_id');
        if (!$project_id) {
            return response()->json(['error' => 'Project ID not found.'], 400);
        }

        // Generate a unique ID based on the project_id
        $uniqueId = $project_id . '_' . uniqid();

        // Handle the file upload
        $file = $request->file('receipt_file');
        $uniqueId = $project_id . '_' . uniqid();
        $fileName = $uniqueId . '.' . $file->getClientOriginalExtension();
        $tempPath = $file->storeAs('tmp', $fileName, 'public');

        return response()->json([
            'temp_file_path' => $tempPath,
            'unique_id' => $uniqueId
        ]);
    }

    public function img_revert($uniqueId, Request $request)
    {
        $filePath = $request->input('receiptfilePath');
        log::info('File path: ' . $filePath);

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return response()->json(['status' => 'success'], 200);
        }

    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $projectId = Session::get('project_id');

        $receiptUploads = ReceiptUpload::where('ongoing_project_id', $projectId)
            ->select('ongoing_project_id','receipt_name', 'receipt_file', 'remark', 'created_at')
            ->get();

        $result = [];
        foreach ($receiptUploads as $receiptUpload) {
            $result[] = [
                'ongoing_project_id' => $receiptUpload->ongoing_project_id,
                'receipt_name' => ($receiptUpload->receipt_name),
                'receipt_file' => base64_encode($receiptUpload->receipt_file),
                'remark' => ($receiptUpload->remark),
                'created_at' => $receiptUpload->created_at->format('Y-m-d H:i:s'),
            ];
        }

        return response()->json($result);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'receiptName' => 'required|string|max:20',
            'unique_id' => 'required|string'
        ]);

        // Retrieve project_id from session
        $project_id = Session::get('project_id');
        if (!$project_id) {
            return redirect()->back()->withErrors(['error' => 'Project ID not found.']);
        }

        // Generate the unique file name based on unique_id
        $uniqueId = $request->input('unique_id');
        $filePaths = Storage::disk('public')->files('tmp', $uniqueId);
        if (empty($filePaths)) {
            return redirect()->back()->withErrors(['error' => 'File not found in temporary storage.']);
        }

        $filePath = $filePaths[0]; // Assume there's only one matching file
        $fileContent = Storage::disk('public')->get($filePath);

        // Insert into the database
        ReceiptUpload::create([
            'ongoing_project_id' => $project_id,
            'receipt_name' => $request->input('receiptName'),
            'receipt_file' => $fileContent, // Store the file content as a BLOB
            'can_edit' => 'yes', // Or whatever default value you prefer
            'remark' => null,
            'comment' => null
        ]);

        // Optionally, delete the temporary file after processing
        Storage::disk('public')->delete($filePath);

        // Return success response
        return response()->json(['success' => 'Receipt uploaded and saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
