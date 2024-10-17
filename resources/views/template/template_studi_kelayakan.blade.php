<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UJI KELAYAKAN PENGGUNA JASA</title>
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
        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #595959
        }
        .section {
            margin-bottom: 20px;
            margin-left: 2cm
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .field {
            margin-bottom: 5px;
        }
        .label {
            font-weight: bold;
        }
        .value {
            margin-left: 10px;
        }
        .signature {
            margin-top: 30px;
            margin-left: 2cm
        }
        .document-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            margin-left: 2cm;
        }
        .document-title {
            flex: 0 0 60%;
        }
        .document-image {
            flex: 0 0 40%;
            text-align: right;
        }
        .document-image img {
            max-width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <h3>UJI KELAYAKAN PENGGUNA JASA</h3>

    <div class="section">
        <div class="section-title" style="color: #595959">IDENTITAS PENGGUNA JASA</div>
        <div class="field">
            <span class="label">Nama Perusahaan/Instansi/Perorangan Pengguna Jasa:</span>
            <span class="value">{{ $data->nama_pengguna }}</span>
        </div>
        <div class="field">
            <span class="label">Alamat:</span>
            <span class="value">{{ $data->alamat }}</span>
        </div>
        <div class="field">
            <span class="label">Hubungan dengan BPMSPH:</span>
            <span class="value">{{ $data->hubungan }}</span>
        </div>
        <div class="field">
            <span class="label">Nama Pegawai Penghubung Pengguna Jasa:</span>
            <span class="value">{{ $data->nama_penghubung }}</span>
        </div>
        <div class="field">
            <span class="label">Nomor Telpon/WA:</span>
            <span class="value">{{ $data->no_telepon }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title" style="color: #595959">1. DATA PENGGUNA JASA</div>
        <div class="field">
            <span class="label">a. Nama Perusahaan:</span>
            <span class="value">{{ $data->nama_perusahaan ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">b. Nama Perorangan:</span>
            <span class="value">{{ $data->nama_perorangan ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">c. Alamat:</span>
            <span class="value">{{ $data->alamat_ada ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">d. Nomor Telepon/WA:</span>
            <span class="value">{{ $data->no_telp_ada ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">e. Nomor Email:</span>
            <span class="value">{{ $data->email_ada ? 'Ya' : 'Tidak' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title" style="color: #595959">2. KESANGGUPAN PEMBAYARAN PELAYANAN PENGUJIAN</div>
        <div class="field">
            <span class="label">a. Pembayaran Langsung (e-billing):</span>
            <span class="value">{{ $data->pembayaran_langsung ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">b. Pembayaran Sebelum Selesai Pengujian (e-billing):</span>
            <span class="value">{{ $data->pembayaran_sebelum ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">c. Harga Pelayanan Pengujian Sesuai:</span>
            <span class="value">{{ $data->harga_sesuai ? 'Ya' : 'Tidak' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title" style="color: #595959">3. DATA</div>
        <div class="field">
            <span class="label">a. Nomor Identitas Nama Penghubung:</span>
            <span class="value">{{ $data->no_identitas ? 'Ya' : 'Tidak' }}</span>
        </div>
        <div class="field">
            <span class="label">b. Nama Pemilik Perusahaan/ Pengguna Jasa:</span>
            <span class="value">{{ $data->nama_pemilik ? 'Ya' : 'Tidak' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">KESIMPULAN UJI KELAYAKAN</div>
        <div class="field">{{ $data->kesimpulan }}</div>
    </div>

    <div class="document-section">
        <div class="document-title">
            <div class="section-title">File Upload dokumen KTP/ KTM/Kartu <br>
                Nama/Surat Pemohonan dari Institusi/ <br>
                Universitas/Sekolah, dll
            </div>
        </div>
        <div class="document-image">
            @if($data->dokumen)
                <img src="{{ $dokumentBase64 }}" alt="Dokumen/Gambar">
            @else
                <p>Tidak ada gambar atau dokumen yang diunggah.</p>
            @endif
        </div>
    </div>
    
    <div class="signature">
        <div>Mengetahui Tim Kepatuhan</div>
        <div>{{ $data->tim_kepatuhan }}</div>
        <div>Dibuat di {{ $data->tempat }}</div>
        <div>Tanggal {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</div>
        <div>
            <img src="data:image/svg+xml;base64,{{ $qrcodeBase64 }}" alt="QR Code" width="80">
        </div>
        <div>Nama Pelaksana Kegiatan BPMSPH {{ $data->nama_pengguna }}</div>
    </div>
</body>
</html>