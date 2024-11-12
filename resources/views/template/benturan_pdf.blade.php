<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Benturan Kepentingan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            margin-top: 150px;
            max-width: 30%;
            height: auto;
            margin-bottom: 20px;
        }
        .title-depan {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 30px;
        }
        .title-depan h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        .container {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header-img {
            width: 100%;
            height: auto;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            margin-right: 50px;
        }

        .signature {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 50px;
        }

        .date {
            margin-top: 20px;
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
        }

        .periode {
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .bawah {
            text-align: left;
            margin: 30px 40px 40px 40px;
            position: absolute;
            bottom: 30px; /* Menempatkan signature di bagian bawah halaman */
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding-left: 2cm;
            padding-right: 2cm;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- Halaman Depan -->
        <div class="title-depan">
            <h1>LAPORAN MONITORING EVALUASI</h1>
            <h1>PENGADUAN MASYARAKAT</h1>
            <h1>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h1>
            <h1>TAHUN 2024</h1>
        </div>
    
        <div class="header">
            <img src="{{ $base64Picture1 }}" alt="Kop Surat">
        </div>
    
        <div class="bawah">
            <h4 style="margin-left: 5%">BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h4>
            <h4 style="margin-left: 32%">2024</h4>
        </div>

    <!-- Memaksa pindah ke halaman kedua -->
    <div class="page-break"></div>

    <img src="{{ $base64KopSurat }}" class="header-img" alt="Kop Surat">
    <div class="container">
        <div class="title">
            IDENTIFIKASI BENTURAN KEPENTINGAN
            <h5>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK</h5>
            <H6>Berdasarkan Permentan NO.7 Tahun 2022</H6>
        </div>
        
        <!-- Menambahkan Periode Bulan dan Tahun -->
        <div class="periode">
            Periode: {{ $periodText }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan/Posisi</th>
                    <th>Jenis Kegiatan</th>
                    <th>Situasi Benturan</th>
                    <th>Jenis Benturan</th>
                    <th>Strategi Penanganan</th>
                    <th>Hasil Laporan</th> <!-- Menambahkan kolom Hasil Laporan -->
                </tr>
            </thead>
            <tbody>
                @if($benturans->count() > 0)
                    @foreach($benturans as $index => $benturan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="max-width: 100px;">{{ $benturan->subject_position }}</td>
                            <td style="max-width: 60px;">{{ $benturan->activity_type }}</td>
                            <td style="max-width: 150px;">{{ $benturan->situation }}</td>
                            <td style="max-width: 60px;">{{ $benturan->conflict_type }}</td>
                            <td style="max-width: 100px;">{{ $benturan->handling_strategy }}</td>
                            <td style="max-width: 100px;">
                                @if($benturan->report_outcome === 'Lainnya' && $benturan->reportOutcomeOther)
                                    {{ $benturan->reportOutcomeOther }}
                                @else
                                    {{ $benturan->report_outcome }}
                                @endif
                            </td> <!-- Menampilkan hasil laporan -->
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="no-data">Tidak ada data benturan kepentingan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    
        <div class="footer">
            <div class="date">
                Bogor, {{ now()->format('d F Y') }}
            </div>
            
            <div class="signature">
                <p>Kepala Balai</p>
                <br><br><br>
                <p>(_________________________)</p>
                <p>NIP.198103272006041001 </p>
            </div>
        </div>
    </div>
</body>
</html>
