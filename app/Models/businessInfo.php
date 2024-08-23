<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function businessInfo()
    {
        return $this->hasMany(businessInfo::class, 'user_info_id', 'id');
    }

    public function applicationInfo()
    {
        return $this->hasMany(applicationInfo::class, 'business_id', 'id');
    }

    public function projectInfo()
    {
        return $this->hasMany(projectInfo::class, 'business_id', 'id');
    }
}
