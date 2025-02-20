<?php

namespace App\Http\Controllers;

use App\Services\ProjectProposaldataHandlerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class GetPendingProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ProjectProposaldataHandlerService $service)
    {
        try {
            if (Cache::has('pendingProjects')) {
                $pendingProjects = Cache::get('pendingProjects');
            } else {
                $pendingProjects = DB::table('application_info')
                    ->where('application_info.application_status', 'pending')
                    ->join('business_info', 'application_info.business_id', '=', 'business_info.id')
                    ->join('project_info', 'project_info.business_id', '=', 'business_info.id')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->join('org_users_info', 'project_info.evaluated_by_id', '=', 'org_users_info.id')
                    ->join('coop_users_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                    ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                    ->whereNotNull('project_info.business_id')
                    ->select([
                        'business_info.id',
                        'business_info.firm_name',
                        'business_info.enterprise_type',
                        'business_info.enterprise_level',
                        'business_info.zip_code',
                        'business_info.landMark',
                        'business_info.barangay',
                        'business_info.city',
                        'business_info.province',
                        'business_info.region',
                        'assets.building_value',
                        'assets.equipment_value',
                        'assets.working_capital',
                        'application_info.id as application_id',
                        'application_info.application_status',
                        'project_info.Project_id',
                        'project_info.project_title',
                        'project_info.evaluated_by_id',
                        'project_info.fund_amount',
                        'project_info.fee_applied',
                        'project_info.created_at as date_proposed',
                        'org_users_info.prefix as evaluated_by_prefix',
                        'org_users_info.f_name as evaluated_by_f_name',
                        'org_users_info.mid_name as evaluated_by_mid_name',
                        'org_users_info.l_name as evaluated_by_l_name',
                        'org_users_info.suffix as evaluated_by_suffix',
                        'coop_users_info.f_name as applicant_f_name',
                        'coop_users_info.mid_name as applicant_mid_name',
                        'coop_users_info.l_name as applicant_l_name',
                        'coop_users_info.suffix as applicant_suffix',
                        'coop_users_info.designation as applicant_designation',
                        'coop_users_info.mobile_number as applicant_mobile_number',
                        'coop_users_info.landline as applicant_landline',
                        'users.email as applicant_email'
                    ])
                    ->get();

                Cache::put('pendingProjects', $pendingProjects, 1800);
            }

            return response()->json($pendingProjects, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
