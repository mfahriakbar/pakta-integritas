<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika berbeda dengan nama model (Laravel menggunakan plural secara default)
    protected $table = 'visitor_logs';

    // Menentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = ['ip_address', 'visit_date'];

    // Jika Anda menggunakan timestamps (created_at dan updated_at), 
    // tidak perlu mendeklarasikan property ini, karena Laravel sudah mengaktifkannya secara default.
    public $timestamps = true;
}
