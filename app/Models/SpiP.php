<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpiP extends Model
{
    use HasFactory;

    protected $table = 'spi_p';

    protected $fillable = [
        'year',
        'document_type',
        'folder_path',
        'file_path',
        'additional_info',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}