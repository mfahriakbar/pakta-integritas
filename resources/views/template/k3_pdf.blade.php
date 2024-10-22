<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Insiden dan Kecelakaan K3</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            max-width: 100%;
            height: auto;
        }
        .title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .content {
            margin: 0 2cm;
        }
        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        
        /* Signature Styling - Updated */
        .signature {
            margin-top: 30px;
            position: absolute;
            bottom: 30px; /* Menempatkan signature di bagian bawah halaman */
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding-left: 2cm;
            padding-right: 2cm;
        }
        .signature-block {
            display: inline-block;
            width: 45%; /* Untuk menjaga supaya kedua blok signature berdampingan */
            vertical-align: top;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid black;
            margin-top: 10px;
            width: 50%; /* Optional: Line signature lebih tipis */
            margin-left: auto;
            margin-right: auto;
        }
        .qr-code {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        .evidence img {
            max-width: 100%;
            height: auto;
        }
    </style>    
</head>
<body>
    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <div class="title">
        <h3>{{ $judul }}</h3>
    </div>

    <!-- Halaman pertama (hingga Analisis Penyebab) -->
    <div class="content">
        <div class="section-title">A. Informasi Umum</div>
        <table>
            <tr>
                <td>Tanggal Kejadian</td>
                <td>: {{ \Carbon\Carbon::parse($laporK3->incident_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Waktu Kejadian</td>
                <td>: {{ \Carbon\Carbon::parse($laporK3->incident_time)->format('H:i') }}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>: {{ $laporK3->location }}</td>
            </tr>
            <tr>
                <td>Bagian</td>
                <td>: {{ $laporK3->department }}</td>
            </tr>
        </table>

        <div class="section-title">B. Detail Kejadian</div>
        <table>
            <tr>
                <td>Jenis Insiden</td>
                <td>: {{ $laporK3->incident_type }}</td>
            </tr>
            <tr>
                <td>Penanganan</td>
                <td>: {{ $laporK3->treatment }}</td>
            </tr>
            <tr>
                <td>Kejadian Berulang</td>
                <td>: {{ $laporK3->repeated_incident }}</td>
            </tr>
            <tr>
                <td>Jumlah Kejadian (jika berulang)</td>
                <td>: {{ $laporK3->incident_number ?: '-' }}</td>
            </tr>
            <tr>
                <td>Penilaian Potensi</td>
                <td>: {{ $laporK3->potential_assessment }}</td>
            </tr>
        </table>

        <div class="section-title">C. Deskripsi Kejadian</div>
        <p>{{ $laporK3->description }}</p>

        <div class="section-title">D. Analisis Penyebab</div>
        <p>{{ $laporK3->cause_analysis }}</p>
    </div>

    <!-- Memaksa pindah ke halaman kedua -->
    <div class="page-break"></div>

    <!-- Halaman kedua (Tindakan Segera, Perbaikan, dan Tanda Tangan) -->
    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <div class="title">
        <h3>{{ $judul }}</h3>
    </div>

    <div class="content">
        <div class="section-title">E. Tindakan Segera</div>
        <p>{{ $laporK3->immediate_actions }}</p>

        <div class="section-title">F. Tindakan Perbaikan</div>
        <p>{{ $laporK3->corrective_actions }}</p>

        <div class="section-title">G. Pihak Terkait</div>
        <table>
            <tr>
                <td>Pelapor</td>
                <td>: {{ $laporK3->reporter }}</td>
            </tr>
            <tr>
                <td>Korban</td>
                <td>: {{ $laporK3->victims }}</td>
            </tr>
            <tr>
                <td>Saksi</td>
                <td>: {{ $laporK3->witnesses }}</td>
            </tr>
            <tr>
                <td>Atasan</td>
                <td>: {{ $laporK3->supervisor }}</td>
            </tr>
        </table>
    </div>

    <!-- Signature di bagian bawah halaman -->
    <div class="signature">
        <div class="signature-block">
            <p>Pelapor:</p>
            <img class="qr-code" src="data:image/svg+xml;base64,{{ $reporterQrCode }}" alt="QR Code Pelapor">
            <div class="signature-line"></div>
            <p>{{ $laporK3->reporter }}</p>
        </div>
        <div class="signature-block">
            <p>Atasan:</p>
            <img class="qr-code" src="data:image/svg+xml;base64,{{ $supervisorQrCode }}" alt="QR Code Supervisor">
            <div class="signature-line"></div>
            <p>{{ $laporK3->supervisor }}</p>
        </div>
    </div>

    <!-- Memaksa pindah ke halaman ketiga (Bukti Kejadian) -->
    @if($laporK3->evidence)
    <div class="page-break"></div>

    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <div class="title">
        <h3>{{ $judul }}</h3>
    </div>

    <div class="content evidence">
        <div class="section-title">H. Bukti Kejadian</div>
        <img src="{{ asset('storage/' . $laporK3->evidence) }}" alt="Bukti Kejadian">
    </div>
    @endif
</body>
</html>
