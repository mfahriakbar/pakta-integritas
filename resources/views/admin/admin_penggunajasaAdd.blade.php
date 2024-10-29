@extends('layouts.admin')
@section('title', 'Tambah Pengguna Jasa')
@section('content')
    <header>
        <h1>Tambah Pengguna Jasa Baru</h1>
    </header>
    <hr class="header-line">
    <div class="isi-form" id="isi-form">
        <form action="{{ route('studi-kelayakan.store.admin') }}" method="POST" enctype="multipart/form-data" id="form-container"
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

            <h3>IDENTITAS PENGGUNA JASA</h3>

            <div class="form-group">
                <label for="nama_pengguna">Nama Perusahaan/Instansi/Perorangan Pengguna Jasa <span>*</span></label>
                <input type="text" id="nama_pengguna" name="nama_pengguna" value="{{ old('nama_pengguna') }}" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat <span>*</span></label>
                <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label for="hubungan">Hubungan dengan BPMSPH <span>*</span></label>
                <input type="text" id="hubungan" name="hubungan" value="{{ old('hubungan') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_penghubung">Nama Pegawai Penghubung Pengguna Jasa <span>*</span></label>
                <input type="text" id="nama_penghubung" name="nama_penghubung" value="{{ old('nama_penghubung') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="no_telepon">Nomor Handphone/WhatsApp <span>*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="tel" id="no_telepon" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}"
                        placeholder="81234567899" pattern="^\d{8,13}$" required>
                </div>
            </div>

            <h3>1. DATA PENGGUNA JASA</h3>

            <div class="form-group">
                <label>a. Nama Perusahaan <span>*</span></label>
                <select name="nama_perusahaan" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('nama_perusahaan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('nama_perusahaan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>b. Nama Perorangan <span>*</span></label>
                <select name="nama_perorangan" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('nama_perorangan') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('nama_perorangan') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>c. Alamat <span>*</span></label>
                <select name="alamat_ada" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('alamat_ada') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('alamat_ada') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>d. Nomor Telepon/WA <span>*</span></label>
                <select name="no_telp_ada" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('no_telp_ada') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('no_telp_ada') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>e. Nomor Email <span>*</span></label>
                <select name="email_ada" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('email_ada') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('email_ada') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <h3>2. KESANGGUPAN PEMBAYARAN PELAYANAN PENGUJIAN</h3>

            <div class="form-group">
                <label>a. Pembayaran Langsung (e-billing) <span>*</span></label>
                <select name="pembayaran_langsung" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('pembayaran_langsung') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('pembayaran_langsung') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>b. Pembayaran Sebelum Selesai Pengujian (e-billing) <span>*</span></label>
                <select name="pembayaran_sebelum" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('pembayaran_sebelum') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('pembayaran_sebelum') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>c. Harga Pelayanan Pengujian Sesuai <span>*</span></label>
                <select name="harga_sesuai" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('harga_sesuai') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('harga_sesuai') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <h3>3. DATA</h3>

            <div class="form-group">
                <label>a. Nomor Identitas Nama Penghubung <span>*</span></label>
                <select name="no_identitas" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('no_identitas') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('no_identitas') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <div class="form-group">
                <label>b. Nama Pemilik Perusahaan/ Pengguna Jasa <span>*</span></label>
                <select name="nama_pemilik" required>
                    <option value="">Pilih...</option>
                    <option value="Ya" {{ old('nama_pemilik') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ old('nama_pemilik') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>

            <h3>KESIMPULAN UJI KELAYAKAN</h3>

            <div class="form-group">
                <label for="kesimpulan">Layak menjadi Pengguna Jasa <span>*</span></label>
                <select id="kesimpulan" name="kesimpulan" required>
                    <option value="">Pilih...</option>
                    <option value="Layak" {{ old('kesimpulan') == 'Layak' ? 'selected' : '' }}>Layak</option>
                    <option value="Tidak Layak" {{ old('kesimpulan') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tim_kepatuhan">Mengetahui Tim Kepatuhan <span>*</span></label>
                <input type="text" id="tim_kepatuhan" name="tim_kepatuhan" value="{{ old('tim_kepatuhan') }}" required>
            </div>

            <div class="form-group">
                <label for="tempat">Kota <span>*</span></label>
                <input type="text" id="tempat" name="tempat" value="{{ old('tempat') }}" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal <span>*</span></label>
                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_pelaksana">Nama Pelaksana Kegiatan BPMSPH <span>*</span></label>
                <input type="text" id="nama_pelaksana" name="nama_pelaksana" value="{{ old('nama_pelaksana') }}" required>
            </div>

            <div class="form-group">
                <label for="dokumen" class="upload-label">File Upload dokumen KTP/ KTM/Kartu Nama/Surat Permohonan dari Institusi/Universitas/Sekolah, dll <span>*</span></label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" id="dokumen" name="dokumen" accept="image/*,application/pdf" hidden required>
                    <span>Seret dan lepas file di sini atau <strong>klik untuk memilih file</strong></span>
                    <div id="filePreview" class="file-preview"></div>
                </div>
            </div>

            <div class="btn-send-form">
                <button id="submit-btn" type="submit">
                    Simpan <i class="fa-solid fa-save"></i>
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

        .upload-area {
            border: 2px dashed #28a745;
            padding: 20px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .file-preview img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-container');
        const submitBtn = document.querySelector('#submit-btn');
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('dokumen');
        const filePreview = document.getElementById('filePreview');

        // Handle form submission with SweetAlert2
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form auto-submit

            // Validate form before submitting
            if (!form.checkValidity()) {
                form.reportValidity(); // Show validation messages if form is invalid
                return;
            }

            // Display confirmation dialog
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

                    fetch('{{ route('studi-kelayakan.store') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text()) // Coba lihat respons mentah
                .then(data => {
                    console.log(data); // Lihat respons di konsol
                    // Kemudian coba konversi ke JSON jika sesuai
                    let jsonResponse = JSON.parse(data);
                    Swal.fire({
                        title: "Terkirim!",
                        text: jsonResponse.message,
                        icon: "success",
                        footer: '<a href="https://mail.google.com/">Pergi ke Email?</a>',
                        showConfirmButton: true,
                        timer: 10000
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirim laporan.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Kirim";
                });
                }
            });
        });

        // Handle file upload preview
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', handleFiles);

        uploadArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadArea.style.backgroundColor = '#e0e0e0';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.backgroundColor = '';
        });

        uploadArea.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadArea.style.backgroundColor = '';
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFiles();
            }
        });

        function handleFiles() {
            const files = fileInput.files;
            filePreview.innerHTML = '';

            for (const file of files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const fileType = file.type.split('/')[0];
                    if (fileType === 'image') {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        filePreview.appendChild(img);
                    } else {
                        const para = document.createElement('p');
                        para.textContent = `File: ${file.name} (PDF)`;
                        filePreview.appendChild(para);
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        // Clear file preview after submission
        function clearFilePreview() {
            filePreview.innerHTML = '';
            fileInput.value = ''; // Reset the file input
            document.getElementById('uploadArea').querySelector('span').style.display = 'inline';
        }
    });
    </script>
@endsection