<?php

namespace App\Jobs;

use App\Models\OrgUserInfo;
use App\Models\ProjectInfo;
use App\Notifications\ProjectAssignmentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyAssignedStaff implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $staff;
    protected $project;

    /**
     * Create a new job instance.
     *
     * @param OrgUserInfo $staff
     * @param ProjectInfo $project
     * @return void
     */
    public function __construct(OrgUserInfo $staff, ProjectInfo $project)
    {
        $this->staff = $staff;
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->staff->user) {
            $this->staff->user->notify(new ProjectAssignmentNotification($this->project));
        }
    }
}
