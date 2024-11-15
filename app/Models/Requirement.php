<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Requirement extends Model
{
    use HasFactory;

    protected $table = 'requirements';

    protected $fillable = [
        'business_id',
        'application_id',
        'file_name',
        'file_link',
        'file_type',
        'can_edit',
        'remarks',
        'remark_comments',
    ];

    public function business() : BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'business_id', 'id');
    }

    public function applicationInfo() : BelongsTo
    {
        return $this->belongsTo(ApplicationInfo::class, 'application_id', 'id');
    }
}
