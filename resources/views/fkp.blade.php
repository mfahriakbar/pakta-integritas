@extends('layouts.user')

@section('title', 'Form Konsultasi dan Partisipasi K3')

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
        <div class="ContainerSpg">
            <form id="fkpForm" action="{{ route('fkp.submit.user') }}" method="POST" enctype="multipart/form-data"
                class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf
                <h3>Formulir Konsultasi dan Partisipasi K3</h3>

                <div class="header-image">
                    <img src="{{ asset('assets/kop-surat.png') }}" alt="Kop Surat"
                        style="width: 100%; height: auto; display: block; margin: 0 auto;" />
                </div>

                <h3 style="margin-top: 15px">Identitas Pelapor</h3>

                <!-- Jenis Pesan -->
                <div class="form-group">
                    <label for="messageType">Jenis Pesan <span>*</span></label>
                    <select id="messageType" name="messageType" required>
                        <option value="">Pilih Jenis Pesan</option>
                        <option value="Konsultasi">Konsultasi</option>
                        <option value="Partisipasi">Partisipasi</option>
                    </select>
                </div>

                <!-- Nama Pegawai -->
                <div class="form-group">
                    <label for="employeeName">Nama <span>*</span></label>
                    <input type="text" id="employeeName" name="employeeName" required>
                </div>

                <!-- NIP -->
                <div class="form-group">
                    <label for="employeeId">NIP <span>*</span></label>
                    <input type="text" id="employeeId" name="employeeId" required>
                </div>

                <!-- Perusahaan -->
                <div class="form-group">
                    <label for="company">Perusahaan (Jika diluar balai karantina)</label>
                    <input type="text" id="company" name="company">
                </div>

                <!-- Jabatan -->
                <div class="form-group">
                    <label for="position">Jabatan <span>*</span></label>
                    <input type="text" id="position" name="position" required>
                </div>

                <!-- Bagian -->
                <div class="form-group">
                    <label for="department">Bagian <span>*</span></label>
                    <input type="text" id="department" name="department" required>
                </div>

                <h3>Laporan</h3>

                <!-- Judul/Subjek -->
                <div class="form-group">
                    <label for="subject">Judul/Subjek <span>*</span></label>
                    <input type="text" id="subject" name="subject" required>
                </div>

                <!-- Uraian Masalah -->
                <div class="form-group">
                    <label for="problemDescription">Uraian Masalah <span>*</span></label>
                    <textarea id="problemDescription" name="problemDescription" required></textarea>
                </div>

                <!-- Usulan Pemecahan -->
                <div class="form-group">
                    <label for="proposedSolution">Usulan Pemecahan <span>*</span></label>
                    <textarea id="proposedSolution" name="proposedSolution" required></textarea>
                </div>

                <div class="form-group">
                    <label for="reporterEmail">Email<span>*</span>
                        <small style="color:red;">Pastikan email yang dimasukkan benar karena surat akan dikirim ke email
                            ini.</small>
                    </label>
                    <input type="email" id="reporterEmail" name="reporterEmail" placeholder="example@gmail.com" required>
                </div>

                <!-- Submit Button -->
                <div class="btn-send-form">
                    <button id="submit-btn" type="submit">
                        Kirim <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('fkpForm');
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

                        fetch('{{ route('fkp.submit.user') }}', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json(); // Pastikan kita menerima JSON dari server
                        })
                        .then(data => {
                            Swal.fire({
                                title: "Terkirim!",
                                text: data.message,
                                icon: "success",
                                showConfirmButton: true,
                                timer: 5000
                            }).then(() => {
                                submitBtn.disabled = false;
                                submitBtn.textContent = "Kirim";
                            });
                            form.reset();
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat mengirim formulir: ' + error.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                            submitBtn.disabled = false;
                            submitBtn.textContent = "Kirim";
                        });
                    }
                });
            });
        });
    </script>
@endsection