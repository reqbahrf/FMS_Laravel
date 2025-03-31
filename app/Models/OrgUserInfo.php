<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class OrgUserInfo extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'org_users_info';


    protected $primaryKey = 'id';


    public $incrementing = true;


    protected $fillable = [
        'user_name',
        'profile_pic',
        'prefix',
        'f_name',
        'mid_name',
        'l_name',
        'suffix',
        'sex',
        'birthdate',
        'access_to',
    ];


    protected $casts = [
        'birthdate' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_name', 'user_name');
    }

    public function handledProjects(): HasMany
    {
        return $this->hasMany(ProjectInfo::class, 'handled_by_id');
    }

    public function isHandlingThisProject(string $projectId): bool
    {
        return $this->handledProjects()->where('Project_id', $projectId)->exists();
    }

    public function evaluatedProjects(): HasMany
    {
        return $this->hasMany(ProjectInfo::class, 'evaluated_by_id');
    }

    public function getFullNameAttribute()
    {
        return
            $this->f_name . ' ' .
            ($this->mid_name ? substr($this->mid_name, 0, 1) . '.' : '')
            . ' ' . $this->l_name . ' ' .
            ($this->suffix ? $this->suffix : '');
    }
}
