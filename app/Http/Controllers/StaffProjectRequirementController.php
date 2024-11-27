<?php

namespace App\Http\Controllers;

use App\Models\BusinessInfo;
use Illuminate\Http\Request;
use App\Models\ProjectFileLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffProjectRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
        ]);

        try {
            $linkRecord = DB::table('project_file_links')
                ->where('Project_id', $validated['project_id'])
                ->select('id', 'file_name', 'file_link', 'created_at', 'is_external')
                ->get();

            return response()->json($linkRecord, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching project links: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching project links'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'action' => 'required|string|in:ProjectLink,ProjectFile',
        ]);
        switch ($validated['action']) {
            case 'ProjectLink':
                return $this->saveProjectFileLink($request);
                break;
            case 'ProjectFile':
                return $this->saveProjectFile($request);
                break;
        }
    }

    public function viewFile($id)
    {
        $fileLink = ProjectFileLink::findOrFail($id);

        $filePath = storage_path("app/private/{$fileLink->file_link}");

        return response()->file($filePath, ['Content-Type' => mime_content_type($filePath)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
    public function update(Request $request, string $LinkName)
    {
        $validated = $request->validate([
            "project_id" => 'required|string|max:15',
            "projectNameUpdated" => 'required|string|max:15',
            "projectLink" => 'required|string|max:255',
        ]);

        try {
            ProjectFileLink::where('file_name', $LinkName)
                ->where('Project_id', $validated['project_id'])
                ->update([
                    'file_name' => $validated['projectNameUpdated'],
                    'file_link' => $validated['projectLink'],
                ]);
            return response()->json(['message' => 'Project link updated successfully.'], 200);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the file record first
            $fileLink = ProjectFileLink::whereId($id)->firstOrFail();

            if (!$fileLink) {
                return response()->json(['message' => 'File link not found.'], 404);
            }

            // If it's an internal file, delete the physical file from storage
            if (!$fileLink->is_external) {
                $filePath = storage_path("app/private/{$fileLink->file_link}");

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Delete the database record
            $fileLink->delete();

            return response()->json(['message' => 'Project link deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::alert('Error deleting project link: ' . $e->getMessage());
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    //TODO: Dynamically Apply Https protocol if the link does not have it
    private function saveProjectFileLink($request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
            'linklist' => 'required|array',
            'linklist.*' => 'required|string|max:255',
        ]);

        try {
            $links = [];
            foreach ($validated['linklist'] as $name => $url) {
                $links[] = [
                    'Project_id' => $validated['project_id'],
                    'file_name' => $name,
                    'file_link' => $this->ensureProtocol($url),
                    'is_external' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert into the database
            ProjectFileLink::insert($links);

            return response()->json(['message' => 'Project links added successfully.'], 200);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    private function saveProjectFile($request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'business_id' => 'required|integer',
            'project_id' => 'required|string|max:15',
            'name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'action' => 'required|string|in:ProjectFile'
        ]);

        if (!Storage::disk('public')->exists($validated['file_path'])) {
            return response()->json([
                'message' => 'File not found.',
            ], 404);
        }

        $firmName = BusinessInfo::where('id', $validated['business_id'])
            ->select('firm_name')
            ->firstOrFail();

        $business_path = "Businesses/{$firmName->firm_name}_{$validated['business_id']}";
        $projectFilePath = $business_path . "/project_files{$validated['project_id']}";

        if (!Storage::disk('public')->exists($projectFilePath)) {
            Storage::disk('private')->makeDirectory($projectFilePath, 0755, true);
        }

        // Create new filename with timestamp to avoid conflicts
        $newFileName = time() . '_' . $validated['name'];


        // Final destination path for the file
        $finalPath = str_replace(' ', '_', $projectFilePath . '/requirements/' . $newFileName);

        // Move the file from temporary location to business directory
        $sourceStream = Storage::disk('public')->readStream($validated['file_path']);
        Storage::disk('private')->writeStream($finalPath, $sourceStream);

        if (is_resource($sourceStream)) {
            fclose($sourceStream);
        }

        // Delete the original file after successful transfer
        Storage::disk('public')->delete($validated['file_path']);


        try {
            // Create a new ProjectFileLink record
            $projectFileLink = new ProjectFileLink();
            $projectFileLink->Project_id = $validated['project_id'];
            $projectFileLink->file_name = $validated['name'];
            $projectFileLink->file_link = $finalPath;
            $projectFileLink->is_external = false;
            $projectFileLink->save();

            return response()->json([
                'message' => 'Project file added successfully.',
            ], 200);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error saving project file: ' . $e->getMessage());

            return response()->json([
                'message' => 'An unexpected error occurred while saving the project file.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function ensureProtocol($url) {
        // Remove any leading/trailing whitespace
        $url = trim($url);

        // Check if URL already has a protocol
        if (preg_match('#^https?://#i', $url)) {
            return $url;
        }

        // Remove any leading slashes or backslashes
        $url = ltrim($url, '/\\');

        // Add https:// by default
        return 'https://' . $url;
    }
}
