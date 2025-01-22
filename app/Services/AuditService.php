<?php

namespace App\Services;

use Exception;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class AuditService
{
    protected $audit;
    public function __construct(Audit $audit)
    {
        $this->audit = $audit;
    }


    /**
     * Creates an audit log entry.
     *
     * @param string $event The event that triggered the audit log.
     * @param object|null $auditable The auditable model.
     * @param array $newValues The new values of the model.
     * @param array $oldValues The old values of the model.
     * @param string|null $tags The tags associated with the audit log.
     * @return void
     * @throws Exception If saving the audit log fails.
     */
    public function createAuditLog(
        string $event,
        ?object $auditable = null,
        array $newValues = [],
        array $oldValues = [],
        ?string $tags = null
    ): void {
        try {
            // Create a new Audit instance instead of using the injected one
            $audit = new Audit();

            $audit->event = $event;

            $request = request();
            if ($request) {
                $audit->ip_address = $request->ip();
                $audit->user_agent = $request->userAgent();
                $audit->url = $request->fullUrl();
            }

            $user = Auth::user();
            if ($user) {
                $audit->user_id = $user->id;
                $audit->user_type = $user->role;
            }

            if ($auditable) {
                $audit->auditable_id = $auditable->id;
                $audit->auditable_type = get_class($auditable);
            }

            $audit->old_values = json_encode($oldValues);
            $audit->new_values = json_encode($newValues);

            if ($tags) {
                $audit->tags = $tags;
            }

            if (!$audit->save()) {
                Log::error("Failed to save audit log", [
                    'event' => $event,
                    'user_id' => $user?->id ?? null,
                    'user_type' => $user?->role ?? null,
                    'auditable_id' => $auditable?->id ?? null,
                    'auditable_type' => $auditable ? get_class($auditable) : null,
                ]);
                throw new Exception('Failed to save audit log');
            }
        } catch (QueryException $e) {
            Log::error("Audit log creation failed (database error): " . $e->getMessage());
        } catch (Exception $e) {
            Log::error("Audit log creation failed (general error): " . $e->getMessage());
        }
    }

    /**
     * Retrieves audit logs based on specified filters, pagination, and sorting.
     *
     * @param array $filters An array of filters to apply to the query.
     * @param int $limit The number of records to return per page.
     * @param string $orderBy The column to order the results by.
     * @param string $sortOrder The sort order ('asc' or 'desc').
     * @return ?object A paginated collection of audit logs, or null on failure.
     */
    protected function getAuditLogs(
        array $filters = [],
        array $selector = ['*'],
        int $limit = 50,
        string $orderBy = 'created_at',
        string $sortOrder = 'desc',
    ): ?object {
        try {

            $query = $this->audit->query();

            // Filter by user ID
            if (isset($filters['user_id'])) {
                $query->where('user_id', $filters['user_id']);
            }

            // Filter by user type (if you have multiple user types)
            if (isset($filters['user_type'])) {
                $query->where('user_type', $filters['user_type']);
            }

            // Filter by auditable type (model)
            if (isset($filters['auditable_type'])) {
                $query->where('auditable_type', $filters['auditable_type']);
            }

            // Filter by auditable ID
            if (isset($filters['auditable_id'])) {
                $query->where('auditable_id', $filters['auditable_id']);
            }

            // Filter by event type
            if (isset($filters['event'])) {
                $query->where('event', $filters['event']);
            }

            // Filter by date range
            if (isset($filters['start_date'])) {
                $query->where('created_at', '>=', $filters['start_date']);
            }
            if (isset($filters['end_date'])) {
                $query->where('created_at', '<=', $filters['end_date']);
            }

            return $query->orderBy($orderBy, $sortOrder)
                ->select($selector)
                ->paginate($limit);
        } catch (QueryException $e) {
            Log::error("Audit log retrieval failed (database error): " . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            Log::error("Audit log retrieval failed (general error): " . $e->getMessage());
            throw $e;
        }
    }

    public function getUserAuditLogs(int $user_id): ?object
    {
        try {
            $selector = ['user_type', 'event', 'ip_address', 'user_agent', 'url', 'created_at'];
            return $this->getAuditLogs(['user_id' => $user_id], $selector);
        } catch (Exception $e) {
            Log::error('Error in getUserAuditLogs: ' . $e->getMessage());
            throw new Exception('Error in getUserAuditLogs: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function getSelectedUserAuditLogs(int $user_id): ?object
    {
        try {
            $auditLogs = $this->getAuditLogs(['user_id' => $user_id], ['*']);

            $auditLogs->each(function ($audit) {
                // Decode old_values and new_values from JSON strings to arrays
                $old = (array) $audit->old_values ?? [];
                $new = (array) $audit->new_values ?? [];

                // Transform the keys
                $transformed = $this->transformAuditKeys($old, $new);

                $audit->old_values = $transformed['old_values'] ?? [];
                $audit->new_values = $transformed['new_values'] ?? [];

                // Merge remaining transformed data
                $audit = (object) array_merge((array) $audit, $transformed);
            });

            return $auditLogs;
        } catch (Exception $e) {
            Log::error('Error in getSelectedUserAuditLogs: ' . $e->getMessage());
            throw $e;
        }
    }

    private function transformAuditKeys($old_values, $new_values): array
    {
        // Force inputs to arrays
        $old = is_array($old_values) ? $old_values : [];
        $new = is_array($new_values) ? $new_values : [];

        $keyTransformations = [
            'product_id' => 'Product ID',
            'transaction_id' => 'Transaction ID',
            'user_id' => 'User ID',
            'project_id' => 'Project ID',
            'amount' => 'Amount',
            'payment_status' => 'Payment Status',
            'payment_method' => 'Payment Method',
        ];

        // Normalize keys to lowercase for consistent matching
        $normalizedOld = array_change_key_case($old, CASE_LOWER);
        $normalizedNew = array_change_key_case($new, CASE_LOWER);

        $transformedOld = [];
        $transformedNew = [];

        // Transform old and new values
        foreach ($normalizedOld as $key => $value) {
            // Find the transformed key
            $transformedKey = $keyTransformations[strtolower($key)] ?? ucwords(str_replace('_', ' ', $key));
            $transformedValue = (is_numeric($value) && $transformedKey == 'Amount') 
                ? number_format(floatval($value), 2, '.', ',')  
                : $value;

            $transformedOld[$transformedKey] = $transformedValue;
        }

        // Add any keys in $new that are not in $old
        foreach ($normalizedNew as $key => $value) {

            $transformedKey = $keyTransformations[strtolower($key)] ?? ucwords(str_replace('_', ' ', $key));
            $transformedValue = (is_numeric($value) && $transformedKey == 'Amount')
                ? number_format(floatval($value), 2, '.', ',')  
                : $value;
            $transformedNew[$transformedKey] = $transformedValue;
        }

        return [
            'old_values' => $transformedOld,
            'new_values' => $transformedNew,
        ];
    }
}
