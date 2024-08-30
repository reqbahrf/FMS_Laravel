<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\coopUserInfo;

class CooperatorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications;

        $userId = Session::get('user_id');
        $userName = Session::get('user_name');
        $userBirthD = Session::get('birth_date');

        if (!isset($userId) && !isset($userName) && !isset($userBirthD)) {
            return redirect()->route('login.Form');
        }
        else
        {
            $result = coopUserInfo::where('user_name', $userName)
                ->with('businessInfo.applicationInfo')
                ->first();

            if ($result) {

                $applicationStatus = $result->businessInfo->first()->applicationInfo->first()->application_status;
                Session::put('application_status', $applicationStatus);

                if (in_array($applicationStatus, ['approved', 'ongoing'])) {
                    $projectInfo = $result->businessInfo->first()->projectInfo->first();
                    if ($projectInfo) {
                        Session::put('project_id', $projectInfo->Project_id);
                        Session::put('business_id', $projectInfo->business_id);

                        Log::info('Project_id Type: ' . gettype($projectInfo->Project_id));
                        Log::info('Project_id Value: ' . $projectInfo->Project_id);
                        Log::info('Session Project_id: ' . Session::get('project_id'));
                    }
                }
            }

            return view('cooperatorView.CooperatorDashboard', compact('notifications') , [
                'application_status' => Session::get('application_status')
            ]);
        }



    }
    public function dashboard(Request $request)
    {


        if($request->ajax())
        {
            $username = Session::get('user_name');

        // Query the database
        $row = DB::table('coop_users_info')
            ->Join('users', 'users.user_name', '=', 'coop_users_info.user_name')
            ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
            ->join('project_info', 'project_info.business_id', '=', 'business_info.id')
            ->select(
                'users.user_name',
                'users.email',
                'project_info.project_title',
                'coop_users_info.f_name',
                'coop_users_info.l_name',
                'coop_users_info.designation',
                'coop_users_info.landline',
                'coop_users_info.mobile_number',
                'business_info.firm_name',
                'business_info.landMark',
                'business_info.barangay',
                'business_info.city',
                'business_info.province',
                'business_info.region',
            )
            ->where('coop_users_info.user_name', $username)
            ->first();

        return view('cooperatorView.CooperatorInformationTab', compact('row'));


        }
        else
        {
            return view('cooperatorView.CooperatorDashboard');
        }


    }

    public function requirementsGet(Request $request)
    {
        if($request->ajax())
        {
            return view('cooperatorView.CooperatorRequirement');
        }
        else
        {
            return view('cooperatorView.CooperatorDashboard');
        }

    }

}
