<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgUserInfo extends Model
{
    use HasFactory;
    // Specify the table name if it's not the plural form of the model name
    protected $table = 'org_users_info';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Enable auto-incrementing
    public $incrementing = true;

    // Specify the connection if it's not the default
    // protected $connection = 'connection-name';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_name',
        'full_name',
        'birthdate',
        'access_to',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'birthdate' => 'date',
    ];

    // Define the relationship with the User model, assuming it exists
    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'user_name');
    }
}