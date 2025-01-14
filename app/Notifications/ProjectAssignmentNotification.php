<?php

namespace App\Notifications;

use App\Actions\ParseBroadcastNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\ProjectInfo;

class ProjectAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $project;

    public function __construct(ProjectInfo $project)
    {
        $this->project = $project;
    }

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => 'Project Assignment',
            'message' => 'You have been assigned to handle project: ' . $this->project->project_title,
            'project_id' => $this->project->Project_id,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        $parsedNotification = ParseBroadcastNotification::execute($notifiable, self::class);
        return new BroadcastMessage($parsedNotification);
    }
}
