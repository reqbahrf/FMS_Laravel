<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BusinessInfo extends Model
{
    use HasFactory;

    protected $table = 'business_info';

    public $timestamps = false;

    protected $fillable = [
        'user_info_id',
        'firm_name',
        'enterprise_type',
        'enterprise_level',
        'zip_code',
        'landMark',
        'barangay',
        'city',
        'province',
        'region',
        'Export_Mkt_Outlet',
        'Local_Mkt_Outlet',
    ];

    public function userInfo(): BelongsTo
    {
        return $this->BelongsTo(CoopUserInfo::class, 'user_info_id', 'id');
    }

    public function ApplicationInfo(): HasMany
    {
        return $this->HasMany(ApplicationInfo::class, 'business_id', 'id');
    }

    public function ProjectInfo(): HasMany
    {
        return $this->HasMany(ProjectInfo::class, 'business_id', 'id');
    }
}
