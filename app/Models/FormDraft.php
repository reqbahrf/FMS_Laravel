<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormDraft extends Model
{
    protected $table = 'form_draft';

    protected $fillable = [
        'owner_id',
        'form_type',
        'form_data',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];

    public function formOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
