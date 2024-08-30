<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class businessInfo extends Model
{
    use HasFactory;

    protected $table = 'business_info';

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

    public function userInfo() : HasOne
    {
        return $this->HasOne(coopUserInfo::class, 'user_info_id', 'id');
    }

    public function applicationInfo() : HasMany
    {
        return $this->HasMany(applicationInfo::class, 'business_id', 'id');
    }

    public function projectInfo() : HasMany
    {
        return $this->HasMany(projectInfo::class, 'business_id', 'id');
    }
}
