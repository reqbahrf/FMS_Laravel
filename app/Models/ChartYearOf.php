<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChartYearOf extends Model
{
    use HasFactory;

    protected $table = 'charts_year_of';

    public $timestamps = false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'year_of',
        'monthly_project_categories',
        'project_local_categories',
        'staff_handled_projects_categories',
    ];

    protected $casts = [
        'year_of' => 'string',
        'monthly_project_categories' => 'array',
        'project_local_categories' => 'array',
        'staff_handled_projects_categories' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
