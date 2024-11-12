@extends('layouts.admin')

@section('title', 'Tambah Laporan Benturan Kepentingan')

@section('content')
<header>
    <h1>Silahkan Isi Formulir Laporan Benturan Kepentingan</h1>
</header>
<hr class="header-line">
<div class="isi-form" id="isi-form">
    <form action="{{ route('benturan.store') }}" method="POST" enctype="multipart/form-data" id="form-container" class="form-container">
        @csrf
        <input type="hidden" name="is_admin" value="true">
        <h3>FORMULIR LAPORAN BENTURAN KEPENTINGAN</h3>
        
        <!-- Error Message Handling -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="subjectPosition">Subjek Atau Jabatan <span>*</span></label>
            <select id="subjectPosition" name="subjectPosition" required>
                <option value="">Pilih Jabatan</option>
                <option value="Kepala Balai">Kepala Balai</option>
                <option value="Kepala Sup Bagian Tata Usaha">Kepala Sup Bagian Tata Usaha</option>
                <option value="Tim Kerja Penyiapan Sampel & Informasi">Tim Kerja Penyiapan Sampel & Informasi</option>
                <option value="Tim Kerja Pelayanan Teknis">Tim Kerja Pelayanan Teknis</option>
                <option value="Tim Kerja Pengembangan Metode">Tim Kerja Pengembangan Metode</option>
                <option value="Pejabat Fungsional Medik Veteriner">Pejabat Fungsional Medik Veteriner</option>
                <option value="Pejabat Fungsional Paramedik Veteriner">Pejabat Fungsional Paramedik Veteriner</option>
                <option value="Pejabat Fungsional Pengawas Mutu Hasil Pertanian">Pejabat Fungsional Pengawas Mutu Hasil Pertanian</option>
                <option value="Pejabat Fungsional Arsiparis">Pejabat Fungsional Arsiparis</option>
                <option value="Pejabat Pengelola Keuangan">Pejabat Pengelola Keuangan</option>
                <option value="Pejabat Pembuat Komitmen">Pejabat Pembuat Komitmen</option>
                <option value="Pejabat Penerima Hasil Pengadaan">Pejabat Penerima Hasil Pengadaan</option>
                <option value="Fungsional Umum">Fungsional Umum</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <input type="text" id="subjectPositionOther" name="subjectPositionOther" style="display:none; margin-top:10px;" placeholder="Tulis jabatan lain...">
        </div>

        <div class="form-group">
            <label for="activityType">Jenis Kegiatan <span>*</span></label>
            <textarea id="activityType" name="activityType" required rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="situation">Situasi/Kondisi Benturan Kepentingan <span>*</span></label>
            <textarea id="situation" name="situation" required rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="conflictType">Penyebab Benturan Kepentingan <span>*</span></label>
            <select id="conflictType" name="conflictType" required>
                <option value="">Pilih Penyebab</option>
                <option value="Gratifikasi">Gratifikasi</option>
                <option value="Kelemahan Sistem">Kelemahan Sistem</option>
                <option value="Hubungan Afiliasi">Hubungan Afiliasi</option>
                <option value="Penyalahgunaan Wewenang">Penyalahgunaan Wewenang</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label for="Penanganan">Strategi penanganan Benturan Kepentingan <span>*</span></label>
            <textarea id="Penanganan" name="Penanganan" required rows="4"></textarea>
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center;">
                <input type="checkbox" id="declaration" name="declaration" required style="width: auto; margin-right: 8px; transform: scale(1.3);">
                <p>Saya menyatakan bahwa informasi yang saya berikan di atas adalah benar. <span>*</span></p>
            </label>
        </div>

        <div class="btn-send-form">
            <button id="submit-btn" type="submit">
                Kirim Laporan <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subjectPositionSelect = document.getElementById('subjectPosition');
        const subjectPositionOtherInput = document.getElementById('subjectPositionOther');

        subjectPositionSelect.addEventListener('change', function() {
            if (subjectPositionSelect.value === 'Lainnya') {
                subjectPositionOtherInput.style.display = 'block';
            } else {
                subjectPositionOtherInput.style.display = 'none';
                subjectPositionOtherInput.value = ''; // Clear input if not "Lainnya"
            }
        });
    });
</script>

<style>
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

@endsection
