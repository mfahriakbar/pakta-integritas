<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DumasComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'dumas_id',
        'complaint_channel',
        'complaint_type',
        'handling',
        'remarks'
    ];

    public function dumas()
    {
        return $this->belongsTo(Dumas::class);
    }
}