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
            <form id="reportForm" action="{{ route('lapor-k3.store') }}" method="POST" enctype="multipart/form-data"
                class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf

                <h3>LAPORAN INSIDEN DAN KECELAKAAN</h3>
                <div class="img-form"><img src="assets/pembatas.png" alt=""></div>
                <h3>BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN</h3>

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
                    <label for="reporterSignature">Tanda Tangan Pelapor: <span>*</span></label>
                    <input type="file" id="reporterSignature" name="reporterSignature" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="supervisorSignature">Tanda Tangan Atasan: <span>*</span></label>
                    <input type="file" id="supervisorSignature" name="supervisorSignature" accept="image/*" required>
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
@endsection