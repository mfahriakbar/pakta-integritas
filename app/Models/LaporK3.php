<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporK3 extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'lapor_k3s';

    protected $fillable = [
        'incident_date',
        'incident_time',
        'location',
        'department',
        'incident_type',
        'treatment',
        'repeated_incident',
        'incident_number',
        'potential_assessment',
        'description',
        'evidence',
        'cause_analysis',
        'immediate_actions',
        'corrective_actions',
        'reporter',
        'victims',
        'witnesses',
        'supervisor',
        'reporterSignature',
        'reporter_email',
        'supervisorSignature',
    ];

}