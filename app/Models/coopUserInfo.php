<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coopUserInfo extends Model
{
    use HasFactory;
    protected $table = 'coop_users_info';

    protected $fillable = [
        'user_name',
        'f_name',
        'l_name',
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
}