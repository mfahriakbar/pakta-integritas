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
                                <option value="penyedia">Penyedia Jasa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-content-logo">
                        <img src="assets/beranda.png" alt="">
                    </div>
                </div>

                <!-- Form Container -->
                <form action="{{ route('penyedia-jasa.store') }}" method="POST" id="form-container" class="form-container">
                    @csrf
                    <input type="hidden" name="role" id="hidden-role" value="null">
                    <h3>FORMULIR STUDI KELAYAKAN</h3>
                    <div class="img-form"><img src="assets/pembatas.png" alt=""></div>
                    <h3 id="role-title">{{ $role ?? 'ROLE TITLE' }}</h3>
                
                    <!-- Form Fields -->
                    <h3>Form Uji Kelayakan Rekan Bisnis</h3>
                
                    <div class="form-group">
                        <label for="nama_rekan">Nama Rekan Bisnis: <span>*</span></label>
                        <input type="text" id="nama_rekan" name="nama_rekan" required>
                    </div>
                
                    <div class="form-group">
                        <label for="alamat">Alamat: <span>*</span></label>
                        <textarea id="alamat" name="alamat" required></textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="hubungan">Hubungan dengan BPMSPH: <span>*</span></label>
                        <input type="text" id="hubungan" name="hubungan" required>
                    </div>
                
                    <div class="form-group">
                        <label for="pegawai_penghubung">Pegawai Penghubung: <span>*</span></label>
                        <input type="text" id="pegawai_penghubung" name="pegawai_penghubung" required>
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
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kualifikasi rekan bisnis</td>
                            <td>
                                <select name="kualifikasi" required>
                                    <option value="">Pilih...</option>
                                    <option value="Unit Dagang">Unit Dagang</option>
                                    <option value="CV">CV</option>
                                    <option value="PT">PT</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Sumber daya yang dimiliki rekan bisnis</td>
                            <td>
                                <select name="sumber_daya" required>
                                    <option value="">Pilih...</option>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Apakah rekan bisnis menerapkan sistem manajemen anti penyuapan</td>
                            <td>
                                <select name="anti_penyuapan" required>
                                    <option value="">Pilih...</option>
                                    <option value="Iya">Iya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Apakah rekan bisnis pernah terlibat kasus penyuapan</td>
                            <td>
                                <select name="kasus_penyuapan" required>
                                    <option value="">Pilih...</option>
                                    <option value="Iya">Iya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Mekanisme transaksi dan pembayaran</td>
                            <td><input type="text" id="mekanisme_transaksi" name="mekanisme_transaksi" required></td>
                        </tr>
                    </table>

                    <div class="form-group">
                        <label for="nib">Nomor Induk Berusaha (NIB): <span>*</span></label>
                        <input type="text" id="nib" name="nib" required>
                    </div>
                
                    <div class="form-group">
                        <label for="kesimpulan">Kesimpulan Uji Kelayakan: <span>*</span></label>
                        <select id="kesimpulan" name="kesimpulan" required>
                            <option value="">Pilih...</option>
                            <option value="Memenuhi Persyaratan">Memenuhi Persyaratan</option>
                            <option value="Tidak Memenuhi Persyaratan">Tidak Memenuhi Persyaratan</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="tempat">Tempat: <span>*</span></label>
                        <input type="text" id="tempat" name="tempat" required>
                    </div>
                
                    <div class="form-group">
                        <label for="tanggal">Tanggal: <span>*</span></label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>
                
                    <div class="form-group">
                        <label for="tim_kepatuhan">Tim Kepatuhan: <span>*</span></label>
                        <input type="text" id="tim_kepatuhan" name="tim_kepatuhan" required>
                    </div>
                
                    <div class="btn-send-form">
                        <button id="submit-btn" type="submit"> Kirim <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>                                
            </div>
        </div>
    </main>

<!-- JavaScript -->
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
            text: "Pastikan data yang Anda masukkan sudah benar!",
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
