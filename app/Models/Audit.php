<?php

namespace App\Models;

use OwenIt\Auditing\Models\Audit as BaseAudit;

class Audit extends BaseAudit
{
    public function getCustomProperty($key, $default = '')
    {
        $metaData = $this->metadata;
        return $metaData[$key] ?? $default;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->user) {
                $model->user_type = $model->user->role;
            }
        });
    }
}