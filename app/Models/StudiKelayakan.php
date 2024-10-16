<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudiKelayakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengguna',
        'alamat',
        'hubungan',
        'nama_penghubung',
        'email',
        'no_telepon',
        'nama_perusahaan',
        'nama_perorangan',
        'alamat_ada',
        'no_telp_ada',
        'email_ada',
        'pembayaran_langsung',
        'pembayaran_sebelum',
        'harga_sesuai',
        'no_identitas',
        'nama_pemilik',
        'kesimpulan',
        'tim_kepatuhan',
        'tempat',
        'tanggal',
        'nama_pelaksana',
        'dokumen',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}