<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

use Illuminate\Notifications\Notification;

class ProjectProposalNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    private $ProposalInfo;
    private $Evaluated_By;
    private $ProjectTitle;

    /**
     * Create a new notification instance.
     */
    public function __construct($ProposalInfo)
    {
        $this->ProposalInfo = $ProposalInfo;
        $this->Evaluated_By = $this->ProposalInfo->evaluated_by_id;
        $this->ProjectTitle = $this->ProposalInfo->project_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'New project proposal from ' . $this->Evaluated_By . ' with title ' . $this->ProjectTitle,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'New project proposal from ' . $this->Evaluated_By . ' with title ' . $this->ProjectTitle,
            'evaluated_by' => $this->Evaluated_By,
            'project_title' => $this->ProjectTitle,
            'proposal_info' => [
                'id' => $this->ProposalInfo->id,
                'project_id' => $this->ProposalInfo->project_id,
            ],
        ]);
    }

    public function broadcastOn()
{
    return new PrivateChannel('admin-notifications');
}
}
