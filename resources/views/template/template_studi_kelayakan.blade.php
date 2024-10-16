<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Studi Kelayakan</title>
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

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        h1 {
            font-size: 16pt;
            text-align: center;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .content {
            margin: 0 2cm;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        .signature {
            margin: 20px 70px 0 0;
            text-align: right;
            font-size: 12pt;
        }

        .signature-barcode{
            padding: 5px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $base64 }}" alt="Header">
    </div>

    <h1>Laporan Studi Kelayakan</h1>

    <div class="content">
        <div class="section">
            <div class="section-title">Informasi Umum</div>
            <table>
                <tr>
                    <td>Nama Perusahaan/Instansi/ Perorangan
                        Pengguna Jasa</td>
                    <td>: {{ $data->nama_pengguna }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data->alamat }}</td>
                </tr>
                <tr>
                    <td>Hubungan</td>
                    <td>: {{ $data->hubungan }}</td>
                </tr>
                <tr>
                    <td>Nama Penghubung</td>
                    <td>: {{ $data->nama_penghubung }}</td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>: {{ $data->no_telepon }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Hasil Pemeriksaan</div>
            <table>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>: {{ $data->nama_perusahaan }}</td>
                </tr>
                <tr>
                    <td>Nama Perorangan</td>
                    <td>: {{ $data->nama_perorangan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: {{ $data->alamat_ada }}</td>
                </tr>
                <tr>
                    <td>Nomor Telepon/WA</td>
                    <td>: {{ $data->no_telp_ada }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $data->email_ada }}</td>
                </tr>
                <tr>
                    <td>Pembayaran Langsung (e-billing)</td>
                    <td>: {{ $data->pembayaran_langsung }}</td>
                </tr>
                <tr>
                    <td>Pembayaran Sebelum Selesai Pengujian (e-billing)</td>
                    <td>: {{ $data->pembayaran_sebelum }}</td>
                </tr>
                <tr>
                    <td>Harga Pelayanan Pengujian Sesuai</td>
                    <td>: {{ $data->harga_sesuai }}</td>
                </tr>
                <tr>
                    <td>No. Identitas Nama Penghubung</td>
                    <td>: {{ $data->no_identitas }}</td>
                </tr>
                <tr>
                    <td>Nama Pemilik Sesuai</td>
                    <td>: {{ $data->nama_pemilik }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Kesimpulan</div>
            <p>{{ $data->kesimpulan == 'Ya' ? 'Layak' : 'Tidak Layak' }}</p>
        </div>

        <div class="section">
            <div class="section-title">Tim Kepatuhan</div>
            <p>{{ $data->tim_kepatuhan }}</p>
        </div>

        <div class="section">
            <div class="section-title">File Upload dokumen KTP/ KTM/Kartu
                Nama/Surat Pemohonan dari Institusi/
                Universitas/Sekolah, dll</div>
            @if($data->dokumen)
                <img src="{{ $dokumentBase64 }}" alt="Dokumen/Gambar" style="max-width:40%; height:auto;">
            @else
                <p>Tidak ada gambar atau dokumen yang diunggah.</p>
            @endif
        </div>        

        <div class="signature">
        @php
            \Carbon\Carbon::setLocale('id'); // Mengatur locale Carbon ke bahasa Indonesia
        @endphp

        <p>{{ $data->tempat }}, {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</p>

        {{-- !-- Menampilkan QR Code dalam format SVG --> --}}
        <div class="signature-barcode">
            <img src="data:image/svg+xml;base64,{{ $qrcodeBase64 }}" alt="QR Code" width="80">
        </div>

        <p class="signature-name">{{ $data->nama_pengguna }}</p>
    </div>

    </div>
</body>
</html>