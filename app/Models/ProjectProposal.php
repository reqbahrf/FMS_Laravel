<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectProposal extends Model
{
    use HasFactory;

    protected $table = 'project_proposal';

    protected $fillable = [
        'Project_id',
        'application_id',
        'data',
        'submission_status'
    ];

    protected $casts = [
        'data' => 'array',
        'submission_status' => 'string'
    ];


    public function projectInfo() : BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }

    public function applicationInfo() : BelongsTo
    {
        return $this->belongsTo(ApplicationInfo::class, 'application_id', 'id');

    }


}
