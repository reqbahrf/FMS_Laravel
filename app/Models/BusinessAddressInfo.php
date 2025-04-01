<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessAddressInfo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_address_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_info_id',
        'office_landmark',
        'office_barangay',
        'office_city',
        'office_province',
        'office_region',
        'office_zip_code',
        'factory_landmark',
        'factory_barangay',
        'factory_city',
        'factory_province',
        'factory_region',
        'factory_zip_code',
    ];

    /**
     * Get the business info that owns the business address info.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class, 'business_info_id', 'id');
    }
}
