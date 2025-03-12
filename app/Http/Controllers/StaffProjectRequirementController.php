<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Services\ProjectFileService;
use App\Http\Resources\ProjectFileLinkCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class StaffProjectRequirementController extends Controller
{
    protected $projectFileService;

    /**
     * Create a new controller instance.
     *
     * @param ProjectFileService $projectFileService
     */
    public function __construct(ProjectFileService $projectFileService)
    {
        $this->projectFileService = $projectFileService;
    }

    /**
     * Display a listing of project file links.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
        ]);

        try {
            $links = $this->projectFileService->getProjectLinks($validated['project_id']);
            return response()->json(new ProjectFileLinkCollection($links), 200);
        } catch (\Exception $e) {
            Log::error('Error fetching project links: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching project links'], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'action' => 'required|string|in:ProjectLink,ProjectFile',
        ]);

        try {
            switch ($validated['action']) {
                case 'ProjectLink':
                    return $this->saveProjectFileLink($request);
                case 'ProjectFile':
                    return $this->saveProjectFile($request);
                default:
                    return response()->json(['error' => 'Invalid action specified'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error in store method: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

    /**
     * Display the specified file.
     *
     * @param int $id
     * @return BinaryFileResponse
     */
    public function viewFile(int $id): BinaryFileResponse
    {
        try {
            $fileDetails = $this->projectFileService->getFileForViewing($id);
            return response()->file(
                $fileDetails['path'],
                ['Content-Type' => $fileDetails['mime_type']]
            );
        } catch (ModelNotFoundException $e) {
            abort(404, 'File not found');
        } catch (Exception $e) {
            Log::error('Error viewing file: ' . $e->getMessage());
            abort(500, 'Error accessing file');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $linkName
     * @return JsonResponse
     */
    public function update(Request $request, string $linkName): JsonResponse
    {
        $validated = $request->validate([
            "project_id" => 'required|string|max:15',
            "projectNameUpdated" => 'required|string|max:15',
            "projectLink" => 'required|string|max:255',
        ]);

        try {
            $this->projectFileService->updateProjectLink(
                $linkName,
                $validated['project_id'],
                $validated['projectNameUpdated'],
                $validated['projectLink']
            );

            return response()->json(['message' => 'Project link updated successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Project link not found'], 404);
        } catch (\Exception $e) {
            Log::error('Error updating project link: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->projectFileService->deleteProjectLink($id);
            return response()->json(['message' => 'Project link deleted successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'File link not found.'], 404);
        } catch (Exception $e) {
            Log::error('Error deleting project link: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    /**
     * Save project file links.
     *
     * @param Request $request
     * @return JsonResponse
     */
    private function saveProjectFileLink(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
            'linklist' => 'required|array',
            'linklist.*' => 'required|string|max:255',
        ]);

        try {
            $this->projectFileService->saveProjectLinks(
                $validated['project_id'],
                $validated['linklist']
            );

            return response()->json(['message' => 'Project links added successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error saving project links: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    /**
     * Save project file.
     *
     * @param Request $request
     * @return JsonResponse
     */
    private function saveProjectFile(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'business_id' => 'required|integer',
            'project_id' => 'required|string|max:15',
            'name' => 'required|string|max:255',
            'file_path' => 'required|string',
            'action' => 'required|string|in:ProjectFile'
        ]);

        try {
            $this->projectFileService->saveProjectFile(
                $validated['business_id'],
                $validated['project_id'],
                $validated['name'],
                $validated['file_path']
            );

            return response()->json(['message' => 'Project file added successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Business not found'], 404);
        } catch (FileNotFoundException $e) {
            return response()->json(['error' => 'File not found.'], 404);
        } catch (Exception $e) {
            Log::error('Error saving project file: ' . $e->getMessage());
            return response()->json([
                'error' => 'An unexpected error occurred while saving the project file.'
            ], 500);
        }
    }
}
