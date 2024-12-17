<?php

namespace App\Events;

use App\Services\ApplicantViewingService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApplicantViewingEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $viewingService;
    public $applicationId;
    public $reviewedBy;
    public $action;

    /**
     * Create a new event instance.
     */
    public function __construct($applicationId, $reviewedBy, $action, ApplicantViewingService $viewingService)
    {
        $this->applicationId = $applicationId;
        $this->reviewedBy = $reviewedBy;
        $this->action = $action;
        $this->viewingService = $viewingService;

        if ($action === 'viewing') {
            $this->viewingService->setViewingState($applicationId, $reviewedBy);
        } else {
            $this->viewingService->removeViewingState($applicationId);
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('viewing-Applicant-events'),
        ];
    }
}
