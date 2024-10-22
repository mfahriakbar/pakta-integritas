@extends('layouts.admin')
@section('title', 'Tambah Laporan K3')
@section('content')
    <header>
        <h1>Form Laporan Insiden dan Kecelakaan K3</h1>
    </header>
    <hr class="header-line">
    <div class="isi-form" id="isi-form">
        <form action="{{ route('lapork3.submit') }}" method="POST" enctype="multipart/form-data" id="form-container" class="form-container">
            @csrf
            <input type="hidden" name="is_admin" value="true">
            <h3>LAPORAN INSIDEN DAN KECELAKAAN</h3>
            <div class="img-form">
                <img src="{{ asset('assets/pembatas.png') }}" alt="">
            </div>
            <h3>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h3>

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
                <label for="incidentDateTime">Waktu dan Lokasi: <span>*</span></label>
                <input type="date" id="incidentDate" name="incidentDate" required>
                <input type="time" id="incidentTime" name="incidentTime" style="margin-top: 15px" required>
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
                <select id="reporterType" name="reporterType" style="margin-top: 15px" required>
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
                <select id="supervisorType" name="supervisorType" style="margin-top: 15px" required>
                    <option value="PNS">Pegawai PNS</option>
                    <option value="Kontrak">Pegawai Kontrak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="reporterSignature">Nomor Handphone/WhatsApp Pelapor <span>*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="tel" id="reporterSignature" name="reporterSignature" class="form-control" placeholder="81234567899" pattern="^\d{8,13}$" required>
                </div>
            </div>

            <div class="form-group">
                <label for="reporterEmail">Email Pelapor <span>*</span></label>
                <input type="email" id="reporterEmail" name="reporterEmail" placeholder="example@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="supervisorSignature">Nomor Handphone/WhatsApp Atasan <span>*</span></label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="tel" id="supervisorSignature" name="supervisorSignature" class="form-control" placeholder="81234567899" pattern="^\d{8,13}$" required>
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

    <script>
        // Handle file upload preview
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