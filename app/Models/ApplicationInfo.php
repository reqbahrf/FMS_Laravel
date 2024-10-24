<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewApplicant;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ApplicationInfo extends Model
{
    use HasFactory;

    protected $table = 'application_info';

    protected $fillable = [
        'Project_id',
        'business_id',
        'date_applied',
        'application_status',
        'Evaluation_date',
    ];

    public function businessInfo()
    {
        return $this->belongsTo(BusinessInfo::class, 'business_id', 'id');
    }

    public function projectInfo()
    {
        return $this->belongsTo(ProjectInfo::class, 'Project_id', 'Project_id');
    }

    public function projectProposalInfo() : HasOne
    {
        return $this->hasOne(ProjectProposal::class, 'application_id', 'id');
    }
}
