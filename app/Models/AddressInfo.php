<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddressInfo extends Model
{
    protected $table = 'users_address_info';

    protected $fillable = [
        'user_info_id',
        'zip_code',
        'landMark',
        'barangay',
        'city',
        'province',
        'region',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_info_id', 'id');
    }
}
