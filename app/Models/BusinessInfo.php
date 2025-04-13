<?php

namespace App\Models;

use App\Events\NewApplicant;
use App\Events\ProjectEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class BusinessInfo extends Model
{
    use HasFactory;

    protected $table = 'business_info';

    public $timestamps = false;

    protected $fillable = [
        'user_info_id',
        'firm_name',
        'enterprise_background',
        'enterprise_type',
        'enterprise_level',
        'permit_type',
        'business_permit_no',
        'permit_year_registered',
        'registration_type',
        'enterprise_registration_no',
        'enterprise_year_registered',
        'office_telephone',
        'office_fax_no',
        'office_email',
        'factory_telephone',
        'factory_fax_no',
        'factory_email',
        'sectors',
        'Export_Mkt_Outlet',
        'Local_Mkt_Outlet',
    ];

    protected $casts = [
        'sectors' => 'array',
        'Export_Mkt_Outlet' => 'array',
        'Local_Mkt_Outlet' => 'array',
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

    public function addressInfo(): HasOne
    {
        return $this->hasOne(BusinessAddressInfo::class, 'business_info_id', 'id');
    }

    /**
     * The "booted" method of the model.
     * Registers a created model event with the dispatcher.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($business) {
            try {
                $business->load(['userInfo.user.addressInfo']);

                $addressData = [
                    'applicant_region' => null,
                    'applicant_province' => null,
                    'applicant_city' => null,
                    'applicant_barangay' => null,
                ];

                if (
                    $business->userInfo &&
                    $business->userInfo->user &&
                    $business->userInfo->user->addressInfo
                ) {

                    $addressInfo = $business->userInfo->user->addressInfo;

                    $addressData = [
                        'applicant_region' => $addressInfo->region,
                        'applicant_province' => $addressInfo->province,
                        'applicant_city' => $addressInfo->city,
                        'applicant_barangay' => $addressInfo->barangay,
                    ];
                }

                // Dispatch the NewApplicant event
                event(new ProjectEvent(
                    $business->id,
                    $business->enterprise_type,
                    $business->enterprise_level,
                    $addressData,
                    'NEW_APPLICANT'
                ));
            } catch (\Exception $e) {
                // Log the error but don't halt execution
                Log::error('Error in BusinessInfo created event: ' . $e->getMessage());

                // Still dispatch event but with null address data
                event(new ProjectEvent(
                    $business->id,
                    $business->enterprise_type,
                    $business->enterprise_level,
                    [
                        'applicant_region' => null,
                        'applicant_province' => null,
                        'applicant_city' => null,
                        'applicant_barangay' => null,
                    ],
                    'NEW_APPLICANT'
                ));
            }
        });
    }
}
