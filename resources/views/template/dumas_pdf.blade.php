<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
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
        .title {
            text-align: center;
            margin-bottom: 30px;
        }
        .title h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }
        .content {
            margin-top: 30px;
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
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .footer img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding-left: 20px;
        }
        ul li::before {
            content: "-";
            margin-right: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        .bawah {
            text-align: left;
            margin-top: 30px;
            position: absolute;
            bottom: 30px; /* Menempatkan signature di bagian bawah halaman */
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding-left: 2cm;
            padding-right: 2cm;
        }
    </style>
</head>
<body>

    <div class="title">
        <h1>LAPORAN MONITORING EVALUASI</h1>
        <h1>PENGADUAN MASYARAKAT</h1>
        <h1>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h1>
        <h1>{{ strtoupper($dumas->month) }}</h1>
    </div>

    <div class="header">
        <img src="{{ $base64 }}" alt="Kop Surat">
    </div>

    <div class="bawah">
    <h4>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h4>
        <h4 style="margin-left: 32%">2024</h4>
    </div>

    <!-- Memaksa pindah ke halaman kedua -->
    <div class="page-break"></div>

    <div class="content">
        <div class="section">
            <div class="section-title">A. Pendahuluan</div>
            <div class="section-title">A.1. Latar Belakang</div>
            <p>Pelayanan publik yang diberikan oleh Aparatur Sipil Negara (ASN) di lingkungan Balai Pengujian Mutu dan Sertifikasi Produk Hewan (BPMSPH) yang menjadi keluhan masyarakat pengguna jasa layanan pengujian produk hewan. Hal ini dikarenakan adanya ketidaksesuaian antara pelayanan yang diberikan dengan standar pelayanan yang telah ditetapkan, sehingga menjadi permasalahan dari implementasi pelayanan kepada masyarakat.</p>
            <p>Berdasarkan adanya permasalahan tersebut, maka peningkatan pelayanan untuk meraih kepuasan masyarakat selalu diupayakan oleh BPMSPH dengan mewujudkan Pelayanan Prima dan pencanangan pembangunan zona integritas menuju Wilayah Bebas dari Korupsi (WBK) dan Wilayah Birokrasi Bersih Melayani (WBBM) demi terwujudnya cita-cita reformasi birokrasi pelayanan ASN.</p>
            <p>Optimalisasi pelayanan prima demi kepuasan masyarakat pengguna jasa pengujian produk hewan terus dikerjakan, untuk itu diperlukan kesinambungan pengawasan/ monitoring dan evaluasi terhadap penanganan pengaduan masyarakat (dumas).</p>
        </div>

        <div class="section">
            <div class="section-title">A.2. Maksud dan Tujuan</div>
            <ul>
                <li>Sebagai bahan monitoring dan evaluasi dalam pelaksanaan kegiatan penanganan pengaduan masyarakat dalam mendukung zona integritas menuju Wilayah Bebas dari Korupsi (WBK) dan Wilayah Birokrasi Bersih Melayani (WBBM) di BPMSPH.</li>
                <li>Sebagai bahan masukan untuk rekomendasi tindak lanjut apabila dalam pelaksanaan pelayanan publik tersebut terdapat keluhan dan pengaduan yang perlu ditindaklanjuti.</li>
            </ul>
        </div>

        <div class="section">
            <div class="section-title">A.3. Ruang Lingkup</div>
            <p>Ruang Lingkup yang tertuang dalam laporan ini merupakan Pelaksanaan Monitoring dan Evaluasi Penanganan Benturan Kepentingan pada Pelayanan Publik BPMSPH</p>
        </div>

        <div class="page-break"></div>

        <div class="section">
            <div class="section-title">A.4. Dasar</div>
            <ul>
                <li>Undang-Undang Nomor 25 Tahun 2009 tentang pelayanan publik;</li>
                <li>Peraturan Presiden Nomor 76 Tahun 2013 tentang Pedoman Pengelolaan Pengaduan Pelayanan Publik;</li>
                <li>Peraturan Menteri Pertanian Nomor 7 Tahun 2022 tentang Penanganan Benturan Kepentingan, Pengendalian Gratifikasi dan Pengelolaan Pengaduan Masyarakat Lingkup Kementerian Pertanian</li>
            </ul>
        </div>

        <div class="section">
            <div class="section-title">B. Kegiatan yang dilaksanakan</div>
            <p>Kegiatan Monitoring dan Evaluasi atas penanganan pengaduan masyarakat (dumas) pada BPMSPH dilakukan secara berkala setiap tahunnya.</p>
        </div>

        <div class="section">
            <div class="section-title">C. Hasil yang dicapai</div>
            <p>Berdasarkan hasil evaluasi atas penanganan pengaduan masyarakat pada Lingkup BPMSPH selama {{ $dumas->month }} adalah sebagai berikut:</p>
            
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sarana Pengaduan</th>
                        <th>Jenis Pengaduan</th>
                        <th>Penanganan Pengaduan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dumas->complaints as $index => $complaint)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $complaint->complaint_channel }}</td>
                        <td>{{ $complaint->complaint_type ?: '-' }}</td>
                        <td>{{ $complaint->handling ?: '-' }}</td>
                        <td>{{ $complaint->remarks }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>

        <div class="section">
            <div class="section-title">D. Kesimpulan dan Saran</div>
            <div class="section-title">Kesimpulan</div>
            <p>Dari hasil monitoring dan evaluasi terhadap Penanganan Pengaduan Masyarakat selama {{ $dumas->month }} diperoleh hasil bahwa pada semua sarana dan layanan yang tersedia tidak ditemui adanya pengaduan masyarakat tentang pelayanan publik yang dilaksanakan di BPMSPH.</p>
            <p>Peningkatan pelayanan penanganan pengaduan masyarakat dan pelayanan publik di BPMSPH terus ditingkatkan dengan monitoring dan evaluasi berkala dan rutin melalui sarana yang tersedia.</p>

            <div class="section-title">Saran</div>
            <p>Diharapkan BPMSPH dapat mempertahankan dan meningkatkan pelayanan publik yang telah berjalan, dengan tidak melupakan perawatan sarana dan prasarana yang digunakan masyarakat pengguna jasa layanan pengujian, sehingga respon masyarakat atas pelayanan yang diberikan selalu positif.</p>
        </div>

        <div class="footer">
            <p>Bogor, {{ date('d F Y') }}</p>
            <p>Ketua Tim Pengaduan</p>
            <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt="QR Code">
            <p>Drh. Wiwit Subiyanti</p>
            <p>NIP. 198102212008012010</p>
        </div>
    </div>
</body>
</html>