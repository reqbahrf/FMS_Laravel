<?php

namespace App\Actions;

use Exception;
use App\Models\User;
use App\Models\OrgUserInfo;
use Illuminate\Support\Carbon;

class DocumentStatusAction
{
    /**
     * Determine reviewer or modifier information based on document status
     *
     * @param string $status The document status (reviewed or pending)
     * @param OrgUserInfo $user The user performing the action
     * @param array|null $existingData Optional existing data to preserve modifier information
     * @return array The reviewer/modifier information
     * @throws Exception If the status is invalid
     */
    public static function determineReviewerOrModifier(string $status, OrgUserInfo $user, ?array $existingData = null): array
    {
        switch ($status) {
            case 'reviewed':
                return [
                    'reviewed_by' => $user->id,
                    'reviewed_at' => now(),
                    'modified_by' => $existingData['modified_by'] ?? null,
                    'modified_at' => $existingData['modified_at'] ?? null
                ];
            case 'pending':
                return [
                    'reviewed_by' => $existingData['reviewed_by'] ?? null,
                    'reviewed_at' => $existingData['reviewed_at'] ?? null,
                    'modified_by' => $user->id,
                    'modified_at' => now()
                ];
            default:
                throw new Exception('Invalid status');
        }
    }
}
