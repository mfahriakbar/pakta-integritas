<?php

namespace App\Exports;

use App\Models\StudiKelayakan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudiKelayakanExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function query()
    {
        $query = StudiKelayakan::query();
        
        if ($this->status) {
            $query->where('status', $this->status);
        }
        
        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pengguna',
            'Alamat',
            'Hubungan',
            'Nama Penghubung',
            'Email',
            'No. Telepon',
            'Nama Perusahaan',
            'Nama Perorangan',
            'Alamat Ada',
            'No. Telp Ada',
            'Email Ada',
            'Pembayaran Langsung',
            'Pembayaran Sebelum',
            'Harga Sesuai',
            'No. Identitas',
            'Nama Pemilik',
            'Kesimpulan',
            'Tim Kepatuhan',
            'Tempat',
            'Tanggal',
            'Nama Pelaksana',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Diupdate'
        ];
    }

    public function map($studiKelayakan): array
    {
        return [
            $studiKelayakan->id,
            $studiKelayakan->nama_pengguna,
            $studiKelayakan->alamat,
            $studiKelayakan->hubungan,
            $studiKelayakan->nama_penghubung,
            $studiKelayakan->email,
            $studiKelayakan->no_telepon,
            $studiKelayakan->nama_perusahaan,
            $studiKelayakan->nama_perorangan,
            $studiKelayakan->alamat_ada,
            $studiKelayakan->no_telp_ada,
            $studiKelayakan->email_ada,
            $studiKelayakan->pembayaran_langsung,
            $studiKelayakan->pembayaran_sebelum,
            $studiKelayakan->harga_sesuai,
            $studiKelayakan->no_identitas,
            $studiKelayakan->nama_pemilik,
            $studiKelayakan->kesimpulan,
            $studiKelayakan->tim_kepatuhan,
            $studiKelayakan->tempat,
            $studiKelayakan->tanggal,
            $studiKelayakan->nama_pelaksana,
            $studiKelayakan->status,
            $studiKelayakan->created_at,
            $studiKelayakan->updated_at
        ];
    }
}