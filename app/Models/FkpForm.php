<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FkpForm extends Model
{
    use HasFactory;

    protected $table = 'fkp_forms';
    
    protected $fillable = [
        'message_type',
        'employee_name',
        'employee_id',
        'position',
        'department',
        'company',
        'subject',
        'problem_description',
        'proposed_solution',
        'reporter_email',
        'notes',
        'prepared_by',
        'executor',
        'secretary_approval',
        'chairman_approval'
    ];
}