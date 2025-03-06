<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Actions\GenerateQuarterlyReportUrlAction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $appends = [
        'report_file_state',
        'url',
        'coop_response',
        'remaining_days'
    ];

    public function projectInfo(): BelongsTo
    {
        return $this->BelongsTo(ProjectInfo::class, 'ongoing_project_id', 'Project_id');
    }

    public function getReportFileStateAttribute(): string
    {
        return !empty($this->report_file) ? 'true' : 'false';
    }

    public function getUrlAttribute(): string
    {
        return GenerateQuarterlyReportUrlAction::execute($this);
    }

    public function getCoopResponseAttribute(): string
    {
        return $this->report_file ? 'Submitted' : 'Not Submitted';
    }

    public function getRemainingDaysAttribute(): string
    {
        if (!$this->open_until) {
            return 'Not set';
        }

        return round(now()->diffInDays(Carbon::parse($this->open_until)));
    }
}
