<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UJI KELAYAKAN PENYEDIA JASA</title>
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
            color: #595959;
        }

        .section {
            margin-bottom: 20px;
            margin-left: 2cm;
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
            margin-left: 2cm;
        }

        table {
            width: 87%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 2px dotted gray;
        }

        th, td {
            border: 2px dotted gray;
            padding: 8px;
            text-align: left;
        }

        td {
            border: 2px dotted gray;
        }

        .no-border {
            border: none;
        }

        .qr-code {
            width: 80px;
            height: 80px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <h3>UJI KELAYAKAN PENYEDIA JASA</h3>

    <div class="section">
        <div class="field">
            <span class="label">Nama Rekan Bisnis:</span>
            <span class="value">{{ $data->nama_rekan }}</span>
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
            <span class="label">Pegawai Penghubung:</span>
            <span class="value">{{ $data->pegawai_penghubung }}</span>
        </div>
        <div class="field">
            <span class="label">No Telepon:</span>
            <span class="value">{{ $data->no_telepon }}</span>
        </div>
    </div>

    <div class="section">
        <table>
            <tr>
                <th>NO</th>
                <th>KRITERIA</th>
                <th>HASIL EVALUASI</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Legalitas yang dimiliki</td>
                <td>{{ $data->legalitas }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Kualifikasi rekan bisnis</td>
                <td>{{ $data->kualifikasi }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Sumber daya yang dimiliki rekan bisnis</td>
                <td>{{ $data->sumber_daya }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Apakah rekan bisnis menerapkan sistem manajemen anti penyuapan</td>
                <td>{{ $data->anti_penyuapan }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Apakah rekan bisnis pernah terlibat kasus penyuapan</td>
                <td>{{ $data->kasus_penyuapan }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Mekanisme transaksi dan pembayaran</td>
                <td>{{ $data->mekanisme_transaksi }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Nomor Induk Berusaha</div>
        <div class="field">{{ $data->nib }}</div>
    </div>

    <div class="section">
        <div class="section-title">KESIMPULAN UJI KELAYAKAN</div>
        <div class="field">{{ $data->kesimpulan }}</div>
    </div>

    <div class="signature">
        <div>Mengetahui Tim Kepatuhan</div>
        <div>{{ $data->nama_tim_kepatuhan }}</div>
        <div>Dibuat di {{ $data->tempat }}</div>
        <div>Tanggal {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</div>
        <img src="data:image/svg+xml;base64,{{ $qrcodeBase64 }}" alt="QR Code" class="qr-code">
        <div>{{ $data->tim_kepatuhan }}</div>
    </div>
</body>
</html>
