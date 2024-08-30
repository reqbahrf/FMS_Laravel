<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class projectInfo extends Model
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
        'fund_amount',
        'refund_amout'
    ];

    protected $casts = [
        'Project_id' => 'string',
    ];

    public function businessInfo() : BelongsTo
    {
        return $this->BelongsTo(businessInfo::class, 'business_id', 'id');
    }
}
