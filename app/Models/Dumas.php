<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dumas extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'created_by'
    ];

    public function complaints()
    {
        return $this->hasMany(DumasComplaint::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}