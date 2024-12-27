<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\CoopUserInfo;
use App\Models\ApplicationInfo;
use App\Models\OngoingQuarterlyReport;
use App\Services\getCooperatorInfoService;
use Illuminate\Support\Facades\Log;

class CooperatorViewController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->user_name;

        $user = Auth::user();
        $notifications = $user->notifications;

        return view('CooperatorView.Cooperator_Index', compact('notifications'));
    }


    public function dashboard(Request $request)
    {


        if ($request->ajax()) {
            $username = Session::get('user_name');
            $session_project_id = Session::get('project_id');
            $session_business_id = Session::get('business_id');

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
                ->where('project_info.Project_id', $session_project_id)
                ->where('business_info.id', $session_business_id)
                ->first();


            return view('CooperatorView.CooperatorDashboardTab', compact('row'));
        } else {
            return view('CooperatorView.Cooperator_Index');
        }
    }

    public function CoopProgress()
    {
        $user = Auth::user();
        $session_application_id = Session::get('application_id');
        $session_business_id = Session::get('business_id');

        if ($user) {
            // Eager load the necessary relationships to reduce queries
            $applicationInfo = ApplicationInfo::where('id',  $session_application_id)
                ->where('business_id', $session_business_id)
                ->with('projectInfo')
                ->firstOrFail();

            $projectInfo = $applicationInfo->projectInfo;

            if ($projectInfo) {
                $paymentInfo = $projectInfo->paymentInfo; // Remove ->first() to get all payment records

                if ($paymentInfo->isNotEmpty()) { // Check if there are payment records
                    $paymentList = $paymentInfo->map(function ($payment) {
                        return [
                            'amount' => $payment->amount,
                            'payment_status' => $payment->payment_status,
                            'payment_method' => $payment->payment_method
                        ];
                    });

                    return response()->json([
                        'progress' => [
                            'actual_amount_to_be_refund' => $projectInfo->actual_amount_to_be_refund,
                            'refunded_amount' => $projectInfo->refunded_amount
                        ],
                        'paymentList' => $paymentList
                    ]);
                }
            }
        }


        // Return a default response if no user, project, or payment info is found
        return response()->json([
            'progress' => null,
            'paymentList' => null
        ], 404);  // Return 404 if the necessary data is not found
    }
    public function requirementsGet(Request $request)
    {
        if ($request->ajax()) {

            return view('CooperatorView.CooperatorRequirement');
        } else {
            return view('CooperatorView.Cooperator_Index');
        }
    }

    public function CooperatorProjects(Request $request, getCooperatorInfoService $getCooperatorInfoService)
    {
        if ($request->ajax()) {

            $businessInfos = $getCooperatorInfoService->getCooperatorInfo();
            return view('CooperatorView.CooperatorProjectTab', compact('businessInfos'));
        } else {
            return view('CooperatorView.Cooperator_Index');
        }
    }

}
