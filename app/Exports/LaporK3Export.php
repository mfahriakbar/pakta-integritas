<?php

namespace App\Exports;

use App\Models\LaporK3;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporK3Export implements FromCollection, WithHeadings
{
    public function collection()
    {
        return LaporK3::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Insiden',
            'Waktu Insiden',
            'Lokasi',
            'Departemen',
            'Jenis Insiden',
            'Penanganan',
            'Insiden Berulang',
            'Nomor Insiden',
            'Penilaian Potensi',
            'Deskripsi',
            'Bukti',
            'Analisis Penyebab',
            'Tindakan Segera',
            'Tindakan Korektif',
            'Pelapor',
            'Korban',
            'Saksi',
            'Supervisor',
            'Tanda Tangan Pelapor',
            'Email Pelapor',
            'Tanda Tangan Supervisor',
            'Dibuat pada',
            'Diperbarui pada',
        ];
    }
}