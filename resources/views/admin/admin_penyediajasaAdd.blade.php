@extends('layouts.admin')
@section('title', 'Tambah Pengguna Jasa')
@section('content')
    <header>
        <h1>Tambah Pengguna Jasa Baru</h1>
    </header>
    <hr class="header-line">
    <div class="isi-form" id="isi-form">
        <form action="{{ route('penyedia-jasa.store') }}" method="POST" enctype="multipart/form-data" id="form-container"
            class="form-container">
            @csrf
            <input type="hidden" name="is_admin" value="true">
            <h3>FORMULIR TAMBAH PENGGUNA JASA</h3>
            <div class="img-form">
                <img src="{{ asset('assets/pembatas.png') }}" alt="">
            </div>
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

            <h3>Form Uji Kelayakan Rekan Bisnis</h3>

            <div class="form-group">
                <label for="nama_rekan">Nama Rekan Bisnis: <span>*</span></label>
                <input type="text" id="nama_rekan" name="nama_rekan" value="{{ old('nama_rekan') }}" required>
            </div>
        
            <div class="form-group">
                <label for="alamat">Alamat: <span>*</span></label>
                <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
            </div>
        
            <div class="form-group">
                <label for="hubungan">Hubungan dengan BPMSPH: <span>*</span></label>
                <input type="text" id="hubungan" name="hubungan" value="{{ old('hubungan') }}" required>
            </div>
        
            <div class="form-group">
                <label for="pegawai_penghubung">Pegawai Penghubung: <span>*</span></label>
                <input type="text" id="pegawai_penghubung" name="pegawai_penghubung" value="{{ old('pegawai_penghubung') }}" required>
            </div>
        
            <div class="form-group">
                <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                    <small>Contoh: 81234567899</small>
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="tel" id="no_telepon" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}"
                        placeholder="81234567899" pattern="^\d{8,13}$" required>
                </div>
            </div>
        
            <table>
                <tr>
                    <th>NO</th>
                    <th>KRITERIA</th>
                    <th>HASIL EVALUASI <span style="color: red">*</span></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Legalitas yang dimiliki</td>
                    <td>
                        <select name="legalitas" required>
                            <option value="">Pilih...</option>
                            <option value="Sesuai" {{ old('legalitas') == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('legalitas') == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kualifikasi rekan bisnis</td>
                    <td>
                        <select name="kualifikasi" required>
                            <option value="">Pilih...</option>
                            <option value="Unit Dagang" {{ old('kualifikasi') == 'Unit Dagang' ? 'selected' : '' }}>Unit Dagang</option>
                            <option value="CV" {{ old('kualifikasi') == 'CV' ? 'selected' : '' }}>CV</option>
                            <option value="PT" {{ old('kualifikasi') == 'PT' ? 'selected' : '' }}>PT</option>
                            <option value="Lainnya" {{ old('kualifikasi') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Sumber daya yang dimiliki rekan bisnis</td>
                    <td>
                        <select name="sumber_daya" required>
                            <option value="">Pilih...</option>
                            <option value="Sesuai" {{ old('sumber_daya') == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                            <option value="Tidak Sesuai" {{ old('sumber_daya') == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Apakah rekan bisnis menerapkan sistem manajemen anti penyuapan</td>
                    <td>
                        <select name="anti_penyuapan" required>
                            <option value="">Pilih...</option>
                            <option value="Iya" {{ old('anti_penyuapan') == 'Iya' ? 'selected' : '' }}>Iya</option>
                            <option value="Tidak" {{ old('anti_penyuapan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Apakah rekan bisnis pernah terlibat kasus penyuapan</td>
                    <td>
                        <select name="kasus_penyuapan" required>
                            <option value="">Pilih...</option>
                            <option value="Iya" {{ old('kasus_penyuapan') == 'Iya' ? 'selected' : '' }}>Iya</option>
                            <option value="Tidak" {{ old('kasus_penyuapan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Mekanisme transaksi dan pembayaran</td>
                    <td><input type="text" id="mekanisme_transaksi" name="mekanisme_transaksi" value="{{ old('mekanisme_transaksi') }}" required></td>
                </tr>
            </table>

            <div class="form-group">
                <label for="nib">Nomor Induk Berusaha (NIB): <span>*</span></label>
                <input type="text" id="nib" name="nib" value="{{ old('nib') }}" required>
            </div>
        
            <div class="form-group">
                <label for="kesimpulan">Kesimpulan Uji Kelayakan: <span>*</span></label>
                <select id="kesimpulan" name="kesimpulan" required>
                    <option value="">Pilih...</option>
                    <option value="Memenuhi Persyaratan" {{ old('kesimpulan') == 'Memenuhi Persyaratan' ? 'selected' : '' }}>Memenuhi Persyaratan</option>
                    <option value="Tidak Memenuhi Persyaratan" {{ old('kesimpulan') == 'Tidak Memenuhi Persyaratan' ? 'selected' : '' }}>Tidak Memenuhi Persyaratan</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="tempat">Tempat: <span>*</span></label>
                <input type="text" id="tempat" name="tempat" value="{{ old('tempat') }}" required>
            </div>
        
            <div class="form-group">
                <label for="tanggal">Tanggal: <span>*</span></label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            </div>
        
            <div class="form-group">
                <label for="tim_kepatuhan">Tim Kepatuhan: <span>*</span></label>
                <input type="text" id="tim_kepatuhan" name="tim_kepatuhan" value="{{ old('tim_kepatuhan') }}" required>
            </div>
        
            <div class="btn-send-form">
                <button id="submit-btn" type="submit"> Kirim <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
    
    <style>
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-container');
    const submitBtn = document.querySelector('#submit-btn');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Pastikan data dan email yang Anda masukkan sudah benar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, kirim!"
        }).then((result) => {
            if (result.isConfirmed) {
                submitBtn.disabled = true;
                submitBtn.textContent = "Mengirim...";

                let formData = new FormData(form);

                fetch('{{ route('penyedia-jasa.store') }}', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: "Terkirim!",
                            text: data.message,
                            icon: "success",
                            showConfirmButton: true,
                            timer: 10000
                        }).then(() => {
                            form.reset();
                            clearFilePreview();
                        });
                    } else {
                        throw new Error(data.message || 'Terjadi kesalahan saat mengirim laporan.');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Kirim";
                });
            }
        });
    });
});
    </script>
@endsection