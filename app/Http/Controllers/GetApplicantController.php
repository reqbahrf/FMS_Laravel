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
        //TODO: can't retrive multiple business Info for one coop_users need to be fix
        try {
            if (Cache::has('applicants')) {
                $applicants = Cache::get('applicants');
            } else {
                $applicants = DB::table('users')->join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
                    ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                    ->join('assets', 'assets.id', '=', 'business_info.id')
                    ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
                    ->whereIn('application_info.application_status', ['new', 'evaluation' ,'pending'])
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
                        'application_info.id as Application_ID',
                        'application_info.created_at as date_applied',
                        'application_info.application_status',
                        'business_info.id as business_id'
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
