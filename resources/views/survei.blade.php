@extends('layouts.user')

@section('title', 'Survei Persepsi Kualitas Pelayanan dan Anti Korupsi')

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

    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>
    <div class="container-cara-melapor">
        <div class="header">
            <h2 style="margin: 0;">Survei Persepsi Kualitas Pelayanan dan Anti Korupsi</h2>
        </div>
        <div class="content">
           
            <p>Kepada Yth,<br>
            Bapak/Ibu<br>
            Seluruh Pegawai BPMSPH
            </p>
    
            <p>Untuk meningkatkan kualitas pelayanan dan integritas antikorupsi, kami mengundang Bapak/Ibu untuk berpartisipasi dalam dua survei penting berikut:</p>
            
            <h3>Informasi Survei:</h3>
            <ul>
                <li>Platform: Survei Persepsi Kualitas Pelayanan dan Anti Korupsi</li>
                <li>Alamat: <a href="https://docs.google.com/forms/d/e/1FAIpQLSdO3aAGOD3-bJRqwUaSacl-qFSGYNRDs9VqsihkayAFoTSmVw/viewform">https://SurveiPersepsiKualitasPelayanandanAntiKorupsi.bpmsph.go.id/</a></li>
                <li>Metode: Online</li>
                <li>Waktu: Fleksibel</li>
            </ul>
            
            <h3>Tujuan Survei:</h3>
            <p><strong>SPKP:</strong> Mengukur kepuasan pegawai terhadap kualitas pelayanan di BPMSPH.</p>
            <p><strong>SPAK:</strong> Mengidentifikasi persepsi pegawai terhadap praktik anti korupsi di lingkungan BPMSPHS.</p>
    
            <p>Silakan mengisi survei secara mandiri melalui tautan berikut.</p>
    
            <a href="https://docs.google.com/forms/d/e/1FAIpQLSdO3aAGOD3-bJRqwUaSacl-qFSGYNRDs9VqsihkayAFoTSmVw/viewform" class="button">Ikuti Survei Sekarang</a>
    
            <div class="footer">
                <p>Catatan: Partisipasi dalam survei ini sangat penting untuk perbaikan layanan dan penegakan integritas di Kementerian Pertanian.</p>
            </div>
        </div>
    </div>

<script src="script.js"></script>
@endsection
