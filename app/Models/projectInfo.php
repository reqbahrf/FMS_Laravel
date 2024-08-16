<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectInfo extends Model
{
    use HasFactory;

    protected $table = 'project_info';

    protected $fillable = [
        'Project_id',
        'business_id',
        'evaluated_by_id',
        'handled_by_id',
        'project_title',
        'fund_amount',
        'refund_amout'
    ];
}
