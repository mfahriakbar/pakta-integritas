@extends('layouts.user')

@section('title', 'Pelatihan')

<style>
        .container-cara-melapor {
            line-height: 1.6;
            width: 50%;
        }
        .header {
            background: #005e8a;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 0 15px;
            background-color: #fff;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9em;
            color: #666;
        }
        ul {
            padding-left: 20px;
        }
</style>

@section('content')

    {{-- loading --}}
    <div id="loader" class="loader-container">
        <div class="spinner"></div>
    </div>

    <!-- bg -->
    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>
        <div class="container-cara-melapor">
            <div class="header">
                <h2 style="margin: 0;">e-learning Pelatihan Anti Korupsi Suap Pungli dan Gratifikasi</h2>
            </div>
            <div class="content">
               
                <p>Kepada Yth,<br>
                Bapak/Ibu<br>
                Seluruh Pegawai BPMSPH
                </p>
    
                <p>Untuk meningkatkan pengetahuan Integritas antikorupsi, Bapak/Ibu dapat mengikuti kursus pada e-learning KPK.</p>
                
                <h3>Informasi Kursus:</h3>
                <ul>
                    <li>Platform: Portal E-Learning KPK</li>
                    <li>Alamat: <a href="https://elearning.kpk.go.id/">https://elearning.kpk.go.id/</a></li>
                    <li>Metode: Online</li>
                    <li>Waktu: Fleksibel</li>
                </ul>
                
                <h3>Materi Kursus yang Sedang Berlangsung:</h3>
                <p><strong>ANTIKORUPSI DAN INTEGRITAS</strong></p>
                <ul>
                    <li>Pengetahuan antikorupsi dasar dan integritas (PADI) 2024</li>
                    <li>Pendalaman lima belas topik antikorupsi (PELITA) 2024</li>
                </ul>
    
                <p>Silakan melakukan pendaftaran mandiri dan mengikuti kursus yang tersedia.</p>
    
                <a href="https://elearning.kpk.go.id/" class="button">Daftar Sekarang</a>
    
                <div class="footer">
                    <p>Catatan: Kursus ini dilakukan secara online dengan waktu pelaksanaan yang fleksibel sesuai dengan ketersediaan waktu Anda.</p>
                </div>
            </div>
        </div>

<script src="script.js"></script>
@endsection
