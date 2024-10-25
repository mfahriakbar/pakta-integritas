<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorStat extends Model
{
    protected $fillable = ['visit_date', 'visit_count'];

    public function scopeToday($query)
    {
        return $query->whereDate('visit_date', today());
    }

    public function scopeYesterday($query)
    {
        return $query->whereDate('visit_date', today()->subDay());
    }
}