<?php

namespace App\Services;

use App\Models\ProjectSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Exception;

class ProjectFeeService
{
    public function __construct(private ProjectSetting $projectSetting)
    {
        $this->projectSetting = $projectSetting;
    }

    /**
     * Retrieve the project fee percentage
     *
     * @throws ModelNotFoundException If fee percentage setting is not found
     * @return float
     */
    public function getProjectFee(): float
    {
        try {
            $feeSetting = $this->projectSetting->where('key', 'fee_percentage')->firstOrFail();

            $feeValue = floatval($feeSetting->value);

            if ($feeValue < 0 || $feeValue > 100) {
                throw new InvalidArgumentException('Fee percentage must be between 0 and 100');
            }

            return $feeValue;
        } catch (ModelNotFoundException $e) {
            Log::error('Project fee setting not found', [
                'error' => $e->getMessage(),
                'context' => 'Fee percentage retrieval'
            ]);
            throw $e;
        } catch (Exception $e) {
            Log::error('Unexpected error retrieving project fee', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Update the project fee percentage
     *
     * @param float $fee_percentage The new fee percentage
     * @throws InvalidArgumentException If fee percentage is invalid
     * @throws Exception If update fails
     */
    public function updateProjectFee(float $fee_percentage): object
    {
        // Validate input
        if ($fee_percentage < 0 || $fee_percentage > 100) {
            throw new InvalidArgumentException('Fee percentage must be between 0 and 100');
        }

        try {
            $updated = $this->projectSetting->updateOrCreate(
                ['key' => 'fee_percentage'],
                ['value' => number_format($fee_percentage, 2)]
            );

            Log::info('Project fee percentage updated', [
                'fee_percentage' => $fee_percentage,
                'updated' => $updated
            ]);

            return response()->json(['message' => 'Project fee percentage updated successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error updating project fee', [
                'error' => $e->getMessage(),
                'fee_percentage' => $fee_percentage,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Check if project fee setting exists
     *
     * @return bool
     */
    public function feeSettingExists(): bool
    {
        return $this->projectSetting->where('key', 'fee_percentage')->exists();
    }
}
