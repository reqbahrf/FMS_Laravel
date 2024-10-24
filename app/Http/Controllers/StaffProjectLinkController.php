<?php

namespace App\Http\Controllers;

use App\Models\ProjectFileLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StaffProjectLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
        ]);

        try{

            $linkRecord = DB::table('project_file_links')->where('Project_id', '=', $validated['project_id'])
                ->select('file_name', 'file_link', 'created_at')
                ->get();
            return response()->json($linkRecord, 200);

        }catch(\Exception $e){
            Log::error('Error fetching project links: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching project links'], 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Initial validation for project_id and linklist array
        $validated = $request->validate([
            'project_id' => 'required|string|max:15',
            'linklist' => 'required|array',
            'linklist' => [
                function ($attribute, $value, $fail) {
                    foreach ($value as $key => $link) {
                        if (!preg_match('/^(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w-]*)*(\?.*)?$/', $link)) {
                            $fail('The linklist.' . $key . ' must be a valid URL.');
                        }
                    }
                },
            ]
        ]);

        try {
            // Prepare data for batch insert
            $data = array_map(function ($name, $url) use ($validated) {
                return [
                    'Project_id' => $validated['project_id'],
                    'file_name' => $name,
                    'file_link' => $url,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, array_keys($validated['linklist']), $validated['linklist']);

            // Batch insert into the database
            ProjectFileLink::insert($data);

            return response()->json(['message' => 'Project links added successfully.'], 200);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
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
    public function destroy(string $LinkName)
    {
        try {
            ProjectFileLink::where('file_name', $LinkName)->delete();
            return response()->json(['message' => 'Project link deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return response()->json(['message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }
}
