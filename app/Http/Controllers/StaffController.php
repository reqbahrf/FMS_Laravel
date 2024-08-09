<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard(Request $request)
    {
        //dashboard logic here
        if($request -> ajax()){
            return view('staffView.staffdashboardTab');

        }
        else
        {
            return view('staffView.staffDashboard');
        }

    }

    public function approvedProjectGet(Request $request)
    {

        if($request->ajax())
        {
            $approved = User::join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
            ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
            ->join('assets', 'assets.id', '=', 'business_info.id')
            ->join('project_info AS pi', 'pi.business_id', '=', 'business_info.id')
            ->leftJoin('org_users_info', 'pi.handled_by_id', '=', 'org_users_info.id')
            ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
            ->where('application_info.application_status', 'approved')
            ->where('users.role', 'Cooperator')
            ->select('users.user_name', 'users.email', 'users.role', 'coop_users_info.f_name', 'coop_users_info.l_name',
                'coop_users_info.designation', 'coop_users_info.mobile_number', 'coop_users_info.landline',
                'business_info.firm_name', 'business_info.landmark','business_info.barangay', 'business_info.city', 'business_info.province', 'business_info.region', 'business_info.enterprise_type',
                'business_info.enterprise_level', 'assets.building_value', 'assets.equipment_value',
                'assets.working_capital', 'pi.project_title', 'pi.fund_amount', 'pi.date_approved',
                'org_users_info.full_name', 'application_info.application_status')
            ->get();

            return view('staffView.StaffProjectTab', compact('approved'));

        }
        else{
            return view('staffView.staffDashboard');
        }



    }

    public function applicantGet(Request $request)
    {
        if($request->ajax())
        {
            $applicants = User::join('coop_users_info', 'coop_users_info.user_name', '=', 'users.user_name')
            ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
            ->join('assets', 'assets.id', '=', 'business_info.id')
            ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
            ->where('application_info.application_status', 'waiting')
            ->select( 'users.email', 'coop_users_info.prefix', 'coop_users_info.f_name', 'coop_users_info.mid_name', 'coop_users_info.l_name', 'coop_users_info.suffix',
                     'coop_users_info.designation', 'coop_users_info.mobile_number', 'coop_users_info.landline',
                     'business_info.firm_name', 'business_info.enterprise_type', 'business_info.landMark','business_info.barangay', 'business_info.city', 'business_info.province', 'business_info.region',
                     'assets.building_value', 'assets.equipment_value', 'assets.working_capital',
                     'application_info.date_applied', 'application_info.application_status', 'business_info.id')
            ->get();

            return view('staffView.staffApplicantTab', compact('applicants'));

        }
        else{
            return view('staffView.staffDashboard');
        }

    }
    public function createDataSheet(Request $request)
    {
        if($request->ajax())
        {
            return view('staffView.outputs.DataSheetTable');
        }
        else{
            return view('staffView.staffDashboard');
        }

    }

    public function createInformationSheet(Request $request)
    {
        if($request->ajax())
        {
            return view('staffView.outputs.InformationSheetTable');
        }
        else{
            return view('staffView.staffDashboard');
        }

    }
}
