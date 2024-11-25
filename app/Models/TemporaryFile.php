<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemporaryFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'owner_id',
        'unique_id',
        'file_name',
        'file_path',
        'mime_type',
        'file_size'
    ];
}
