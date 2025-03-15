<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoopUserInfo extends Model
{
    use HasFactory;
    protected $table = 'coop_users_info';

    public $timestamps = false;

    protected $fillable = [
        'user_name',
        'prefix',
        'f_name',
        'mid_name',
        'l_name',
        'suffix',
        'sex',
        'birth_date',
        'designation',
        'mobile_number',
        'landline',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_name', 'user_name');
    }

    public function businessInfo(): HasMany
    {
        return $this->hasMany(BusinessInfo::class, 'user_info_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return ($this->prefix ? $this->prefix . ' ' : '')
            . ' ' . $this->f_name . ' ' .
            ($this->mid_name ? substr($this->mid_name, 0, 1) . '.' : '')
            . ' ' . $this->l_name . ' ' .
            ($this->suffix ? $this->suffix : '');
    }
}
