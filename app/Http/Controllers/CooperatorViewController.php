<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use App\Models\PaymentRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\GetCooperatorInfoService;

class CooperatorViewController extends Controller
{
    protected $authUser;
    protected $username;
    protected $session_business_id;
    protected $session_project_id;
    protected $session_application_id;

    public function __construct()
    {
        $this->authUser = Auth::user();
        $this->username = $this->authUser->user_name;
        $this->session_business_id = Session::get('business_id');
        $this->session_project_id = Session::get('project_id');
        $this->session_application_id = Session::get('application_id');
    }
    public function index(GetCooperatorInfoService $getCooperatorInfoService)
    {

        $notifications = $this->authUser->notifications;
        $businessInfos = $getCooperatorInfoService->getAllCoopInfo();

        return view('cooperator-view.cooperator_index', compact(['notifications', 'businessInfos']));
    }


    public function LoadDashboardTab(Request $request)
    {
        if ($request->ajax()) {
            // Query the database
            $row = DB::table('coop_users_info')
                ->Join('users', 'users.user_name', '=', 'coop_users_info.user_name')
                ->join('business_info', 'business_info.user_info_id', '=', 'coop_users_info.id')
                ->join('business_address_info', 'business_address_info.business_info_id', '=', 'business_info.id')
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
                    'business_address_info.factory_zip_code'
                )
                ->where('coop_users_info.user_name', $this->username)
                ->where('project_info.Project_id', $this->session_project_id)
                ->where('business_info.id', $this->session_business_id)
                ->first();


            return view('cooperator-view.coop-page-tab.dashboard-tab', compact('row'));
        } else {
            return view('cooperator-view.cooperator_index');
        }
    }

    public function CoopProgress()
    {
        try {

            if ($this->authUser) {
                // Eager load the necessary relationships to reduce queries
                $applicationInfo = ApplicationInfo::where('id',  $this->session_application_id)
                    ->where('business_id', $this->session_business_id)
                    ->with('projectInfo.paymentInfo')
                    ->firstOrFail();

                $projectInfo = $applicationInfo->projectInfo;

                if ($projectInfo) {
                    $paymentInfo = $projectInfo->paymentInfo;

                    if ($paymentInfo->isNotEmpty()) {
                        $filteredPaymentInfo = $paymentInfo->filter(function ($payment) {
                            return in_array($payment->payment_status, ['Pending', 'Due', 'Overdue']);
                        });

                        $sortedPaymentInfo = $filteredPaymentInfo->sortBy(function ($payment) {
                            return array_search($payment->payment_status, ['Overdue', 'Due', 'Pending']);
                        });

                        $earliestPayment = $sortedPaymentInfo->sortBy('due_date')->first();

                        if ($earliestPayment) {
                            $bannerData = [
                                'amount' => $earliestPayment->amount,
                                'payment_status' => $earliestPayment->payment_status,
                                'payment_method' => $earliestPayment->payment_method,
                                'due_date' => $earliestPayment->due_date->format('Y-m-d'),
                            ] ?? [];
                        }

                        return response()->json([
                            'progress' => [
                                'actual_amount_to_be_refund' => $projectInfo->actual_amount_to_be_refund ?? [],
                                'refunded_amount' => $projectInfo->refunded_amount ?? []
                            ],
                            'bannerData' => $bannerData ?? []
                        ], 200);
                    }
                }
            }
            return response()->json([
                'progress' => [],
                'bannerData' => []
            ], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'progress' => null,
                'paymentList' => null
            ], 500);
        }
    }
    public function LoadRefundTab(Request $request)
    {
        if ($request->ajax()) {
            $refundStructure = PaymentRecord::where('Project_id', $this->session_project_id)
                ->get()
                ->sortBy('due_date');

            return view('cooperator-view.coop-page-tab.refund-tab', compact('refundStructure'));
        } else {
            return view('cooperator-view.cooperator_index');
        }
    }

    public function LoadCooperatorProjectsTab(Request $request, GetCooperatorInfoService $getCooperatorInfoService)
    {
        if ($request->ajax()) {

            $businessInfos = $getCooperatorInfoService->getAllCoopInfo();
            return view('cooperator-view.coop-page-tab.project-tab', compact('businessInfos'));
        } else {
            return view('cooperator-view.cooperator_index');
        }
    }
}
