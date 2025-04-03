<?php

namespace App\Models;

use App\Events\NewApplicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationInfo extends Model
{
    use HasFactory;

    protected $table = 'application_info';

    protected $fillable = [
        'Project_id',
        'business_id',
        'date_applied',
        'requested_fund_amount',
        'application_status',
        'Evaluation_date',
        'is_assisted',
        'assisted_by',
    ];

    protected $casts = [
        'is_assisted' => 'boolean',
    ];

    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'business_id', 'id');
    }

    public function projectInfo(): BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }

    public function addedByStaff(): BelongsTo
    {
        return $this->belongsTo(OrgUserInfo::class, 'added_by', 'id');
    }
}
