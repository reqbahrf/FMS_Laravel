<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectInfo extends Model
{
    use HasFactory;

    protected $table = 'project_info';

    protected $primaryKey = 'Project_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Project_id',
        'business_id',
        'evaluated_by_id',
        'handled_by_id',
        'project_title',
        'fund_amount',
        'actual_amount_to_be_refund',
        'refunded_amount'
    ];

    protected $casts = [
        'Project_id' => 'string',
    ];

    public function businessInfo(): BelongsTo
    {
        return $this->BelongsTo(BusinessInfo::class, 'business_id', 'id');
    }

    public function quarterlyReport(): HasMany
    {
        return $this->HasMany(OngoingQuarterlyReport::class, 'ongoing_project_id', 'Project_id');
    }

    public function previousQuarterlyReport(): HasMany
    {
        return $this->hasMany(OngoingQuarterlyReport::class, 'ongoing_project_id', 'Project_id');
    }
}
