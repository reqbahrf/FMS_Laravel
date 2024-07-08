<?php

namespace App\Http\Controllers;

use App\Models\User;


class StaffController extends Controller
{
    public function dashboard(){
        //dashboard logic here

        return view('staffView.staffdashboardTab');
    }

    public function approvedProjectGet()
    {
        $approved = User::join('personal_info', 'personal_info.user_name', '=', 'users.user_name')
        ->join('business_info', 'business_info.user_info_id', '=', 'personal_info.id')
        ->join('assets', 'assets.business_id', '=', 'business_info.id')
        ->join('project_info AS pi', 'pi.business_id', '=', 'business_info.id')
        ->leftJoin('org_users_info', 'pi.handled_by_id', '=', 'org_users_info.id')
        ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
        ->where('application_info.application_status', 'approved')
        ->where('users.role', 'Cooperator')
        ->select('users.user_name', 'users.email', 'users.role', 'personal_info.f_name', 'personal_info.l_name',
            'personal_info.designation', 'personal_info.mobile_number', 'personal_info.landline',
            'business_info.firm_name', 'business_info.B_address', 'business_info.enterprise_type',
            'business_info.enterprise_level', 'assets.building_value', 'assets.equipment_value',
            'assets.working_capital', 'pi.project_title', 'pi.fund_amount', 'pi.date_approved',
            'org_users_info.full_name', 'application_info.application_status')
        ->get();

        return view('staffView.StaffProjectTab', compact('approved'));


    }

    public function applicantGet()
    {
        $applicants = User::join('personal_info', 'personal_info.user_name', '=', 'users.user_name')
        ->join('business_info', 'business_info.user_info_id', '=', 'personal_info.id')
        ->join('assets', 'assets.business_id', '=', 'business_info.id')
        ->join('application_info', 'application_info.business_id', '=', 'business_info.id')
        ->where('application_info.application_status', 'waiting')
        ->select('users.user_name', 'users.email', 'personal_info.f_name', 'personal_info.l_name',
                 'personal_info.designation', 'personal_info.mobile_number', 'personal_info.landline',
                 'business_info.firm_name', 'business_info.enterprise_type', 'business_info.B_address',
                 'assets.building_value', 'assets.equipment_value', 'assets.working_capital',
                 'application_info.date_applied', 'application_info.application_status', 'business_info.id')
        ->get();

        return view('staffView.staffApplicantTab', compact('applicants'));
    }
    public function createDataSheet()
    {
        return view('staffView.outputs.DataSheetTable');
    }

    public function createInformationSheet()
    {
        return view('staffView.outputs.InformationSheetTable');
    }
}
