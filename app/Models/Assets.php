<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'assets';

    public $timestamps = false;

    protected $fillable = [
        'building_value',
        'equipment_value',
        'working_capital'
    ];

    public function businessInfo() : BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'id', 'id');
    }
}
