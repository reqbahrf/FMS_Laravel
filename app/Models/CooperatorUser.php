<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperatorUser extends Model
{
    use HasFactory;
    protected $table = 'cooperator_users';
    public $timestamps = false;
}
