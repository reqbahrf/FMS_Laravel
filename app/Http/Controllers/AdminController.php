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
            $applicants = User::join('personal_info', 'users.user_name', '=', 'personal_info.user_name')
            ->join('business_info', 'business_info.user_info_id', '=', 'personal_info.id')
            ->join('assets', 'assets.business_id', '=', 'business_info.id')
            ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
            ->where('application_info.application_status', 'waiting')
            ->get([
                'users.id as user_id', 'personal_info.f_name', 'personal_info.l_name', 'personal_info.designation',
                'personal_info.mobile_number', 'personal_info.landline', 'business_info.firm_name', 'business_info.enterprise_type',
                'business_info.B_address', 'assets.building_value', 'assets.equipment_value', 'assets.working_capital',
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
