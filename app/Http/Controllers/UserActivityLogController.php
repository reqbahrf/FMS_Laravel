<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\AuditService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserActivityLogController extends Controller
{
    protected $auditService;

    function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    /**
     * Handle the incoming request.
     */
    public function getPersonalActivityLog()
    {
        try {
            $user_id = Auth::user()->id;
            $auditLogs = $this->auditService->getUserAuditLogs($user_id);
            return response()->json($auditLogs);
        } catch (Exception $e) {
            Log::error('Error in UserActivityLogController: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function getSelectedUserActivityLog(int $user_id)
    {
        try {
            if (!$user_id) {
                return response()->json(['error' => 'User ID is required'], 400);
            }

            $auditLogs = $this->auditService->getSelectedUserAuditLogs($user_id);
            return response()->json($auditLogs);


        } catch (Exception $e) {
            Log::error('Error in getSelectedUserActivityLog: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }

    }
}
