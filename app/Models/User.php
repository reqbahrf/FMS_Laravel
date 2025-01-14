<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;



class User extends Authenticatable  implements MustVerifyEmail, AuditableContract
{
    use HasFactory, Notifiable, Auditable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'must_change_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'must_change_password' => 'boolean',
        ];
    }

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    public function orgUserInfo(): HasOne
    {
        return $this->hasOne(OrgUserInfo::class, 'user_name', 'user_name');
    }

    public function coopUserInfo(): HasOne
    {
        return $this->hasOne(CoopUserInfo::class, 'user_name', 'user_name');
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return lcfirst($this->role) . '.notifications.' . $this->id;
    }
}
