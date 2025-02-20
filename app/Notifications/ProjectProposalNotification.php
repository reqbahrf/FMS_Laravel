<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\ProjectInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Actions\ParseBroadcastNotification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ProjectProposalNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    private array $ProposalInfo;
    private int $Evaluated_By;
    private string $ProjectTitle;
    private string $Project_id;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $ProposalInfo, int $Evaluated_by)
    {
        $this->ProposalInfo = $ProposalInfo;
        $this->Evaluated_By = $Evaluated_by;
        $this->ProjectTitle = $ProposalInfo['project_title'] ?? $ProposalInfo['Project_title'] ?? '';
        $this->Project_id = $ProposalInfo['Project_id'] ?? $ProposalInfo['project_id'] ?? '';
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
            'title' => 'New project proposal',
            'message' => ' Project proposal from ' . $this->Evaluated_By . ' Entitled ' . ' <strong> ' . '"' . $this->ProjectTitle . '"' . ' </strong>' . ' with Project id ' . ' <strong> ' . $this->Project_id . ' </strong>' . 'has been submitted.',
        ];
    }

    public function toBroadcast($notifiable)
    {
        $parsedNotification = ParseBroadcastNotification::execute($notifiable, self::class);
        return new BroadcastMessage($parsedNotification);
    }
}
