<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rekaman Pelaksanaan Kegiatan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
            max-width: 210mm;
            margin: 0 auto;
        }

        .cover-page {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 20px;
        }

        .cover-title {
            font-size: 24pt;
            font-weight: bold;
            margin: 40px 0;
        }

        .activity-name {
            font-size: 18pt;
            margin: 20px 0;
            text-align: center;
            border-bottom: 1px dotted #000;
        }

        .cover-note {
            font-style: italic;
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #000;
        }

        .responsible-person {
            text-align: center;
            margin: 100px 0;
        }

        .institution-name {
            font-weight: bold;
            font-size: 16pt;
            margin-top: 250px;
        }

        .record-number {
            text-align: right;
            margin-top: 30px;
            position: absolute;
            bottom: 30px; /* Menempatkan signature di bagian bawah halaman */
            width: 80%;
            display: flex;
            justify-content: space-between;
            padding-left: 2cm;
            padding-right: 2cm;
        }

        .section-title {
            font-weight: bold;
            margin: 30px 0 20px 0;
        }

        .activity-details {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .activity-details td {
            padding: 8px;
            border: 1px solid #000;
        }

        .activity-details td:first-child {
            width: 40px;
        }

        .activity-details td:nth-child(2) {
            width: 200px;
        }

        .description-box {
            border: 1px solid #000;
            padding: 15px;
            margin: 20px 0;
            min-height: 200px;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .attendance-table th, .attendance-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .page-header {
            text-align: right;
            font-style: italic;
            margin-bottom: 20px;
        }

        .page-break {
            page-break-before: always;
        }

        .qr-code {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- Cover Page -->
    <div class="cover-page">
        <div class="kop-surat">
            <img src="{{ $base64 }}" alt="Letterhead">
        </div>
        
        <div>
            <div class="cover-title">FORM REKAMAN<br>PELAKSANAAN KEGIATAN</div>
            <div class="activity-name">{{ $activity->activity_name }}</div>
            <div class="cover-note">
                (Form ini digunakan sebagai catatan pelaksanaan kegiatan untuk diproses sebagai laporan pertanggung jawaban kegiatan dan keuangan)
            </div>
        </div>

        <div>
            <div class="responsible-person">
                <p>PENANGGUNG JAWAB</p>
                <p>NAMA: {{ $activity->responsible }}</p>
            </div>
            <div class="institution-name">BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</div>
            <div class="record-number">Nomor Kontrol Rekaman: _________________</div>
        </div>
    </div>

    <!-- Memaksa pindah ke halaman kedua -->
    <div class="page-break"></div>

    <!-- Activity Details Page -->
    <div class="container">
        <div class="section-title">I. URAIAN KEGIATAN</div>
        <table class="activity-details">
            <tr>
                <td>1</td>
                <td>Nama Kegiatan</td>
                <td>{{ $activity->activity_name }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Hari dan Tanggal</td>
                <td>{{ \Carbon\Carbon::parse($activity->activity_date)->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Penanggung Jawab Kegiatan</td>
                <td>{{ $activity->responsible }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Jumlah Peserta/Undangan</td>
                <td>{{ $activity->participant_count }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Kode Akun Kegiatan</td>
                <td>{{ $activity->account_code }}</td>
            </tr>
        </table>

        <div class="section-title">Term of Reference</div>
        <div class="description-box">{{ $activity->objective }}</div>

        <div class="section-title">Ringkasan Hasil Pelaksanaan Kegiatan</div>
        <div class="description-box">{{ $activity->summary }}</div>

        <!-- Memaksa pindah ke halaman kedua -->
        <div class="page-break"></div>

        <!-- Attendance List Page -->
        <div class="section-title">II. DAFTAR HADIR PESERTA</div>
        <div class="page-header">Tanggal: {{ \Carbon\Carbon::parse($activity->activity_date)->format('d/m/Y') }}</div>
        
        <table class="attendance-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PESERTA</th>
                    <th>JABATAN/ASAL INSTANSI</th>
                    <th>TANDA TANGAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participantsWithQrCodes as $key => $participant)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->position }}</td>
                    <td>
                        <img class="qr-code" src="data:image/svg+xml;base64,{{ $participant->qr_code }}" alt="QR Code">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>