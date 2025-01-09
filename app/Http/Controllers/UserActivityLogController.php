<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\AuditService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserActivityLogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AuditService $auditService)
    {
        try {
            $user_id = Auth::user()->id;
            $auditLogs = $auditService->getUserAuditLogs($user_id);
            return response()->json($auditLogs);
        } catch (Exception $e) {
            Log::error('Error in UserActivityLogController: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
