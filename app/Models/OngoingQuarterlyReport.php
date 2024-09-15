<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OngoingQuarterlyReport extends Model
{
    use HasFactory;

    protected $table = 'ongoing_project_quarterly_report';

    protected $fillable =
    [
        'ongoing_project_id',
        'quarter',
        'report_file',
        'open_until',
        'report_status',
    ];

    protected $casts = [
        'report_file' => 'array'
    ];

    public function projectInfo() : BelongsTo
    {
        return $this->BelongsTo(projectInfo::class, 'ongoing_project_id', 'Project_id');
    }
}
