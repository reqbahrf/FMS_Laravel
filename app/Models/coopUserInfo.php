<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class coopUserInfo extends Model
{
    use HasFactory;
    protected $table = 'coop_users_info';

    protected $fillable = [
        'user_name',
        'prefix',
        'f_name',
        'mid_name',
        'l_name',
        'suffix',
        'gender',
        'birth_date',
        'designation',
        'mobile_number',
        'landline',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'user_name');
    }

    public function businessInfo() : HasMany
    {
        return $this->hasMany(businessInfo::class, 'user_info_id', 'id');
    }
}
