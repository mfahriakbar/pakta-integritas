<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    protected $fillable = [
        'activity_name',
        'activity_date',
        'responsible',
        'participant_count',
        'account_code',
        'objective',
        'summary'
    ];

    protected $casts = [
        'activity_date' => 'date'
    ];

    /**
     * Get the participants for the activity.
     */
    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }
}
