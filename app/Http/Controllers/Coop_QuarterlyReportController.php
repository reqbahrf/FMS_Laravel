<?php

namespace App\Http\Controllers;

use App\Models\OngoingQuarterlyReport;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Coop_QuarterlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            return view('cooperatorView.outputs.quarterlyReport');
        }else{
            return view('cooperatorView.CooperatorDashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project_id = Session::get('project_id');
        $quarter = 'Q1';
        OngoingQuarterlyReport::create([
            'ongoing_project_id' => $project_id,
            'quarter' => $quarter,
            'report_file' => json_encode($request->all()),
        ]);
        return response()->json(['success' => true, 'message' => 'File uploaded successfully.']);
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
