<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benturan extends Model
{
    use HasFactory;

    protected $table = 'benturan';

    protected $fillable = [
        'subject_position',       // Kolom jabatan yang dipilih
        'subject_position_other', // Kolom jabatan "Lainnya"
        'activity_type',
        'situation',
        'conflict_type',
        'handling_strategy',
        'declaration',
        'report_outcome',         // Kolom untuk hasil laporan
        'reportOutcomeOther',     // Kolom untuk hasil laporan "Lainnya"
        'report_month', 
        'report_year',
    ];

    // Cast untuk properti tertentu, jika diperlukan
    protected $casts = [
        'declaration' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Additional methods or relationships can be added here if needed
}
