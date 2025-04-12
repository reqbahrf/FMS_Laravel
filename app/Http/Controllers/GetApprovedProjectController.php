<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class GetApprovedProjectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $approvedProjects = Cache::remember('approved_projects', 1800, function () {
                return DB::table('application_info')
                    ->join('business_info', 'business_info.id', '=', 'application_info.business_id')
                    ->join('business_address_info', 'business_address_info.business_info_id', '=', 'business_info.id')
                    ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                    ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->join('project_info AS pi', 'pi.business_id', '=', 'business_info.id')
                    ->leftJoin('org_users_info as handled_by', function ($join) {
                        $join->on('pi.handled_by_id', '=', 'handled_by.id');
                    })->leftJoin('org_users_info as evaluated_by', function ($join) {
                        $join->on('pi.evaluated_by_id', '=', 'evaluated_by.id');
                    })
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
                        'business_info.enterprise_type',
                        'business_info.enterprise_level',
                        'business_address_info.office_landmark',
                        'business_address_info.office_barangay',
                        'business_address_info.office_city',
                        'business_address_info.office_province',
                        'business_address_info.office_region',
                        'business_address_info.office_zip_code',
                        'business_address_info.factory_landmark',
                        'business_address_info.factory_barangay',
                        'business_address_info.factory_city',
                        'business_address_info.factory_province',
                        'business_address_info.factory_region',
                        'business_address_info.factory_zip_code',
                        'assets.building_value',
                        'assets.equipment_value',
                        'assets.working_capital',
                        'pi.Project_id',
                        'pi.project_title',
                        'pi.fund_amount',
                        'pi.created_at as date_approved',
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
                        'application_info.id as application_id',
                        'application_info.created_at as date_applied',
                        'application_info.application_status'
                    )
                    ->get();
            });

            return response()->json($approvedProjects);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
