<?php

namespace App\Models;

use Carbon\Carbon;
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
        'reference_number',
        'amount',
        'payment_status',
        'payment_method',
        'due_date',
        'note',
        'date_completed'
    ];
    protected $casts = [
        'amount' => 'float',
        'payment_status' => 'string',
        'payment_method' => 'string',
        'due_date' => 'date',
        'date_completed' => 'date',
    ];

    public function projectInfo(): BelongsTo
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Calculate quarter before saving the model
        static::saving(function ($paymentRecord) {
            if ($paymentRecord->due_date) {
                $dueDate = Carbon::parse($paymentRecord->due_date);
                $paymentRecord->quarter = 'Q' . ceil($dueDate->month / 3) . ' ' . $dueDate->year;
            }
        });
    }
}
