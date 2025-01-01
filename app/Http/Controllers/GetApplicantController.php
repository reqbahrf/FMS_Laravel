<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;

class GetApplicantController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            if (Cache::has('applicants')) {
                $applicants = Cache::get('applicants');
            } else {
                $applicants = DB::table('application_info')
                    ->join('business_info', 'business_info.id', '=', 'application_info.business_id')
                    ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                    ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->leftJoin('personnel', 'personnel.id', '=', 'business_info.id')
                    ->whereIn('application_info.application_status', ['new', 'evaluation', 'pending', 'rejected'])
                    ->select(
                        'users.id as user_id',
                        'users.email',
                        'coop_users_info.prefix',
                        'coop_users_info.f_name',
                        'coop_users_info.mid_name',
                        'coop_users_info.l_name',
                        'coop_users_info.suffix',
                        'coop_users_info.designation',
                        'coop_users_info.sex',
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
                        'application_info.id as Application_ID',
                        'application_info.created_at as date_applied',
                        'application_info.application_status',
                        'business_info.id as business_id',
                        'personnel.male_direct_re',
                        'personnel.female_direct_re',
                        'personnel.male_direct_part',
                        'personnel.female_direct_part',
                        'personnel.male_indirect_re',
                        'personnel.female_indirect_re',
                        'personnel.male_indirect_part',
                        'personnel.female_indirect_part',
                        DB::raw('(COALESCE(male_direct_re, 0) + COALESCE(female_direct_re, 0) +
                                COALESCE(male_direct_part, 0) + COALESCE(female_direct_part, 0) +
                                COALESCE(male_indirect_re, 0) + COALESCE(female_indirect_re, 0) +
                                COALESCE(male_indirect_part, 0) + COALESCE(female_indirect_part, 0)) as total_personnel')
                    )
                    ->distinct()
                    ->get();
                Cache::put('applicants', $applicants, 1800);
            }
            return response()->json($applicants, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
