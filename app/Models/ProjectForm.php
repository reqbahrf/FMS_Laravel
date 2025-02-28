<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectForm extends Model
{
    protected $table = "project_forms";
    protected $fillable = [
        'project_info_id',
        'application_form_id',
        'business_info_id',
        'key',
        'data',
        'status'
    ];

    public function projectInfo(): BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'project_info_id', 'Project_id');
    }

    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'business_info_id', 'id');
    }

    public function applicationInfo(): BelongsTo
    {
        return $this->belongsTo(ApplicationInfo::class, 'application_form_id', 'id');
    }
}
