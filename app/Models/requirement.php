<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requirement extends Model
{
    use HasFactory;

    protected $table = 'requirements';

    protected $fillable = [
        'business_id',
        'file_name',
        'files',
        'file_type',
        'can_edit',
        'remark',
    ];
}
