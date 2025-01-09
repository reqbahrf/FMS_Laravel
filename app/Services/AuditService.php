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
        ): void
    {
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

                if($auditable){
                    $audit->auditable_id = $auditable->id;
                    $audit->auditable_type = get_class($auditable);
                }
        
                $audit->old_values = json_encode($oldValues);
                $audit->new_values = json_encode($newValues);

                if($tags){
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
    public function getAuditLogs(
        array $filters = [], 
        int $limit = 50, 
        string $orderBy = 'created_at', 
        string $sortOrder = 'desc'
        ): ?object
    {
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

            return $query->orderBy($orderBy, $sortOrder)->paginate($limit);
        } catch (QueryException $e) {
            Log::error("Audit log retrieval failed (database error): " . $e->getMessage());
        } catch (Exception $e) {
            Log::error("Audit log retrieval failed (general error): " . $e->getMessage());
        }
    }
}
