<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyediaJasa extends Model
{
    use HasFactory;

    protected $table = 'penyedia_jasas'; // Define the table name

    // Fillable fields
    protected $fillable = [
        'nama_rekan',
        'alamat',
        'hubungan',
        'pegawai_penghubung',
        'no_telepon',
        'legalitas',
        'kualifikasi',
        'sumber_daya',
        'anti_penyuapan',
        'kasus_penyuapan',
        'mekanisme_transaksi',
        'nib',
        'kesimpulan',
        'tim_kepatuhan',
        'tempat',
        'tanggal',
    ];
}
