<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFileLink extends Model
{
    use HasFactory;

    protected $table = 'project_file_links';

    protected $fillable = [
        'Project_id',
        'file_name',
        'file_link',
        'is_external',
    ];

    public function Project_id(): BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }
}
