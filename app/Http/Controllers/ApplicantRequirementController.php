<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Requirement;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

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
                    'file_name',
                    'file_link',
                    'file_type',
                    'can_edit',
                    'remarks',
                    'created_at',
                    'updated_at'
                ])
                ->get();

            $result = $applicantUploadedFiles->map(function ($file) {
                if (!Storage::disk('public')->exists($file->file_link)) {
                    throw new FileNotFoundException('File not found');
                }

                return [
                    'file_name' => $file->file_name,
                    'full_url' => $file->file_link,
                    'file_type' => $file->file_type,
                    'can_edit' => $file->can_edit,
                    'remarks' => $file->remarks,
                    'created_at' => $file->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $file->updated_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json($result, 200);
        } catch (FileNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $validated = $request->validate([
            'file_url' => 'required|string'
        ]);


        if (!Storage::disk('public')->exists($validated['file_url'])) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $fileContent = Storage::disk('public')->get($validated['file_url']);

        $base64File = base64_encode($fileContent);
        return response()->json([
            'base64File' =>  $base64File,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requirement $requirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requirement $requirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requirement $requirement)
    {
        //
    }
}
