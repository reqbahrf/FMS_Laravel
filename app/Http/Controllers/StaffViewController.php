<?php

namespace App\Http\Controllers;

use App\Models\applicationInfo;
use App\Models\businessInfo;
use App\Models\requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class StaffViewController extends Controller
{
    public function dashboard(Request $request)
    {
        //dashboard logic here
        if ($request->ajax()) {
            return view('staffView.staffdashboardTab');
        } else {
            return view('staffView.staffDashboard');
        }
    }

    public function approvedProjectGet(Request $request)
    {

        if ($request->ajax()) {
            $approved = User::join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
                ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                ->join('assets', 'assets.id', '=', 'business_info.id')
                ->join('project_info AS pi', 'pi.business_id', '=', 'business_info.id')
                ->leftJoin('org_users_info', 'pi.handled_by_id', '=', 'org_users_info.id')
                ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                ->where('application_info.application_status', 'approved')
                ->where('users.role', 'Cooperator')
                ->select(
                    'users.user_name',
                    'users.email',
                    'users.role',
                    'coop_users_info.f_name',
                    'coop_users_info.l_name',
                    'coop_users_info.designation',
                    'coop_users_info.mobile_number',
                    'coop_users_info.landline',
                    'business_info.firm_name',
                    'business_info.landmark',
                    'business_info.barangay',
                    'business_info.city',
                    'business_info.province',
                    'business_info.region',
                    'business_info.enterprise_type',
                    'business_info.enterprise_level',
                    'assets.building_value',
                    'assets.equipment_value',
                    'assets.working_capital',
                    'pi.project_title',
                    'pi.fund_amount',
                    'pi.date_approved',
                    'org_users_info.full_name',
                    'application_info.application_status'
                )
                ->get();

            return view('staffView.StaffProjectTab', compact('approved'));
        } else {
            return view('staffView.staffDashboard');
        }
    }

    public function applicantGet(Request $request)
    {
        if ($request->ajax()) {
            $applicants = User::join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
                ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                ->join('assets', 'assets.id', '=', 'business_info.id')
                ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                ->where('application_info.application_status', 'waiting')
                ->select(
                    'users.id as user_id',
                    'users.email',
                    'coop_users_info.prefix',
                    'coop_users_info.f_name',
                    'coop_users_info.mid_name',
                    'coop_users_info.l_name',
                    'coop_users_info.suffix',
                    'coop_users_info.designation',
                    'coop_users_info.mobile_number',
                    'coop_users_info.landline',
                    'business_info.firm_name',
                    'business_info.enterprise_type',
                    'business_info.landMark',
                    'business_info.barangay',
                    'business_info.city',
                    'business_info.province',
                    'business_info.region',
                    'assets.building_value',
                    'assets.equipment_value',
                    'assets.working_capital',
                    'application_info.created_at as date_applied',
                    'application_info.application_status',
                    'business_info.id as business_id'
                )
                ->get();

            return view('staffView.staffApplicantTab', compact('applicants'));
        } else {
            return view('staffView.staffDashboard');
        }
    }

    public function applicantGetRequirements(Request $request)
    {
        $validated = $request->validate([
            'selected_businessID' => 'required|string'
        ]);

        $applicantUploadedFiles = requirement::where('business_id', $validated['selected_businessID'])
            ->select('file_name', 'files', 'file_type', 'can_edit', 'remarks', 'created_at', 'updated_at')
            ->get();

        $result = [];

        foreach ($applicantUploadedFiles as $applicantUploadedFile) {

            $storagePath = 'viewRequirementsTemp/'. $validated['selected_businessID'] . '/' . $applicantUploadedFile->file_name;


            if (!storage::disk('public')->exists($storagePath)) {
                Storage::disk('public')->put($storagePath, $applicantUploadedFile->files);
            }
            $fileUrl = $storagePath;

            $result[] = [
                'file_name' => $applicantUploadedFile->file_name,
                'full_url' => $fileUrl,
                'file_type' => $applicantUploadedFile->file_type,
                'can_edit' => $applicantUploadedFile->can_edit,
                'remarks' => $applicantUploadedFile->remarks,
                'created_at' => $applicantUploadedFile->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $applicantUploadedFile->updated_at->format('Y-m-d H:i:s'),
            ];
        }

        return response()->json($result, 200);
    }

    public function getScheduledDate(Request $request)
    {

        $validated = $request->validate([
            'business_id' => 'required|integer',
        ]);

        try {

            $scheduled_date = applicationInfo::where('business_id', $validated['business_id'])
                ->select('Evaluation_date')
                ->first();

                log::info($scheduled_date);


            if ($scheduled_date->Evaluation_date !== null) {

                $evaluation_date = Carbon::parse($scheduled_date->Evaluation_date)->format('Y-m-d h:i A');

                return response()->json([
                    'Scheduled_date' => $evaluation_date
                ], 200);

            }else{

                return response()->json(['message' => 'Not Scheduled yet']);
            }



        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Not Scheduled yet']);
        }
    }

    public function reviewFileFromUrl(Request $request)
    {
        $validate = $request->validate([
            'file_url' => 'required|string'
        ]);
        $fileUrl = $validate['file_url'];

        if(!Storage::disk('public')->exists($fileUrl)){
            return response()->json(['error' => 'File not found'], 404);
        }

        $fileContent = Storage::disk('public')->get($fileUrl);

        $base64File = base64_encode($fileContent);
        return response()->json([
            'base64File' =>  $base64File,
        ], 200);


    }

    public function createDataSheet(Request $request)
    {
        if ($request->ajax()) {
            return view('staffView.outputs.DataSheetTable');
        } else {
            return view('staffView.staffDashboard');
        }
    }

    public function createInformationSheet(Request $request)
    {
        if ($request->ajax()) {
            return view('staffView.outputs.InformationSheetTable');
        } else {
            return view('staffView.staffDashboard');
        }
    }
}
