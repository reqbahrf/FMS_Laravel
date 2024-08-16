<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
                $query = "SELECT coop_users_info.user_name, business_info.user_info_id, application_info.application_status
                          FROM coop_users_info
                          INNER JOIN business_info ON business_info.user_info_id = coop_users_info.id
                          INNER JOIN application_info ON application_info.business_id = business_info.id
                          WHERE coop_users_info.user_name = ?;";

                $result = DB::select($query, [$userName]);

                if (count($result) > 0) {
                    Session::put('application_status', $result[0]->application_status);
                } else {
                    // Handle the case where there are no results
                }

                if (Session::get('application_status') == 'approved') {
                    $projectInfoQuery = "SELECT coop_users_info.user_name, business_info.id AS business_id, project_info.project_id AS project_id
                                         FROM coop_users_info
                                         INNER JOIN business_info ON business_info.user_info_id = coop_users_info.id
                                         INNER JOIN project_info ON project_info.business_id = business_info.id
                                         WHERE coop_users_info.user_name = ?;";

                    $projectInfo = DB::select($projectInfoQuery, [$userName]);

                    if (count($projectInfo) > 0) {
                        Session::put('business_id', $projectInfo[0]->business_id);
                        Session::put('project_id', $projectInfo[0]->project_id);
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
            return view('CooperatorView.CooperatorDashboard');
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
