@extends('layouts.user')

@section('title', 'Form Pengaduan Dumas')

@section('content')
    {{-- loading --}}
    <div id="loader" class="loader-container">
        <div class="spinner"></div>
    </div>

    <!-- Background -->
    <figure class="mybg">
        <img src="assets/kantor.jpg" alt="">
    </figure>

    <div class="isi-form" id="isi-form">
        <div class="ContainerDumas">
            <form id="dumasForm" action="{{ route('dumas.store') }}" method="POST" class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf
                <h3>LAPORAN MONITORING EVALUASI 
                    PENGADUAN MASYARAKAT
                </h3>

                <!-- Month Selection -->
                <div class="form-group">
                    <label for="month">Bulan:</label>
                    <select name="month" id="month" required>
                        <option value="">Pilih Bulan</option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                    </select>
                </div>

                <!-- Table for Complaint Entries -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sarana Pengaduan</th>
                            <th>Jenis Pengaduan </th>
                            <th>Penanganan Pengaduan </th>
                            <th>Keterangan <span style="color: red">*</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kotak Pengaduan / Kotak Saran</td>
                            <td><input type="text" name="complaints[0][type]" ></td>
                            <td><input type="text" name="complaints[0][handling]" ></td>
                            <td>
                                <select name="complaints[0][remarks]" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="Tidak ada pengaduan">Tidak ada pengaduan</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Sedang diproses">Sedang diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Meja Pengaduan</td>
                            <td><input type="text" name="complaints[1][type]" ></td>
                            <td><input type="text" name="complaints[1][handling]" ></td>
                            <td>
                                <select name="complaints[1][remarks]" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="Tidak ada pengaduan">Tidak ada pengaduan</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Sedang diproses">Sedang diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Aplikasi Kaldu Emas (Pengaduan Masyarakat)</td>
                            <td><input type="text" name="complaints[2][type]" ></td>
                            <td><input type="text" name="complaints[2][handling]" ></td>
                            <td>
                                <select name="complaints[2][remarks]" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="Tidak ada pengaduan">Tidak ada pengaduan</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Sedang diproses">Sedang diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Aplikasi Lapor Pengaduan SPG</td>
                            <td><input type="text" name="complaints[3][type]" ></td>
                            <td><input type="text" name="complaints[3][handling]" ></td>
                            <td>
                                <select name="complaints[3][remarks]" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="Tidak ada pengaduan">Tidak ada pengaduan</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Sedang diproses">Sedang diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Aplikasi SP4N LAPOR (Layanan Aspirasi dan Pengaduan Online Rakyat)</td>
                            <td><input type="text" name="complaints[4][type]" ></td>
                            <td><input type="text" name="complaints[4][handling]" ></td>
                            <td>
                                <select name="complaints[4][remarks]" required>
                                    <option value="">Pilih Keterangan</option>
                                    <option value="Tidak ada pengaduan">Tidak ada pengaduan</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Sedang diproses">Sedang diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Submit Button -->
                <div class="btn-send-form">
                    <button id="submit-btn" type="submit">
                        Simpan <i class="fa-solid fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('dumasForm');

            // Form submit handler
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
                    confirmButtonText: "Ya, simpan!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const submitBtn = document.querySelector('#submit-btn');
                        submitBtn.disabled = true;
                        submitBtn.textContent = "Menyimpan...";

                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                title: "Tersimpan!",
                                text: "Pengaduan berhasil disimpan.",
                                icon: "success",
                                showConfirmButton: true
                            }).then(() => {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = 'Simpan <i class="fa-solid fa-save"></i>';
                                form.reset();
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menyimpan data.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Simpan <i class="fa-solid fa-save"></i>';
                        });
                    }
                });
            });
        });
    </script>
@endsection
