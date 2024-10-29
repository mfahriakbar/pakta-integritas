<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    protected $fillable = [
        'activity_id',
        'name',
        'position',
        'phone_number'
    ];

    /**
     * Get the activity that owns the participant.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}