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
     * Used DB::table facade to prevent loading all models into memory and for improve performance
     * Used Cache::remember to cache the result for 30 minutes
     */
    public function __invoke(Request $request)
    {
        try {
            $applicants = Cache::remember('applicants', 1800, function () {
                return DB::table('application_info')
                    ->join('business_info', 'business_info.id', '=', 'application_info.business_id')
                    ->join('business_address_info', 'business_address_info.business_info_id', '=', 'business_info.id')
                    ->join('coop_users_info', 'coop_users_info.id', '=', 'business_info.user_info_id')
                    ->join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                    ->join('users_address_info', 'users_address_info.user_info_id', '=', 'users.id')
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
                        'coop_users_info.birth_date',
                        'coop_users_info.mobile_number',
                        'coop_users_info.landline',
                        'users_address_info.landmark',
                        'users_address_info.barangay',
                        'users_address_info.city',
                        'users_address_info.province',
                        'users_address_info.region',
                        'users_address_info.zip_code',
                        'business_info.firm_name',
                        'business_info.enterprise_type',
                        'business_info.sectors',
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
                        'application_info.id as Application_ID',
                        'application_info.created_at as date_applied',
                        'application_info.application_status',
                        'application_info.requested_fund_amount',
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
                    ->get()
                    ->map(function ($item) {
                        $sectors = json_decode($item->sectors, true) ?: [];
                        $item->sectors = collect($sectors)->map(function ($sector) {
                            return $sector['name'] . '(' . $sector['specific'] . ')';
                        })->implode(', ');
                        return $item;
                    });
            });

            return response()->json($applicants, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
