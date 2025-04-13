<?php

namespace App\Http\Controllers;

use App\Models\BusinessInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;

class SetProjectToLoadController extends Controller
{
    /**
     * Sets the project to load based on the provided business and application IDs.
     * Cooperatoor view project Controller
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|integer|exists:business_info,id',
            'application_id' => 'required|integer|exists:application_info,id',
        ]);

        $businessInfo = BusinessInfo::where('id', $validated['business_id'])
            ->with('applicationInfo.projectInfo')
            ->first();

        if (!$businessInfo) {
            return redirect()->withError('Business not found');
        }

        $applicationStatus = $businessInfo->applicationInfo->find($validated['application_id'])->application_status;

        if (!$applicationStatus) {
            return redirect()->withError('Application not found');
        }

        Session::put('application_id', $validated['application_id']);
        Session::put('application_status', $applicationStatus);
        Session::put('business_id', $validated['business_id']);

        if (in_array($applicationStatus, ['approved', 'ongoing', 'completed'])) {
            $projectInfo = $businessInfo->applicationInfo->find($validated['application_id'])->projectInfo;
            Session::put('project_id', $projectInfo->Project_id ?? null);
        }

        return redirect()->back()->withSuccess('Project set to load successfully');
    }
}
