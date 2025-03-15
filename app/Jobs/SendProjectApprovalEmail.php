<?php

namespace App\Jobs;

use App\Mail\ProjectApprovalMail;
use App\Models\ProjectInfo;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendProjectApprovalEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $project;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param ProjectInfo $project
     * @return void
     */
    public function __construct(User $user, ProjectInfo $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->user->email) {
            Mail::to($this->user->email)->send(new ProjectApprovalMail($this->project));
        }
    }
}
