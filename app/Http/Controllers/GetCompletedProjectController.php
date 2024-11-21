<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetCompletedAdminProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        try {
            if (Cache::has('completed_projects')) {
                $ongoingProjects = Cache::get('completed_projects');
            } else {
                $ongoingProjects = DB::table('users')
                    ->join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
                    ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->join('project_info as PI', 'PI.business_id', '=', 'business_info.id')
                    ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                    ->leftJoin('org_users_info as handled_by', function ($join) {
                        $join->on('PI.handled_by_id', '=', 'handled_by.id');
                    })->leftJoin('org_users_info as evaluated_by', function ($join) {
                        $join->on('PI.evaluated_by_id', '=', 'evaluated_by.id');
                    })
                    ->where('application_info.application_status', 'completed')
                    ->where('users.role', 'Cooperator')
                    ->whereNotNull('PI.handled_by_id')
                    ->whereNotNull('PI.evaluated_by_id')
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
                        'PI.Project_id',
                        'PI.project_title',
                        'PI.fund_amount',
                        'PI.actual_amount_to_be_refund as to_be_refunded',
                        'PI.refunded_amount as amount_refunded',
                        'PI.created_at as date_approved',
                        'evaluated_by.prefix as evaluated_by_prefix',
                        'evaluated_by.f_name as evaluated_by_f_name',
                        'evaluated_by.mid_name as evaluated_by_mid_name',
                        'evaluated_by.l_name as evaluated_by_l_name',
                        'evaluated_by.suffix as evaluated_by_suffix',
                        'handled_by.prefix as handled_by_prefix',
                        'handled_by.f_name as handled_by_f_name',
                        'handled_by.mid_name as handled_by_mid_name',
                        'handled_by.l_name as handled_by_l_name',
                        'handled_by.suffix as handled_by_suffix',
                        'handled_by.user_name as staffUserName',
                        'application_info.created_at as date_applied',
                        'application_info.application_status'
                    )->get();

                Cache::put('completed_projects', $ongoingProjects, 1800);
            }
            return response()->json($ongoingProjects);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
