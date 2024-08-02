<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OngoingQuarterlyReport extends Model
{
    use HasFactory;

    protected $table = 'ongoing_project_quarterly_report';

    protected $fillable =
    [
        'ongoing_project_id',
        'quarter',
        'report_file',
        'can_edit'
    ];
}
