<?php

namespace App\Actions;

use Exception;
use App\Models\User;
use Illuminate\Support\Carbon;

class DocumentStatusAction
{
    /**
     * Determine reviewer or modifier information based on document status
     *
     * @param string $status The document status (reviewed or pending)
     * @param User $user The user performing the action
     * @return array The reviewer/modifier information
     * @throws Exception If the status is invalid
     */
    public static function determineReviewerOrModifier(string $status, User $user): array
    {
        switch ($status) {
            case 'reviewed':
                return [
                    'reviewed_by' => $user->id,
                    'reviewed_at' => now(),
                    'modified_by' => null,
                    'modified_at' => null
                ];
            case 'pending':
                return [
                    'reviewed_by' => null,
                    'reviewed_at' => null,
                    'modified_by' => $user->id,
                    'modified_at' => now()
                ];
            default:
                throw new Exception('Invalid status');
        }
    }
}
