@extends('layouts.user')

@section('title', 'Form Laporan Insiden dan Kecelakaan K3')

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
            <form id="reportForm" action="{{ route('lapork3.submit.user') }}" method="POST" enctype="multipart/form-data"
                class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf

                <h3>LAPORAN INSIDEN DAN KECELAKAAN</h3>
                <div class="img-form"><img src="assets/pembatas.png" alt=""></div>
                <h3>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h3>
                
                <input type="hidden" name="is_admin" value="false">
                <div class="form-group">
                    <label for="incidentDateTime">Waktu dan Lokasi: <span>*</span></label>
                    <input type="date" id="incidentDate" name="incidentDate" required>
                    <br><br>
                    <input type="time" id="incidentTime" name="incidentTime" required>
                </div>

                <div class="form-group">
                    <label for="location">Lokasi: <span>*</span></label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="department">Bagian: <span>*</span></label>
                    <input type="text" id="department" name="department" required>
                </div>

                <div class="form-group">
                    <label for="incidentType">Tipe Insiden: <span>*</span></label>
                    <select id="incidentType" name="incidentType" required>
                        <option value="">Pilih Tipe Insiden</option>
                        <option value="Kesehatan/Keselamatan">Kesehatan/Keselamatan</option>
                        <option value="Kecelakaan Kerja">Kecelakaan Kerja</option>
                        <option value="Insiden Laboratorium">Insiden Laboratorium</option>
                        <option value="Lingkungan">Lingkungan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="treatment">Penanganan yang Dilakukan: <span>*</span></label>
                    <select id="treatment" name="treatment" required>
                        <option value="">Pilih Penanganan</option>
                        <option value="None/NA">Tidak Ada/Tidak Berlaku</option>
                        <option value="FirstAid">Pertolongan Pertama</option>
                        <option value="MedicalTreatment">Perawatan Medis</option>
                        <option value="HospitalTreatment">Perawatan Rumah Sakit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="repeatedIncident">Apakah Insiden ini Berulang? <span>*</span></label>
                    <select id="repeatedIncident" name="repeatedIncident" required>
                        <option value="">Pilih Jawaban</option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="incidentNumber">Insiden ke-:</label>
                    <input type="number" id="incidentNumber" name="incidentNumber">
                </div>

                <div class="form-group">
                    <label for="potentialAssessment">Asesmen Potensi Terjadinya Insiden yang Sama: <span>*</span></label>
                    <select id="potentialAssessment" name="potentialAssessment" required>
                        <option value="">Pilih Asesmen</option>
                        <option value="Minor">Minor/Low - Cidera Minor/Penyakit atau kerusakan</option>
                        <option value="Moderate">Moderate - Cidera Serius, penyakit atau kerusakan</option>
                        <option value="Major">Major - Cidera Major/Penyakit atau Kerusakan</option>
                        <option value="Critical">Critical - Mengancam Nyawa, Cidera/penyakit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Kejadian: <span>*</span></label>
                    <textarea id="description" name="description" rows="4" required placeholder="Deskripsikan urutan kejadian, siapa yang terlibat, peralatan termasuk detail apa yang terjadi, bagaimana kejadiannya. Jika memungkinkan, ambil foto-foto yang relevan."></textarea>
                </div>

                <div class="form-group">
                    <label for="evidence" class="upload-label">Foto-foto penunjang (bila ada):</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" id="evidence" name="evidence" accept="image/*,application/pdf" hidden>
                        <span>Seret dan lepas file di sini atau <strong>klik untuk memilih file</strong></span>
                        <div id="filePreview" class="file-preview"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="causeAnalysis">Analisa Penyebab: <span>*</span></label>
                    <textarea id="causeAnalysis" name="causeAnalysis" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="immediateActions">Tindakan yang Harus Segera Diambil: <span>*</span></label>
                    <textarea id="immediateActions" name="immediateActions" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="correctiveActions">Tindakan Korektif: <span>*</span></label>
                    <textarea id="correctiveActions" name="correctiveActions" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="reporter">Yang Melaporkan: <span>*</span></label>
                    <input type="text" id="reporter" name="reporter" required>
                    <br><br>
                    <select id="reporterType" name="reporterType" required>
                        <option value="PNS">Pegawai PNS</option>
                        <option value="Kontrak">Pegawai Kontrak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="victims">Penderita Cidera: <span>*</span></label>
                    <textarea id="victims" name="victims" rows="3" required placeholder="Nama, Jabatan, Keterangan Penunjang"></textarea>
                </div>

                <div class="form-group">
                    <label for="witnesses">Saksi-saksi: <span>*</span></label>
                    <textarea id="witnesses" name="witnesses" rows="3" required placeholder="Nama, Jabatan, Keterangan Penunjang"></textarea>
                </div>

                <div class="form-group">
                    <label for="supervisor">Atasan: <span>*</span></label>
                    <input type="text" id="supervisor" name="supervisor" required>
                    <br><br>
                    <select id="supervisorType" name="supervisorType" required>
                        <option value="PNS">Pegawai PNS</option>
                        <option value="Kontrak">Pegawai Kontrak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="no_whatsapp">Nomor Handphone/WhatsApp Pelapor <span>*</span>
                        <small>Contoh: 81234567899</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">+62</div>
                        <input type="tel" id="reporterSignature" name="reporterSignature" class="form-control"
                            placeholder="81234567899" pattern="^\d{8,13}$" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="reporterEmail">Email Pelapor <span>*</span>
                        <small style="color:red;">Pastikan email yang dimasukkan benar.</small>
                    </label>
                    <input type="email" id="reporterEmail" name="reporterEmail" placeholder="example@gmail.com" required>
                </div>

                <div class="form-group">
                    <label for="no_whatsapp">Nomor Handphone/WhatsApp Atasan <span>*</span>
                        <small>Contoh: 81234567899</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">+62</div>
                        <input type="tel" id="supervisorSignature" name="supervisorSignature" class="form-control"
                            placeholder="81234567899" pattern="^\d{8,13}$" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="reportDate">Tanggal Laporan: <span>*</span></label>
                    <input type="date" id="reportDate" name="reportDate" required>
                </div>

                <div class="btn-send-form">
                    <button id="submit-btn" type="submit">Kirim <i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reportForm');
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

                    fetch('{{ route('lapork3.submit.user') }}', {
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

        // Clear file preview after submit
        function clearFilePreview() {
            const filePreview = document.getElementById('filePreview');
            filePreview.innerHTML = '';
            const fileInput = document.getElementById('evidence');
            fileInput.value = ''; // Reset input file
            document.getElementById('uploadArea').querySelector('span').style.display = 'inline'; // Show upload message again
        }
    });

    // File upload drag and drop functionality
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('evidence');
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

    // Handle file preview
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

    // Clear file preview
    function clearFilePreview() {
        filePreview.innerHTML = '';
        fileInput.value = ''; // Reset the file input
        uploadArea.querySelector('span').style.display = 'inline'; // Show the upload message again
    }
    </script>

@endsection