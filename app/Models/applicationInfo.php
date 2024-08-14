<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicationInfo extends Model
{
    use HasFactory;

    protected $table = 'application_info';

    protected $fillable = [
        'business_id',
        'date_applied',
        'application_status',
        'Evaluation_date',
    ];

    public function businessInfo()
    {
        return $this->belongsTo(businessInfo::class, 'business_id', 'id');
    }
}
