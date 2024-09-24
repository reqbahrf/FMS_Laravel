<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChartCache extends Model
{
    use HasFactory;

    protected $table = 'charts_cache_year_of';

    public $timestamps = false;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'year_of',
        'mount_project_categories',
        'project_local_categories',
        'staff_handled_projects_categories',
    ];

    protected $casts = [
        'year_of' => 'date:Y',
        'mount_project_categories' => 'array',
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
