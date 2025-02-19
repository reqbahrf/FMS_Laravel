<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationForm extends Model
{
    protected $table = 'application_forms';

    protected $fillable = [
        'business_id',
        'application_id',
        'key',
        'data',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'business_id', 'id');
    }

    public function applicationInfo(): BelongsTo
    {
        return $this->belongsTo(ApplicationInfo::class, 'application_id', 'id');
    }
}
