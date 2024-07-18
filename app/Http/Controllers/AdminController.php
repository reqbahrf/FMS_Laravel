<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return view('AdminView.adminDashboardTab');
        }else
        {
            return view('AdminView.adminDashboard');
        }

    }

    public function applicantGet(Request $request){

        if($request->ajax())
        {
            $applicants = User::join('coop_users_info', 'users.user_name', '=', 'coop_users_info.user_name')
            ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
            ->join('assets', 'assets.id', '=', 'business_info.id')
            ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
            ->where('application_info.application_status', 'waiting')
            ->get([
                'users.id as user_id', 'coop_users_info.f_name', 'coop_users_info.l_name', 'coop_users_info.designation',
                'coop_users_info.mobile_number', 'coop_users_info.landline', 'business_info.firm_name', 'business_info.enterprise_type', 'business_info.landMark',
                'business_info.barangay', 'business_info.city', 'business_info.city', 'business_info.province', 'business_info.region', 'assets.building_value', 'assets.equipment_value', 'assets.working_capital',
                'application_info.date_applied', 'business_info.id'
            ]);

           return view('AdminView.adminProjectlistTab', compact('applicants'));

        }
        else
        {
            return view('AdminView.adminDashboard');

        }

    }

    public function userGet(Request $request){

        if($request->ajax())
        {
            return view('AdminView.adminUsersTab');
        }
        else
        {
            return view('AdminView.adminDashboard');
        }

    }
}
