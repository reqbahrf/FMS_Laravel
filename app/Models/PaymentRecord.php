<?php

namespace App\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class PaymentRecord extends Model implements AuditableContract
{
    use HasFactory, Auditable;

    protected $table = 'payment_records';

    protected $fillable = [
        'Project_id',
        'transaction_id',
        'amount',
        'payment_status',
        'payment_method'
    ];
    protected $casts = [
        'amount' => 'float',
        'payment_status' => 'string',
        'payment_method' => 'string'
    ];

    public function projectInfo(): BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }
}
