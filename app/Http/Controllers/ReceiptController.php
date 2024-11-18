<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\ReceiptUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class ReceiptController extends Controller
{

    public function img_upload(Request $request)
    {
        // Validate the request
        $request->validate([
            'receipt_file' => 'required|image|mimes:jpeg,png,jpg|max:10240'
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
        $fileName = $uniqueId . '.' . $file->extension();
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
            $fileContent = Storage::disk('public')->get($receiptUpload->receipt_file_link);
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

        // Validate the request
        $validated = $request->validate([
              'receiptName' => 'required|string|max:30',
              'receiptShortDescription' => 'required|string|max:255',
              'unique_id' => 'required|string'
          ]);
        try {

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
            if(Storage::disk('public')->exists($filePath)){

                ReceiptUpload::create([
                    'ongoing_project_id' => $project_id,
                    'receipt_name' => $validated['receiptName'],
                    'receipt_description' => $validated['receiptShortDescription'],
                    'receipt_file_link' => $filePath,
                    'can_edit' => false,
                    'remark' => 'Pending',
                ]);
            }

            // Insert into the database

            // Return success response
            return response()->json(['success' => 'Receipt uploaded and saved successfully.']);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
                $fileContent = Storage::disk('public')->get($receiptUpload->receipt_file_link);
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
