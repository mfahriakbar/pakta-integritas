<?php

namespace App\Exports;

use App\Models\PenyediaJasa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenyediaJasaExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    protected $status;

    // Constructor to handle the status parameter
    public function __construct($status = null)
    {
        $this->status = $status;
    }

    // Query the data based on status
    public function query()
    {
        $query = PenyediaJasa::query();

        if ($this->status) {
            // Filter by status if provided
            $query->where('kesimpulan', $this->status);
        }

        return $query;
    }

    // Define the column headings for the exported file
    public function headings(): array
    {
        return [
            'ID',
            'Nama Rekan',
            'Alamat',
            'Hubungan',
            'Pegawai Penghubung',
            'No Telepon',
            'Legalitas',
            'Kualifikasi',
            'Sumber Daya',
            'Anti Penyuapan',
            'Kasus Penyuapan',
            'Mekanisme Transaksi',
            'NIB',
            'Kesimpulan',
            'Tim Kepatuhan',
            'Tempat',
            'Tanggal',
            'Dibuat Pada',
            'Diperbarui Pada',
        ];
    }
}
