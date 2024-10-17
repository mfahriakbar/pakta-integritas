@extends('layouts.user')

@section('title', 'Studi Kelayakan')

@section('content')

    {{-- loading --}}
    <div id="loader" class="loader-container">
       <div class="spinner"></div>
    </div>

    <!-- bg -->
    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>

    <!-- Main page start -->
    <main class="main-page" id="studi-kelayakan">
        <div class="container-home">
            <div class="home-title">
                <h1>SISTEM STUDI KELAYAKAN</h1>
                <div class="home-content">
                    <div class="home-content-text">
                        <h6>Evaluasi Komprehensif untuk Keberhasilan Proyek</h6>
                        <p>
                            Studi kelayakan adalah analisis mendalam untuk menentukan viabilitas suatu proyek. Jika Anda ingin berpartisipasi dalam proses studi kelayakan, silakan isi formulir sesuai dengan peran Anda.
                        </p>
                        <div class="btn-form">
                            <a href="#isi-form"><button>
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Formulir Studi Kelayakan
                                </button></a>
                        </div>
                    </div>
                    <figure class="home-content-logo">
                        <img src="assets/logo smi.png" alt="logo smi">
                    </figure>
                </div>
            </div>
        </div>

        <!-- Tutor -->
        <div class="tutorial">
            <div class="tutorial-header">
                <h2>CARA MENGISI FORMULIR STUDI KELAYAKAN</h2>
                <br>
                <p>Anda dapat berpartisipasi dalam studi kelayakan dengan cara berikut:</p>
            </div>
            <div class="tutorial-container">
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <h4>Buka Website</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Anda dapat mengakses formulir studi kelayakan di website Sistem Studi Kelayakan</p>
                        </div>
                    </div>
                </div>
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <h4>Memilih Peran</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Pilih peran sesuai dengan posisi Anda dalam proyek (Pengguna atau Penyedia)</p>
                        </div>
                    </div>
                </div>
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                        <h4>Mengisi Formulir</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Isi identitas dan informasi yang diperlukan pada formulir. Pastikan <span class="tutor-4">data diri</span> dan <span class="tutor-4">email</span> yang Anda masukkan sesuai.</p>
                        </div>
                    </div>
                </div>
                <div class="tutorial-main">
                    <div class="tutorial-title-container">
                        <div class="tutorial-icon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <h4>Kirim Formulir</h4>
                        <br>
                        <div class="tutorial-content-container">
                            <p>Setelah mengisi semua informasi yang diperlukan, kirim formulir untuk berpartisipasi dalam studi kelayakan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tutor end -->

        <!-- Role -->
        <div class="role" id="role">
            <div class="role-header">
                <h2>PERAN DALAM STUDI KELAYAKAN</h2>
            </div>
            <div class="role-container">
                <div class="role-main">
                    <div class="role-title-container">
                        <figure class="role-image">
                            <img src="assets/pengguna.png" alt="" onclick="togglePopup('role-popup-1')">
                        </figure>
                        <h4>Pengguna</h4>
                    </div>

                    <div class="role-button-container">
                        <button onclick="togglePopup('role-popup-1')"> Lihat Deskripsi </button>
                    </div>
                </div>

                <div class="role-main">
                    <div class="role-title-container">
                        <figure class="role-image">
                            <img src="assets/penyedia jasa 2.png" alt="" onclick="togglePopup('role-popup-2')">
                        </figure>

                        <h4>Penyedia</h4>
                    </div>

                    <div class="role-button-container">
                        <button onclick="togglePopup('role-popup-2')"> Lihat Deskripsi </button>
                    </div>
                </div>
            </div>
            <div class="role-popup" id="role-popup-1">
                <div class="role-popup-content"></div>
                <div class="role-popup-text">
                  <button class="role-close-btn" onclick="togglePopup('role-popup-1')">
                    <i class="fa-solid fa-circle-xmark"></i>
                  </button>
                  <h3>DESKRIPSI PERAN PENGGUNA</h3>
                  <p>
                    Sebagai pengguna dalam studi kelayakan, Anda memiliki peran penting dalam:
                  </p>
                  <ol>
                    <li>Memberikan informasi tentang kebutuhan dan ekspektasi terhadap proyek</li>
                    <li>Mengevaluasi solusi yang diusulkan dari perspektif pengguna akhir</li>
                    <li>Memberikan masukan tentang fungsionalitas dan fitur yang diinginkan</li>
                    <li>Berpartisipasi dalam pengujian dan evaluasi prototipe atau konsep</li>
                    <li>Membantu mengidentifikasi potensi risiko atau masalah dari sudut pandang pengguna</li>
                  </ol>
                </div>
            </div>
            <div class="role-popup" id="role-popup-2">
                <div class="role-popup-content"></div>
                <div class="role-popup-text">
                  <div class="role-close-btn" onclick="togglePopup('role-popup-2')">
                    <i class="fa-solid fa-circle-xmark"></i>
                  </div>
                  <h3>DESKRIPSI PERAN PENYEDIA</h3>
                  <p>
                    Sebagai penyedia dalam studi kelayakan, Anda memiliki tanggung jawab untuk:
                  </p>
                  <ol>
                    <li>Menyediakan informasi teknis dan spesifikasi terkait solusi yang diusulkan</li>
                    <li>Menganalisis kelayakan teknis dan operasional dari proyek</li>
                    <li>Memberikan estimasi biaya, waktu, dan sumber daya yang diperlukan</li>
                    <li>Mengidentifikasi potensi risiko teknis dan strategi mitigasinya</li>
                    <li>Menyusun rencana implementasi dan pemeliharaan jangka panjang</li>
                  </ol>
                </div>
            </div>
        </div>
        <!-- Role -->

        <!-- isi form -->
        <div class="isi-form" id="isi-form">
            <div class="form-title">
                <h2>ISI FORMULIR</h2>
                <div class="form-content">
                    <div class="form-content-text">
                        <div class="form-content-text-title">
                            <h3>Silahkan memilih Peran yang sesuai:</h3>
                        </div>
                        <div class="form-choice">
                            <p>Pilih Peran</p>
                            <select name="form-role" id="form-role" onchange="showForm()">
                                <option value="null">---Silahkan Pilih---</option>
                                <option value="pengguna">Pengguna Jasa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-content-logo">
                        <img src="assets/beranda.png" alt="">
                    </div>
                </div>

                <!-- Form Container -->
                <form action="{{ route('studi-kelayakan.store') }}" method="POST" id="form-container" class="form-container">
                    @csrf
                    <input type="hidden" name="role" id="hidden-role" value="null">
                    <h3>FORMULIR STUDI KELAYAKAN</h3>
                    <div class="img-form"><img src="assets/pembatas.png" alt=""></div>
                    <h3 id="role-title">{{ $role ?? 'ROLE TITLE' }}</h3>

                    <!-- Form Fields -->
                    <h3>IDENTITAS PENGGUNA JASA</h3>

                    <div class="form-group">
                        <label for="nama_pengguna">Nama Perusahaan/Instansi/Perorangan Pengguna Jasa <span>*</span></label>
                        <input type="text" id="nama_pengguna" name="nama_pengguna" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat <span>*</span></label>
                        <textarea id="alamat" name="alamat" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="hubungan">Hubungan dengan BPMSPH <span>*</span></label>
                        <input type="text" id="hubungan" name="hubungan" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_penghubung">Nama Pegawai Penghubung Pengguna Jasa <span>*</span></label>
                        <input type="text" id="nama_penghubung" name="nama_penghubung" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span>*</span>
                            <small style="color:red;">Pastikan email yang dimasukkan benar karena surat akan dikirim ke
                                email ini.</small>
                        </label>
                        <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                            <small>Contoh: 81234567899</small>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">+62</div>
                            <input type="tel" id="no_telepon" name="no_telepon" class="form-control"
                                placeholder="81234567899" pattern="^\d{8,13}$" required>
                        </div>
                    </div>

                    <h3>1. DATA PENGGUNA JASA</h3>

                    <div class="form-group">
                        <label>a. Nama Perusahaan <span>*</span></label>
                        <select name="nama_perusahaan" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>b. Nama Perorangan <span>*</span></label>
                        <select name="nama_perorangan" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>c. Alamat <span>*</span></label>
                        <select name="alamat_ada" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>d. Nomor Telepon/WA <span>*</span></label>
                        <select name="no_telp_ada" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>e. Nomor Email <span>*</span></label>
                        <select name="email_ada" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <h3>2. KESANGGUPAN PEMBAYARAN PELAYANAN PENGUJIAN</h3>

                    <div class="form-group">
                        <label>a. Pembayaran Langsung (e-billing) <span>*</span></label>
                        <select name="pembayaran_langsung" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>b. Pembayaran Sebelum Selesai Pengujian (e-billing) <span>*</span></label>
                        <select name="pembayaran_sebelum" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>c. Harga Pelayanan Pengujian Sesuai <span>*</span></label>
                        <select name="harga_sesuai" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <h3>3. DATA</h3>

                    <div class="form-group">
                        <label>a. Nomor Identitas Nama Penghubung <span>*</span></label>
                        <select name="no_identitas" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>b. Nama Pemilik Perusahaan/ Pengguna Jasa <span>*</span></label>
                        <select name="nama_pemilik" required>
                            <option value="">Pilih...</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>

                    <h3>KESIMPULAN UJI KELAYAKAN</h3>

                    <div class="form-group">
                        <label for="kesimpulan">Layak menjadi Pengguna Jasa <span>*</span></label>
                        <select id="kesimpulan" name="kesimpulan" required>
                            <option value="">Pilih...</option>
                            <option value="Layak">Layak Menjadi Pengguna Jasa</option>
                            <option value="Tidak Layak">Tidak Layak Menjadi Pengguna Jasa</option>
                            <option value="Perlu Evaluasi">Perlu Evaluasi</option> <!-- New option -->
                        </select>
                    </div>                    

                    <div class="form-group">
                        <label for="tim_kepatuhan">Mengetahui Tim Kepatuhan <span>*</span></label>
                        <input type="text" id="tim_kepatuhan" name="tim_kepatuhan" required>
                    </div>

                    <div class="form-group">
                        <label for="tempat">Kota <span>*</span></label>
                        <input type="text" id="tempat" name="tempat" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal <span>*</span></label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_pelaksana">Nama Pelaksana Kegiatan BPMSPH <span>*</span></label>
                        <input type="text" id="nama_pelaksana" name="nama_pelaksana" required>
                    </div>

                    <div class="form-group">
                        <label for="dokumen">File Upload dokumen KTP/ KTM/Kartu Nama/Surat Permohonan dari Institusi/Universitas/Sekolah, dll <span>*</span></label>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png" required>
                            <p>Drag & drop files here or click to select</p>
                            <span>Maksimal Ukuran File 2Mb</span>
                            <div id="filePreview" class="file-preview"></div>
                        </div>
                    </div>

                    <div class="btn-send-form">
                        <button id="submit-btn" type="submit"> Kirim <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </main>

    <style>
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

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-container');
        const submitBtn = document.querySelector('#submit-btn');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form auto-submit

            // Validate form before submitting
            if (!form.checkValidity()) {
                form.reportValidity(); // Show validation messages if form is invalid
                return;
            }

            // Display confirmation with SweetAlert2
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
                    // Disable submit button to prevent multiple clicks
                    submitBtn.disabled = true;
                    submitBtn.textContent = "Mengirim..."; // Optional: change button text

                    // Send form data using fetch API
                    let formData = new FormData(form);

                    fetch('{{ route('studi-kelayakan.store') }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                title: "Terkirim!",
                                text: data.message,
                                icon: "success",
                                footer: '<a href="https://mail.google.com/">Pergi ke Email?</a>',
                                showConfirmButton: true,
                                timer: 10000
                            }).then(() => {
                                // Re-enable button and reset text after confirmation
                                submitBtn.disabled = false;
                                submitBtn.textContent = "Kirim";
                            });
                            form.reset(); // Reset form after successful submission
                            clearFilePreview(); // Clear file preview after submission
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengirim laporan.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                            submitBtn.disabled = false; // Re-enable button on error
                            submitBtn.textContent = "Kirim"; // Restore button text
                        });
                }
            });
        });

        // Fungsi clear file preview setelah submit
        function clearFilePreview() {
            const filePreview = document.getElementById('filePreview');
            filePreview.innerHTML = '';
            const fileInput = document.getElementById('dokumen');
            fileInput.value = ''; // Reset input file
            document.getElementById('uploadArea').querySelector('span').style.display =
                'inline'; // Tampilkan pesan upload lagi
        }
    });


    // File upload drag and drop functionality
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('dokumen');
    const filePreview = document.getElementById('filePreview');

    uploadArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', handleFiles);

    uploadArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        uploadArea.style.backgroundColor = '#e9ecef';
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
            if (file.size > 2 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal ukuran file adalah 2MB.');
                fileInput.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                const fileType = file.type.split('/')[0];
                if (fileType === 'image') {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    filePreview.appendChild(img);
                } else {
                    const para = document.createElement('p');
                    para.textContent = `File: ${file.name} (${(file.size / 1024).toFixed(2)} KB)`;
                    filePreview.appendChild(para);
                }
            };

            reader.readAsDataURL(file);
        }
    }

    function clearFilePreview() {
        filePreview.innerHTML = '';
        fileInput.value = '';
        uploadArea.querySelector('p').style.display = 'block';
        uploadArea.querySelector('span').style.display = 'block';
    }
</script>

@endsection
