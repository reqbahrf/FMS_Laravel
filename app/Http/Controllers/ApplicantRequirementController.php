<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;


class ApplicantRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $business_id)
    {
        try {
            $applicantUploadedFiles = Requirement::where('business_id', $business_id)
                ->select([
                    'id',
                    'file_name',
                    'file_link',
                    'file_type',
                    'can_edit',
                    'remarks',
                    'remark_comments',
                    'created_at',
                    'updated_at'
                ])
                ->get();

            $result = $applicantUploadedFiles->map(function ($file) {
                if (!Storage::disk('private')->exists($file->file_link)) {
                    throw new FileNotFoundException('File not found');
                }

                return [
                    'id' => $file->id,
                    'file_name' => $file->file_name,
                    'full_url' => $file->file_link,
                    'file_type' => $file->file_type,
                    'can_edit' => $file->can_edit,
                    'remarks' => $file->remarks,
                    'remark_comments' => $file->remarks_comments,
                    'created_at' => $file->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $file->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json($result, 200);
        } catch (FileNotFoundException $e) {
            Log::error('File not found: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {

            $validated = $request->validate([
                'file_url' => 'required|string'
            ]);


            if (!Storage::disk('private')->exists($validated['file_url'])) {
                return response()->json(['error' => 'File not found'], 404);
            }

            $fileContent = Storage::disk('private')->get($validated['file_url']);

            $base64File = base64_encode($fileContent);
            return response()->json([
                'base64File' =>  $base64File,
            ], 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userRole = Auth::user()->role;

        try {
            switch ($userRole) {
                case 'Staff':
                    return $this->updateReviewedFile($request, $id);
                    break;
                case 'Cooperator':
                    return $this->uploadNewFile($request, $id);
                    break;
            }
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage() || 'Something went wrong'], 500);
        }
    }

    protected function updateReviewedFile($request, $id)
    {

        $validated = $request->validate([
            'action' => 'required|string|in:Approved,Rejected',
            'file_url' => 'required|string',
            'remark_comments' => 'nullable|string',
        ]);
        try {
            $ReviewFile = Requirement::where('id', $id)->first();

            $canEdit = $validated['action'] === 'Approved' ? false : true;

            $ReviewFile->update([
                'can_edit' => $canEdit,
                'remarks' => $validated['action'],
                'remark_comments' => $validated['remark_comments'],
                'updated_at' => now(),
            ]);
            return response()->json(['success' => 'File Reviewed'], 200);
        } catch (Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage() || 'Something went wrong'], 500);
        }
    }

    protected function uploadNewFile($request, $id)
    {

        $validated = $request->validate([
            'file_link' => 'required|string',
            'file' => 'required|mimetypes:application/pdf,image/jpeg,image/png|max:10240',
        ]);

        try {
            $filePath = Storage::disk('private')->exists($validated['file_link']);

            if (!$filePath) {
                throw new Exception("File not found: " . $validated['file_link']);
            }

            $ToBeUpdatedFile = Requirement::where('id', $id)
                ->where('file_link', $validated['file_link'])
                ->where('remarks', 'Rejected')
                ->where('can_edit', true)
                ->first();

            if (!$ToBeUpdatedFile) {
                return response()->json(['message' => 'Action is not allowed'], 500);
            }

            if (Storage::disk('private')->delete($validated['file_link'])) {

                $validated['file']->storeAs('private', $validated['file_link']);
                $ToBeUpdatedFile->update([
                    'can_edit' => false,
                    'remarks' => 'Pending',
                ]);
                return response()->json(['success' => 'File Uploaded'], 200);
            } else {
                throw new Exception('Failed to delete file');
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() || 'Something went wrong'], 500);
        }
    }
}
