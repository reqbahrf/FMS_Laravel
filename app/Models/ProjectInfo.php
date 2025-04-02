<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


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
        'project_ledger_link',
        'fund_amount',
        'fee_applied',
        'actual_amount_to_be_refund',
        'refunded_amount',
        'project_duration',
        'fund_released_date'
    ];

    protected $casts = [
        'Project_id' => 'string',
        'fee_applied' => 'float',
        'actual_amount_to_be_refund' => 'float',
        'refunded_amount' => 'float'
    ];

    public function paymentInfo(): HasMany
    {
        return $this->hasMany(PaymentRecord::class, 'Project_id', 'Project_id');
    }

    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'business_id', 'id');
    }

    public function currentQuarterlyReport(?string $quarter = null): HasOne
    {
        $relation = $this->hasOne(OngoingQuarterlyReport::class, 'ongoing_project_id', 'Project_id');

        if ($quarter) {
            $relation->where('quarter', $quarter);
        }

        return $relation;
    }

    public function previousQuarterlyReport(?string $quarter = null): HasOne
    {
        $relation = $this->hasOne(OngoingQuarterlyReport::class, 'ongoing_project_id', 'Project_id');

        if ($quarter) {
            $relation->where('quarter', $quarter);
        }

        return $relation;
    }
}
