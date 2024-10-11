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

    protected $appends = ['report_file_state'];

    public function projectInfo(): BelongsTo
    {
        return $this->BelongsTo(ProjectInfo::class, 'ongoing_project_id', 'Project_id');
    }

    public function getReportFileStateAttribute(): string
    {
        return !empty($this->report_file) ? 'true' : 'false';
    }
}
