<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\CoopUserInfo;
use App\Models\OngoingQuarterlyReport;
use Illuminate\Support\Facades\Log;

class CooperatorViewController extends Controller
{
    public function index()
    {
        $userId = Session::get('user_id');
        $userName = Session::get('user_name');
        $userBirthD = Session::get('birth_date');

        $user = Auth::user();
        $notifications = $user->notifications;

        $result = CoopUserInfo::where('user_name', $userName)
            ->with('BusinessInfo.applicationInfo')
            ->first();

        if (!$result) {
            return redirect()->route('login.Form');
        }

        $applicationStatus = $result->BusinessInfo->first()->applicationInfo->first()->application_status;
        Session::put('application_status', $applicationStatus);

        if (in_array($applicationStatus, ['approved', 'ongoing'])) {
            $projectInfo = $result->BusinessInfo->first()->projectInfo->first();
            Session::put('project_id', $projectInfo->Project_id ?? null);
            Session::put('business_id', $projectInfo->business_id ?? null);
        }

        return view('cooperatorView.CooperatorDashboard', compact('notifications'), [
            'application_status' => $applicationStatus
        ]);
    }


    public function dashboard(Request $request)
    {


        if ($request->ajax()) {
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
        } else {
            return view('cooperatorView.CooperatorDashboard');
        }
    }

    public function CoopProgress()
{
    $user = Auth::user();

    if ($user) {
        // Eager load the necessary relationships to reduce queries
        $projectInfo = $user->coopUserInfo->businessInfo->first()->projectInfo->first();

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
            return view('cooperatorView.CooperatorRequirement');
        } else {
            return view('cooperatorView.CooperatorDashboard');
        }
    }
}
