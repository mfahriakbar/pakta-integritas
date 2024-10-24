<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir FKP</title>
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

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            max-width: 100%;
            height: auto;
        }

        .header-text {
            flex: 1;
            text-align: center;
        }

        .header-text h2 {
            font-size: 12pt; /* Adjusted font size */
            margin-bottom: 0;
        }

        .form-title {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin: 20px 0;
        }

        .form-type {
            margin: 0;
            border: 1px solid #000;
            padding: 10px;
        }

        .info-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .left-info {
            float: left;
            width: 48%;
        }

        .right-info {
            float: right; 
            width: 48%;
        }

        .clearfix {
            clear: both;
        }

        .form-row {
            display: flex;
            margin-bottom: 10px;
            align-items: flex-start;
        }

        .form-label {
            width: 120px;
            padding-right: 10px;
        }

        .form-value {
            flex: 1;
            border-bottom: 1px solid #000;
            min-height: 25px;
        }

        .form-section {
            margin: 20px 0;
        }

        .form-section-title {
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-bottom: 10px;
        }

        .form-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 35px;
            margin-bottom: 20px;
            font-size: 12pt; /* Adjusted font size for the subject box */
        }

        .signature-section {
            width: 100%;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-cell {
            width: 25%;
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
            vertical-align: bottom; 
        }

        .signature-title {
            min-height: 15px;
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #000; 
            padding-bottom: 5px; 
        }

        .signature-value {
            min-height: 10px; /* Ensure consistent height for values */
            padding-top: 5px; /* Space above value */
            vertical-align: top; /* Align the value to the top */
        }

        @media print {
            .signature-section {
                page-break-inside: avoid; /* Prevent breaking inside the section */
            }
        }
    </style>
</head>
<body>
    <!-- Header with Logo -->
    <div class="header">
        <div class="kop-surat">
            <img src="{{ $base64 }}" alt="Kop Surat">
        </div>
        <div class="header-text">
            <h2>KONSULTASI DAN PARTISIPASI K3</h2>
        </div>
    </div>

    <div class="container">
        <!-- Form Type Selection -->
        <div class="form-type">
            <strong>Jenis Pesan:</strong>
            @if($fkpForm->message_type == 'Konsultasi')
                <span style="font-family: DejaVu Sans;">☒</span> Konsultasi &nbsp;&nbsp;&nbsp; ☐ Partisipasi
            @else
                ☐ Konsultasi &nbsp;&nbsp;&nbsp; <span style="font-family: DejaVu Sans;">☒</span> Partisipasi
            @endif
        </div>

        <!-- Two Column Information Layout -->
        <div class="info-container">
            <!-- Left Column -->
            <div class="left-info">
                <div class="form-row">
                    <div class="form-label">No</div>
                    <div class="form-value">: {{ $fkpForm->id }}</div>
                </div>
                <div class="form-row">
                    <div class="form-label">Nama</div>
                    <div class="form-value">: {{ $fkpForm->employee_name }}</div>
                </div>
                <div class="form-row">
                    <div class="form-label">NIP</div>
                    <div class="form-value">: {{ $fkpForm->employee_id }}</div>
                </div>
                <div class="form-row">
                    <div class="form-label">Perusahaan</div>
                    <div class="form-value">: {{ $fkpForm->company }}</div>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="right-info">
                <div class="form-row">
                    <div class="form-label">Tanggal</div>
                    <div class="form-value">: {{ \Carbon\Carbon::parse($fkpForm->created_at)->format('d/m/Y') }}</div>
                </div>
                <div class="form-row">
                    <div class="form-label">Jabatan</div>
                    <div class="form-value">: {{ $fkpForm->position }}</div>
                </div>
                <div class="form-row">
                    <div class="form-label">Bagian</div>
                    <div class="form-value">: {{ $fkpForm->department }}</div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Subject -->
        <div class="form-section">
            <div class="form-section-title">Judul/Subjek</div>
            <div class="form-box">{{ $fkpForm->subject }}</div> <!-- Font size adjusted here -->
        </div>

        <!-- Problem Description -->
        <div class="form-section">
            <div class="form-section-title">Uraian Masalah</div>
            <div class="form-box">{{ $fkpForm->problem_description }}</div>
        </div>

        <!-- Proposed Solution -->
        <div class="form-section">
            <div class="form-section-title">Usulan Pemecahan</div>
            <div class="form-box">{{ $fkpForm->proposed_solution }}</div>
        </div>

        <!-- Notes -->
        <div class="form-section">
            <div class="form-section-title">Catatan (diisi petugas)</div>
            <div class="form-box">{{ $fkpForm->notes }}</div>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <table class="signature-table">
                <tr>
                    <td class="signature-cell">
                        <div class="signature-title"><p>Disusun oleh</p></div>
                        <div class="signature-value">{{ $fkpForm->prepared_by }}</div>
                    </td>
                    <td class="signature-cell">
                        <div class="signature-title"><p>Pelaksana</p></div>
                        <div class="signature-value">{{ $fkpForm->executor }}</div>
                    </td>
                    <td class="signature-cell">
                        <div class="signature-title"><p>Diterima<br>(Sekretaris Komite K3)</p></div>
                        <div class="signature-value">{{ $fkpForm->secretary_approval }}</div>
                    </td>
                    <td class="signature-cell">
                        <div class="signature-title"><p>Diperiksa<br>(Ketua Komite K3)</p></div>
                        <div class="signature-value">{{ $fkpForm->chairman_approval }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
