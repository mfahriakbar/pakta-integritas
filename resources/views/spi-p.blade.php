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
            <form id="fkpForm" action="{{ route('spip.submit.user') }}" method="POST" enctype="multipart/form-data"
                class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf
                <h3>Upload File SPI-P</h3>

                <!-- Dropdown Tahun -->
                <div class="form-group">
                    <label for="year">Tahun <span>*</span></label>
                    <select id="year" name="year" required>
                        <option value="">Pilih Tahun</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>

                <!-- Dropdown Pilihan Dokumen 2024 -->
                <div class="form-group" id="documentOptions" style="display: none;">
                    <label for="documentType">Pilih Folder <span>*</span></label>
                    <select id="documentType" name="documentType">
                        <option value="">Pilih Dokumen</option>
                        <option value="MRI">MRI SPIP BPMSPH 2024</option>
                        <option value="SPIP">Laporan SPIP BPMSPH</option>
                        <option value="Renaksi">RENAKSI SPI KPK - BPMSPH Bogor 2024</option>
                    </select>
                </div>

                <div class="form-group" id="additionalDropdowns" style="display: none;">
                    <label>Pilih Folder</label>
                    
                    <div id="riskControlDropdowns">
                        <!-- Dropdown Risk Control -->
                        <select id="riskControlOptions" class="form-control">
                            <option value="DATA RESPONDEN EKSTERNAL">1. DATA RESPONDEN EKSTERNAL</option>
                            <option value="EKSTERNAL">2. EKSTERNAL</option>
                            <option value="INTERNAL">3. INTERNAL</option>
                        </select>
                    </div>

                    <!-- Eksternal Folder Options -->
                    <div id="externalFolders" style="display: none; margin-top: 10px;">
                        <select id="externalFolder" class="form-control">
                            <option value="Digitalisasi Sistem Pelayanan informasi">1. Digitalisasi Sistem Pelayanan informasi</option>
                            <option value="Digitalisasi Sistem Manajemen Integrasi">2. Digitalisasi Sistem Manajemen Integrasi</option>
                            <option value="Sosialisasi medsos, Whatssapp dan Banner">3. Sosialisasi medsos, Whatssapp dan Banner</option>
                            <option value="Penggunaan e Katalog">4. Penggunaan e Katalog</option>
                            <option value="Forum Konsultasi Publik">5. Forum Konsultasi Publik</option>
                            <option value="Pakta Integritas Stakeholder">6. Pakta Integritas Stakeholder</option>
                        </select>
                    </div>

                    <!-- Internal Folder Options -->
                    <div id="internalFolders" style="display: none; margin-top: 10px;">
                        <select id="internalFolder" class="form-control">
                            <option value="Melakukan Sosialisasi">1. Melakukan Sosialisasi</option>
                            <option value="Optimalisasi Semua Sistem Manajemen SNI ISO">2. Optimalisasi Semua Sistem Manajemen SNI ISO</option>
                            <option value="Pembentukan Tim SPI dan Tim Sistem Manajemen SNI ISO">3. Pembentukan Tim SPI dan Tim Sistem Manajemen SNI ISO</option>
                            <option value="Pakta Integritas Pegawai">4. Pakta Integritas Pegawai</option>
                        </select>

                        <!-- Folder options for "Melakukan Sosialisasi" -->
                        <div id="folderMelakukanSosialisasi" style="display: none; margin-top: 10px;">
                            <select class="form-control">
                                <option value="Pemasangan Banner, sosialisasi lewat media sosial, website dan whatsapp">1.1 Pemasangan Banner, sosialisasi lewat media sosial, website dan whatsapp</option>
                                <option value="Penyampaian sosialisasi disetiap rapat triwulan">1.2 Penyampaian sosialisasi disetiap rapat triwulan</option>
                                <option value="Penyampaian Sosialisasi melalui audio speaker">1.3 Penyampaian Sosialisasi melalui audio speaker</option>
                                <option value="Penggunaan atribut anti suap, pungli dan gratifikasi berupa pin oleh setiap pegawai">1.4 Penggunaan atribut anti suap, pungli dan gratifikasi berupa pin oleh setiap pegawai</option>
                            </select>
                        </div>

                        <!-- Folder options for "Optimalisasi Semua Sistem Manajemen SNI ISO" -->
                        <div id="folderOptimalisasiSistem" style="display: none; margin-top: 10px;">
                            <select class="form-control">
                                <option value="Digitalisasi Sistem Manajemen Integrasi">2.1 Digitalisasi Sistem Manajemen Integrasi</option>
                                <option value="Penggunaan e katalog pada pengadaan barang dan jasa">2.2 Penggunaan e katalog pada pengadaan barang dan jasa</option>
                                <option value="Digitalisasi persediaan barang">2.3 Digitalisasi persediaan barang</option>
                                <option value="Pelaksanaan audit internal">2.4 Pelaksanaan audit internal</option>
                                <option value="Pelaksanaan audit Eksternal">2.5 Pelaksanaan audit Eksternal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Dropdown Upload Dokumen Jika Pilihan SPIP atau RiskControl -->
                <div class="form-group" id="uploadOptions" style="display: none;">
                    <label for="additionalDocument">Upload Dokumen <span>*</span></label>
                    <input type="file" id="additionalDocument" name="additionalDocument" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                </div>

                <!-- Text Input Field (Example) -->
                <div class="form-group">
                    <label for="additionalInfo">Lainnya</label>
                    <input type="text" id="additionalInfo" name="additionalInfo" class="form-control" placeholder="Lainnya...">
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
            const yearSelect = document.getElementById('year');
            const documentOptions = document.getElementById('documentOptions');
            const documentTypeSelect = document.getElementById('documentType');
            const uploadOptions = document.getElementById('uploadOptions');
            const submitBtn = document.getElementById('submit-btn');
            const form = document.getElementById('fkpForm');
            const additionalDropdowns = document.getElementById('additionalDropdowns');
            const externalFolders = document.getElementById('externalFolders');
            const internalFolders = document.getElementById('internalFolders');
            const folderMelakukanSosialisasi = document.getElementById('folderMelakukanSosialisasi');
            const folderOptimalisasiSistem = document.getElementById('folderOptimalisasiSistem');

            // Menampilkan atau menyembunyikan opsi dokumen berdasarkan pilihan tahun
            yearSelect.addEventListener('change', function() {
                if (yearSelect.value === '2023') {
                    documentOptions.style.display = 'none'; // Menyembunyikan opsi dokumen
                    uploadOptions.style.display = 'block';  // Menampilkan upload dokumen
                } else {
                    documentOptions.style.display = 'block'; // Menampilkan opsi dokumen untuk 2024
                    uploadOptions.style.display = 'none';  // Menyembunyikan upload dokumen
                    documentTypeSelect.value = ''; // Reset pilihan dokumen
                }
            });

            // Menampilkan atau menyembunyikan opsi upload dokumen berdasarkan pilihan dokumen
            documentTypeSelect.addEventListener('change', function() {
                if (documentTypeSelect.value === 'MRI') {
                    uploadOptions.style.display = 'block';  // Menampilkan upload dokumen
                } else if (documentTypeSelect.value === 'SPIP' || documentTypeSelect.value === 'Renaksi') {
                    uploadOptions.style.display = 'block';  // Menampilkan upload dokumen untuk SPIP atau RiskControl
                } else {
                    uploadOptions.style.display = 'none';   // Menyembunyikan upload dokumen untuk dokumen lainnya
                }

                // Menampilkan dropdown folder jika memilih RiskControl
                if (documentTypeSelect.value === 'Renaksi') {
                    additionalDropdowns.style.display = 'block';
                } else {
                    additionalDropdowns.style.display = 'none';
                }
            });

            // Menampilkan folder berdasarkan pilihan RiskControl
            document.getElementById('riskControlOptions').addEventListener('change', function() {
                const selectedOption = this.value;

                if (selectedOption === 'EKSTERNAL') {
                    externalFolders.style.display = 'block';
                    internalFolders.style.display = 'none';
                } else if (selectedOption === 'INTERNAL') {
                    internalFolders.style.display = 'block';
                    externalFolders.style.display = 'none';
                } else {
                    externalFolders.style.display = 'none';
                    internalFolders.style.display = 'none';
                }
            });

            // Menampilkan folder berdasarkan pilihan internal folder
            internalFolders.addEventListener('change', function() {
                const selectedFolder = internalFolders.querySelector('select').value;

                if (selectedFolder === 'Melakukan Sosialisasi') {
                    folderMelakukanSosialisasi.style.display = 'block';
                    folderOptimalisasiSistem.style.display = 'none';
                } else if (selectedFolder === 'Optimalisasi Semua Sistem Manajemen SNI ISO') {
                    folderOptimalisasiSistem.style.display = 'block';
                    folderMelakukanSosialisasi.style.display = 'none';
                } else {
                    folderMelakukanSosialisasi.style.display = 'none';
                    folderOptimalisasiSistem.style.display = 'none';
                }
            });

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

                        fetch('{{ route('spip.submit.user') }}', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
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
