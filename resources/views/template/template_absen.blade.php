<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Record</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 0 20px;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            max-width: 100%;
            height: auto;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 5px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 210px;
        }

        .value {
            display: inline-block;
        }

        .form-section {
            margin: 20px 0;
        }

        .form-section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 260px;
            margin-bottom: 20px;
            font-size: 12pt; /* Adjusted font size for the subject box */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ $base64 }}" alt="Letterhead">
    </div>

    <div class="container">
        <h3>REKAMAN <br>
            PELAKSANAAN KEGIATAN
            </h3>
        <div class="section">
            <div class="field">
                <span class="label">Nama Kegiatan          </span>
                <span class="value">:{{ $activity->activity_name }}</span>
            </div>
            <div class="field">
                <span class="label">Tanggal                </span>
                <span class="value">:{{ \Carbon\Carbon::parse($activity->activity_date)->format('d/m/Y') }}</span>
            </div>
            <div class="field">
                <span class="label">Penanggung Jawab       </span>
                <span class="value">:{{ $activity->responsible }}</span>
            </div>
            <div class="field">
                <span class="label">Jumlah Peserta/Undangan</span>
                <span class="value">:{{ $activity->participant_count }}</span>
            </div>
            <div class="field">
                <span class="label">Kode Akun              </span>
                <span class="value">:{{ $activity->account_code }}</span>
            </div>
        </div>
    
        <div class="form-section">
            <div class="form-section-title">Deskripsi Tujuan</div>
            <div class="form-box">{{ $activity->objective }}</div>
        </div>
    
        <div class="form-section">
            <div class="form-section-title">Ringkasan Hasil Pelaksanaan Kegiatan</div>
            <div class="form-box">{{ $activity->summary }}</div>
        </div>
    
        <div class="section">
            <h3>Daftar Hadir Peserta</h3>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jabatan/Asal Instansi</th>
                        <th>Tanda Tangan</th>
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
    </div>
</body>
</html>
