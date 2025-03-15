<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Events\NewApplicant;
use App\Events\ProjectEvent;

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
        return $this->belongsTo(CoopUserInfo::class, 'user_info_id', 'id');
    }

    public function applicationInfo(): HasMany
    {
        return $this->hasMany(ApplicationInfo::class, 'business_id', 'id');
    }

    public function projectInfo(): HasMany
    {
        return $this->hasMany(ProjectInfo::class, 'business_id', 'id');
    }

    public function assetsInfo(): HasOne
    {
        return $this->hasOne(Assets::class, 'id', 'id');
    }

    public function personnelInfo(): HasOne
    {
        return $this->hasOne(Personnel::class, 'id', 'id');
    }

    public function requirementInfo(): HasMany
    {
        return $this->hasMany(Requirement::class, 'business_id', 'id');
    }

    protected static function booted()
    {
        // Listen to the "created" event
        static::created(function ($business) {
            // Dispatch the NewApplicant event
            event(new ProjectEvent(
                $business->id,
                $business->enterprise_type,
                $business->enterprise_level,
                [
                    'region' => $business->region,
                    'province' => $business->province,
                    'city' => $business->city,
                    'barangay' => $business->barangay,
                ],
                'NEW_APPLICANT'
            ));
        });
    }
}
