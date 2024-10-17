@extends('layouts.admin')

@section('title', 'Edit Studi Kelayakan')

@section('content')
    <header>
        <h1>Edit Studi Kelayakan</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <div class="form-container-wrapper">
            <form action="{{ route('studi-kelayakan.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="form-container" class="form-container">
                @csrf
                @method('PUT')

                <h3>FORMULIR EDIT STUDI KELAYAKAN</h3>

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
                    <input type="text" id="nama_pengguna" name="nama_pengguna" value="{{ old('nama_pengguna', $data->nama_pengguna) }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat <span>*</span></label>
                    <textarea id="alamat" name="alamat" required>{{ old('alamat', $data->alamat) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="hubungan">Hubungan dengan BPMSPH <span>*</span></label>
                    <input type="text" id="hubungan" name="hubungan" value="{{ old('hubungan', $data->hubungan) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama_penghubung">Nama Pegawai Penghubung Pengguna Jasa <span>*</span></label>
                    <input type="text" id="nama_penghubung" name="nama_penghubung" value="{{ old('nama_penghubung', $data->nama_penghubung) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $data->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="no_telepon">Nomor Handphone/WhatsApp <span>*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">+62</div>
                        <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', ltrim($data->no_telepon, '+62')) }}" class="form-control" pattern="^\d{8,13}$" required>
                    </div>
                </div>

                <h3>1. DATA PENGGUNA JASA</h3>

                <div class="form-group">
                    <label>a. Nama Perusahaan <span>*</span></label>
                    <select name="nama_perusahaan" required>
                        <option value="Ya" {{ old('nama_perusahaan', $data->nama_perusahaan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('nama_perusahaan', $data->nama_perusahaan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>b. Nama Perorangan <span>*</span></label>
                    <select name="nama_perorangan" required>
                        <option value="Ya" {{ old('nama_perorangan', $data->nama_perorangan) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('nama_perorangan', $data->nama_perorangan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>c. Alamat <span>*</span></label>
                    <select name="alamat_ada" required>
                        <option value="Ya" {{ old('alamat_ada', $data->alamat_ada) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('alamat_ada', $data->alamat_ada) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>d. Nomor Telepon/WA <span>*</span></label>
                    <select name="no_telp_ada" required>
                        <option value="Ya" {{ old('no_telp_ada', $data->no_telp_ada) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('no_telp_ada', $data->no_telp_ada) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>e. Nomor Email <span>*</span></label>
                    <select name="email_ada" required>
                        <option value="Ya" {{ old('email_ada', $data->email_ada) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('email_ada', $data->email_ada) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <h3>2. KESANGGUPAN PEMBAYARAN PELAYANAN PENGUJIAN</h3>

                <div class="form-group">
                    <label>a. Pembayaran Langsung (e-billing) <span>*</span></label>
                    <select name="pembayaran_langsung" required>
                        <option value="Ya" {{ old('pembayaran_langsung', $data->pembayaran_langsung) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('pembayaran_langsung', $data->pembayaran_langsung) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>b. Pembayaran Sebelum Selesai Pengujian (e-billing) <span>*</span></label>
                    <select name="pembayaran_sebelum" required>
                        <option value="Ya" {{ old('pembayaran_sebelum', $data->pembayaran_sebelum) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('pembayaran_sebelum', $data->pembayaran_sebelum) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>c. Harga Pelayanan Pengujian Sesuai <span>*</span></label>
                    <select name="harga_sesuai" required>
                        <option value="Ya" {{ old('harga_sesuai', $data->harga_sesuai) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('harga_sesuai', $data->harga_sesuai) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <h3>3. DATA</h3>

                <div class="form-group">
                    <label>a. Nomor Identitas Nama Penghubung <span>*</span></label>
                    <select name="no_identitas" required>
                        <option value="Ya" {{ old('no_identitas', $data->no_identitas) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('no_identitas', $data->no_identitas) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>b. Nama Pemilik Perusahaan/ Pengguna Jasa <span>*</span></label>
                    <select name="nama_pemilik" required>
                        <option value="Ya" {{ old('nama_pemilik', $data->nama_pemilik) == 'Ya' ? 'selected' : '' }}>Ya</option>
                        <option value="Tidak" {{ old('nama_pemilik', $data->nama_pemilik) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <h3>KESIMPULAN UJI KELAYAKAN</h3>

                <div class="form-group">
                    <label for="kesimpulan">Layak menjadi Pengguna Jasa <span>*</span></label>
                    <select id="kesimpulan" name="kesimpulan" required>
                        <option value="Layak" {{ old('kesimpulan', $data->kesimpulan) == 'Layak' ? 'selected' : '' }}>Layak</option>
                        <option value="Tidak Layak" {{ old('kesimpulan', $data->kesimpulan) == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tim_kepatuhan">Mengetahui Tim Kepatuhan <span>*</span></label>
                    <input type="text" id="tim_kepatuhan" name="tim_kepatuhan" value="{{ old('tim_kepatuhan', $data->tim_kepatuhan) }}" required>
                </div>

                <div class="form-group">
                    <label for="tempat">Kota <span>*</span></label>
                    <input type="text" id="tempat" name="tempat" value="{{ old('tempat', $data->tempat) }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal <span>*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $data->tanggal) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama_pelaksana">Nama Pelaksana Kegiatan BPMSPH <span>*</span></label>
                    <input type="text" id="nama_pelaksana" name="nama_pelaksana" value="{{ old('nama_pelaksana', $data->nama_pelaksana) }}" required>
                </div>

                <div class="form-group">
                    <label for="dokumen">File Upload dokumen KTP/ KTM/Kartu Nama/Surat Permohonan dari Institusi/Universitas/Sekolah, dll</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png">
                        <p>Drag & drop files here or click to select</p>
                        <span>Maksimal Ukuran File 2Mb</span>
                        <div id="filePreview" class="file-preview"></div>
                    </div>
                    @if ($data->dokumen)
                        <p>Dokumen saat ini: <a href="{{ asset('storage/' . $data->dokumen) }}" target="_blank">Lihat Dokumen</a></p>
                    @endif
                </div>

                <div class="btn-send-form">
                    <button type="submit">
                        Update <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
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
            transition: background-color 0.3s ease;
        }
    
        .upload-area:hover {
            background-color: #f8f9fa;
        }
    
        .upload-area input[type="file"] {
            display: none;
        }
    
        .upload-area p {
            margin: 0;
            font-size: 16px;
            color: red
        }
    
        .upload-area span {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: darkred;
        }
    
        .file-preview {
            margin-top: 15px;
        }
    
        .file-preview img {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    
        .file-preview p {
            margin: 5px 0;
            font-size: 14px;
            color: red;
        }
    </style>

    <script>
        // File upload drag and drop functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('dokumen');
        const filePreview = document.getElementById('filePreview');

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
    </script>
@endsection