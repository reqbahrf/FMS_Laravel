<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectProposalController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'projectID' => 'required|string',
            'projectTitle' => 'required|string',
            'dateOfFundRelease' => 'required|date',
            'fundAmount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'expectedOutputs' => 'required|array',
            'equipmentDetails' => 'required|array',
            'nonEquipmentDetails' => 'required|array',
            'action' => 'required|string',
            'application_id' => 'required|numeric',
        ]);

        $proposalData = [
            'projectID' => $validated['projectID'],
            'projectTitle' => $validated['projectTitle'],
            'dateOfFundRelease' => $validated['dateOfFundRelease'],
            'fundAmount' => $validated['fundAmount'],
        ];

        $proposalData['equipmentDetails'] = array_map(function ($equipmentDetail) {
            return [
                'Qty' => $equipmentDetail['Qty'],
                'Actual_Particulars' => $equipmentDetail['Actual_Particulars'],
                'Cost' => $equipmentDetail['Cost'],
            ];
        }, $validated['equipmentDetails']);

        $proposalData['nonEquipmentDetails'] = array_map(function ($nonEquipmentDetail) {
            return [
                'Qty' => $nonEquipmentDetail['Qty'],
                'Actual_Particulars' => $nonEquipmentDetail['Actual_Particulars'],
                'Cost' => $nonEquipmentDetail['Cost'],
            ];
        }, $validated['nonEquipmentDetails']);

        $proposalData['expectedOutputs'] = $validated['expectedOutputs'];

        return dd($proposalData);
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
