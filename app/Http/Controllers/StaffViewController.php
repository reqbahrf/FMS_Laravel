<?php

namespace App\Http\Controllers;

use App\Models\ApplicationInfo;
use App\Models\OngoingQuarterlyReport;
use Illuminate\Support\Facades\DB;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\ProjectInfo;
use Exception;
use Illuminate\Support\Facades\Auth;
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

    public function getHandledProjects(Request $request)
    {

        try {
            $org_userId = Auth::user()->orgusername->id;
            if (Cache::has('handled_projects' . $org_userId)) {
                $handledProjects = Cache::get('handled_projects' . $org_userId);
            } else {
                $handledProjects =  DB::table('project_info')
                    ->join('business_info', 'business_info.id', '=', 'project_info.business_id')
                    ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                    ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                    ->where('handled_by_id', $org_userId)
                    ->whereIn('application_info.application_status', ['approved', 'ongoing', 'completed'])
                    ->select(
                        'users.email',
                        'project_info.Project_id',
                        'project_info.business_id',
                        'project_info.project_title',
                        'project_info.handled_by_id',
                        'project_info.fund_amount',
                        'business_info.id as business_id',
                        'business_info.firm_name',
                        'business_info.enterprise_type',
                        'business_info.enterprise_level',
                        'business_info.landMark',
                        'business_info.barangay',
                        'business_info.city',
                        'business_info.region',
                        'assets.building_value',
                        'assets.equipment_value',
                        'assets.working_capital',
                        'coop_users_info.user_name',
                        'coop_users_info.prefix',
                        'coop_users_info.f_name',
                        'coop_users_info.mid_name',
                        'coop_users_info.l_name',
                        'coop_users_info.suffix',
                        'coop_users_info.gender',
                        'coop_users_info.birth_date',
                        'coop_users_info.designation',
                        'coop_users_info.mobile_number',
                        'coop_users_info.landline',
                        'application_info.created_at as date_applied',
                        'application_info.application_status',
                        'project_info.updated_at as date_approved',

                    )->get();

                Cache::put('handled_projects' . $org_userId, $handledProjects, 60);
            }

            if ($handledProjects) {
                return response()->json($handledProjects);
            } else {
                return response()->json(['message' => 'No projects found'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getProjectsView(Request $request)
    {
        if ($request->ajax()) {
            return view('staffView.StaffProjectTab');
        } else {
            return view('staffView.staffDashboard');
        }
    }

    public function getApprovedProjects()
    {

        try {
            if (Cache::has('approved_projects')) {
                $approvedProjects = Cache::get('approved_projects');
            } else {
                $approvedProjects =  DB::table('users')->join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
                    ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->join('project_info AS pi', 'pi.business_id', '=', 'business_info.id')
                    ->leftJoin('org_users_info as handled_by', function ($join) {
                        $join->on('pi.handled_by_id', '=', 'handled_by.id');
                    })->leftJoin('org_users_info as evaluated_by', function ($join) {
                        $join->on('pi.evaluated_by_id', '=', 'evaluated_by.id');
                    })
                    ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                    ->where('pi.handled_by_id', '!=', null)
                    ->where('pi.evaluated_by_id', '!=', null)
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
                        'business_info.id as business_id',
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
                        'pi.Project_id',
                        'pi.project_title',
                        'pi.fund_amount',
                        'pi.created_at as date_approved',
                        'evaluated_by.full_name As evaluated_by',
                        'handled_by.full_name As assinged_to',
                        'handled_by.user_name as staffUserName',
                        'application_info.created_at as date_applied',
                        'application_info.application_status'
                    )
                    ->get();

                Cache::put('approved_projects', $approvedProjects, 60);
            }


            return response()->json($approvedProjects);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function applicantGet(Request $request)
    {
        if ($request->ajax()) {
            try {
                if (Cache::has('applicants')) {
                    $applicants = Cache::get('applicants');
                } else {
                    $applicants = DB::table('users')->join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
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
                    Cache::put('applicants', $applicants, 60);
                }
                return view('staffView.staffApplicantTab', compact('applicants'));
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return view('staffView.staffDashboard');
        }
    }

    public function applicantGetRequirements(Request $request)
    {

        try {

            $validated = $request->validate([
                'selected_businessID' => 'required|string'
            ]);

            $applicantUploadedFiles = Requirement::where('business_id', $validated['selected_businessID'])
                ->select('file_name', 'file_link', 'file_type', 'can_edit', 'remarks', 'created_at', 'updated_at')
                ->get();

            $result = [];

            foreach ($applicantUploadedFiles as $applicantUploadedFile) {

                if (!storage::disk('public')->exists($applicantUploadedFile->file_link)) {
                    return response()->json(['message' => 'File not found'], 404);
                }

                $result[] = [
                    'file_name' => $applicantUploadedFile->file_name,
                    'full_url' => $applicantUploadedFile->file_link,
                    'file_type' => $applicantUploadedFile->file_type,
                    'can_edit' => $applicantUploadedFile->can_edit,
                    'remarks' => $applicantUploadedFile->remarks,
                    'created_at' => $applicantUploadedFile->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $applicantUploadedFile->updated_at->format('Y-m-d H:i:s'),
                ];
            }

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getScheduledDate(Request $request)
    {

        $validated = $request->validate([
            'business_id' => 'required|integer',
        ]);

        try {

            $scheduled_date = ApplicationInfo::where('business_id', $validated['business_id'])
                ->select('Evaluation_date')
                ->first();

            log::info($scheduled_date);


            if ($scheduled_date->Evaluation_date !== null) {

                $evaluation_date = Carbon::parse($scheduled_date->Evaluation_date)->format('Y-m-d h:i A');

                return response()->json([
                    'Scheduled_date' => $evaluation_date
                ], 200);
            } else {

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

        if (!Storage::disk('public')->exists($fileUrl)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $fileContent = Storage::disk('public')->get($fileUrl);

        $base64File = base64_encode($fileContent);
        return response()->json([
            'base64File' =>  $base64File,
        ], 200);
    }

    public function updateProjectStatusToOngoing(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|integer',
            'project_id' => 'required|string|max:15',
        ]);

        try {
            ApplicationInfo::where('business_id', $validated['business_id'])
                ->whereHas('BusinessInfo.ProjectInfo', function ($query) use ($validated) {
                    $query->where('project_id', $validated['project_id']);
                })
                ->update(['application_status' => 'ongoing']);

            return response()->json(['message' => 'Application status updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to update application status'], 500);
        }
    }

    public function submitProjectProposal(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|integer',
            'projectID' => 'required|string',
            'projectTitle' => 'required|string',
            'fundAmount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
        ]);

        $TestStaffId = 1;

        $fundAmountFormatted = number_format(str_replace(',', '', $validated['fundAmount']), 2, '.', '');
        $Actual_fund_toBeRefund = number_format($fundAmountFormatted + $fundAmountFormatted * 0.05, 2, '.', '');

        try {
            $project = ProjectInfo::where('project_id', $validated['projectID'])->first();
            if ($project) {
                return response()->json(['error' => 'Project Id already exist'], 400);
            }

            ProjectInfo::updateOrCreate(
                ['Project_id' => $validated['projectID']],
                [
                    'business_id' => $validated['business_id'],
                    'evaluated_by_id' => $TestStaffId,
                    'project_title' => $validated['projectTitle'],
                    'fund_amount' => $fundAmountFormatted,
                    'actual_amount_to_be_refund' => $Actual_fund_toBeRefund,
                ]
            );

            ApplicationInfo::where('business_id', $validated['business_id'])
                ->update([
                    'Project_id' => $validated['projectID'],
                    'application_status' => 'pending'
                ]);


            return response()->json(['success' => 'true', 'message' => 'Project Proposal Submitted'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function getAvailableQuarterlyReport(Request $request, $ProjectID)
    {
        try {

            $OngoingQuarterlyReport = OngoingQuarterlyReport::where('ongoing_project_id', $ProjectID)
                ->whereNotNull('report_file')
                ->select('quarter')
                ->get();

            $html = '';
            foreach ($OngoingQuarterlyReport as $report) {
                $html .= '<option value="' . $report->quarter . '">' . $report->quarter . '</option>';
            }

            return response()->json(['html' => $html], 200);
        } catch (Exception $e) {
            response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getProjectSheetsForm(Request $request, $type, $projectId, $quarter = null)
    {
        $rule = [
            'type' => 'required|string|in:PIS,PDS',
            'projectId' => 'required|string|max:15',
            'quarter' => 'nullable'
        ];

        $validated = validator([
            'type' => $type,
            'projectId' => $projectId,
            'quarter' => $quarter,
        ], $rule)->validate();

        $formType = $validated['type'];
        $projectId = $validated['projectId'];
        $quarter = $validated['quarter'];

        switch ($formType) {
            case 'PIS':
                $projectData = $this->getProjectInfomationSheetData($projectId);

                return view('staffView.SheetFormTemplete.PISFormTemplete', compact('projectData'));
                break;

            case 'PDS':
                $projectData = $this->getProjectDataSheetData($projectId, $quarter);
                // $quarterlyData = json_decode($projectData->quarterlyReport, true);

                $quarterlyData = $projectData->quarterlyReport->first()->report_file;

                return view('staffView.SheetFormTemplete.PDSFormTemplete', compact('projectData', 'quarterlyData'));
                break;
        }
    }

    private function getProjectInfomationSheetData(string $projectId): object
    {
        return ProjectInfo::select(
            'Project_id',
            'project_title',
            'business_id',
            'firm_name',
            'enterprise_type',
            'zip_code',
            'landMark',
            'barangay',
            'city',
            'province',
            'region',
            'f_name',
            'mid_name',
            'l_name',
            'suffix',
            'gender',
            'birth_date',
            'mobile_number',
            'landline',
            'email'
        )
            ->join('business_info', 'project_info.business_id', '=', 'business_info.id')
            ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
            ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
            ->where('project_info.Project_id', $projectId)
            ->firstOrFail();
    }

    private function getProjectDataSheetData(string $projectId, string $quarter): object
    {
        return ProjectInfo::select(
            'project_info.Project_id',
            'project_info.project_title',
            'business_info.firm_name',
            'business_info.landMark',
            'business_info.barangay',
            'business_info.city',
            'business_info.province',
            'business_info.region',
            'business_info.zip_code',
            'coop_users_info.f_name',
            'coop_users_info.mid_name',
            'coop_users_info.l_name',
            'coop_users_info.suffix',
            'coop_users_info.designation',
            'coop_users_info.landline',
            'coop_users_info.mobile_number',
            'users.email'
        )
            ->join('business_info', 'project_info.business_id', '=', 'business_info.id')
            ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
            ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
            ->with(['quarterlyReport' => function ($query) use ($quarter) {
                $query->select('ongoing_project_id', 'quarter', 'report_file')
                    ->where('quarter',  $quarter);
            }])
            ->where('project_info.Project_id', $projectId)
            ->firstOrFail();
    }
}
