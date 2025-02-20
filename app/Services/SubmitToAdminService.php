<?php

namespace App\Services;

use App\Models\ApplicationInfo;
use App\Models\ProjectInfo;
use Exception;

class SubmitToAdminService
{
    public function updateProjectInfo(int $business_id, array $data){
        try {
            ProjectInfo::create([
                'Project_id' => $data['Project_id'],
                'business_id' => $business_id,
                'evaluated_by_id' => $data['staff_id'],
                'project_title' => $data['project_title'],
                'fund_amount' => $data['fund_amount'],
                'fee_applied' => $data['fee_applied'],
                'actual_amount_to_be_refund' => $data['actual_amount_to_be_refund'],
            ]);

        }catch(Exception $e){
            throw new Exception('Failed to update project info: ' . $e->getMessage() || 'Failed to update project info');
        }
    }
    public function updateApplicationInfo(int $business_id,int $application_id, array $data)
    {
        try {
            ApplicationInfo::where('business_id', $business_id)
                ->where('id', $application_id)
                ->update([
                    'Project_id' => $data['Project_id'],
                    'application_status' => 'pending',
                ]);

        } catch (Exception $e) {
            throw new Exception('Failed to update application info: ' . $e->getMessage() || 'Failed to update application info');
        }
    }
}

