<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptUpload extends Model
{
    use HasFactory;
    protected $table = 'receipt_upload';

    protected $fillable = [
        'ongoing_project_id',
        'receipt_name',
        'receipt_file',
        'date_uploaded',
        'can_edit',
        'remark',
        'comment'
    ];
}
