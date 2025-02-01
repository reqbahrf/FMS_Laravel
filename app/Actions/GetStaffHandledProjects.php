<?php 

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class GetStaffHandledProjects 
{
    public static function execute(int $org_userId) : Collection
    {

        try {
          
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
                        'project_info.fund_amount As Approved_Amount',
                        'project_info.fee_applied',
                        'project_info.actual_amount_to_be_refund As Actual_Amount',
                        'project_info.refunded_amount As Refunded_Amount',
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
                        'coop_users_info.sex',
                        'coop_users_info.birth_date',
                        'coop_users_info.designation',
                        'coop_users_info.mobile_number',
                        'coop_users_info.landline',
                        'application_info.created_at as date_applied',
                        'application_info.application_status',
                        'project_info.updated_at as date_approved',

                    )->get();

                Cache::put('handled_projects' . $org_userId, $handledProjects, 1800);
            }

            return $handledProjects;
        } catch (Exception $e) {
            throw $e;
        }

    }
}