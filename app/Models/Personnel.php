<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnel';

    public $timestamps = false;

    protected $fillable = [
        'male_direct_re',
        'female_direct_re',
        'male_direct_part',
        'female_direct_part',
        'male_indirect_re',
        'female_indirect_re',
        'male_indirect_part',
        'female_indirect_part',
    ];

    public function BusinessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'id', 'id');
    }
}
