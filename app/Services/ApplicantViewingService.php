<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class ApplicantViewingService
{
    private $prefix = 'applicant_viewing:';

    public function setViewingState($applicantId, $reviewedBy)
    {
        Cache::put($this->prefix . $applicantId, $reviewedBy, now()->addHours(24));

        // Keep track of all viewing states
        $keys = Cache::tags(['applicant-viewing'])->get('viewing_states', []);
        if (!in_array($applicantId, $keys)) {
            $keys[] = $applicantId;
            Cache::tags(['applicant-viewing'])->put('viewing_states', $keys, now()->addHours(24));
        }
    }

    public function removeViewingState($applicantId)
    {
        Cache::forget($this->prefix . $applicantId);

        // Remove from tracking
        $keys = Cache::tags(['applicant-viewing'])->get('viewing_states', []);
        $keys = array_diff($keys, [$applicantId]);
        Cache::tags(['applicant-viewing'])->put('viewing_states', $keys, now()->addHours(24));
    }

    public function getAllViewingStates()
    {
        $states = [];
        $keys = Cache::tags(['applicant-viewing'])->get('viewing_states', []);

        foreach ($keys as $applicantId) {
            $reviewedBy = Cache::get($this->prefix . $applicantId);
            if ($reviewedBy) {
                $states[] = [
                    'applicant_id' => $applicantId,
                    'reviewed_by' => $reviewedBy
                ];
            }
        }

        return $states;
    }
}
