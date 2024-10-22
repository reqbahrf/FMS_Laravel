<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentRecord extends Model
{
    use HasFactory;

    protected $table = 'payment_records';

    protected $fillable = [
        'Project_id',
        'transaction_id',
        'amount',
        'payment_status',
        'payment_method'
    ];
    public function projectInfo(): BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }
}
