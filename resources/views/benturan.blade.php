@extends('layouts.user')

@section('title', 'Form Lapor Benturan Kepentingan')

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
            <form id="reportForm" action="{{ route('benturan.store') }}" method="POST" enctype="multipart/form-data"
                class="form-container" style="display: block; width:100%; margin-top: 10%;">
                @csrf
                <h3>Formulir Laporan Benturan Kepentingan</h3>
                <h3>Berdasarkan Permentan No.7 Tahun 2022</h3>

                <div class="header-image">
                    <img src="{{ asset('assets/kop-surat.png') }}" alt="Kop Surat"
                        style="width: 100%; height: auto; display: block; margin: 0 auto;" />
                </div>

                <!-- Informasi Benturan Kepentingan -->
                <div class="form-section">
                    <h4>Detail Benturan Kepentingan</h4>

                    <div class="form-group">
                        <label for="subjectPosition">Subjek Atau Jabatan <span>*</span></label>
                        <select id="subjectPosition" name="subjectPosition" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Kepala Balai">Kepala Balai</option>
                            <option value="Kepala Sup Bagian Tata Usaha">Kepala Sup Bagian Tata Usaha</option>
                            <option value="Tim Kerja Penyiapan Sampel & Informasi">Tim Kerja Penyiapan Sampel & Informasi</option>
                            <option value="Tim Kerja Pelayanan Teknis">Tim Kerja Pelayanan Teknis</option>
                            <option value="Tim Kerja Pengembangan Metode">Tim Kerja Pengembangan Metode</option>
                            <option value="Pejabat Fungsional Medik Veteriner">Pejabat Fungsional Medik Veteriner</option>
                            <option value="Pejabat Fungsional Paramedik Veteriner">Pejabat Fungsional Paramedik Veteriner</option>
                            <option value="Pejabat Fungsional Pengawas Mutu Hasil Pertanian">Pejabat Fungsional Pengawas Mutu Hasil Pertanian</option>
                            <option value="Pejabat Fungsional Arsiparis">Pejabat Fungsional Arsiparis</option>
                            <option value="Pejabat Pengelola Keuangan">Pejabat Pengelola Keuangan</option>
                            <option value="Pejabat Pembuat Komitmen">Pejabat Pembuat Komitmen</option>
                            <option value="Pejabat Penerima Hasil Pengadaan">Pejabat Penerima Hasil Pengadaan</option>
                            <option value="Fungsional Umum">Fungsional Umum</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <input type="text" id="subjectPositionOther" name="subjectPositionOther" style="display:none; margin-top:10px;" placeholder="Tulis jabatan lain...">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Jenis Kegiatan <span class="text-danger">*</span></label>
                        <br>
                        @php
                            $activityTypes = [
                                'Evaluasi yang tidak  objektif yang dipengaruhi target kinerja Pimpinan',
                                'Proses pengadaan barang dan jasa yang tidak transparan atau profesional yang menguntungkan pihak tertentu',
                                'Penggunaan fasilitas jabatan untuk kepentingan pribadi',
                                'Pejabat Fungsional Auditor (PFA) melaksanakan tugas sebagai pengelola keuangan di unit kerja',
                                'Melaksanakan kegiatan lain di luar tugas pada waktu menjalankan dinas luar',
                                'Melakukan pengawasan tidak sesuai dengan norma, standar dan prosedur',
                                'Rekomendasi dengan dipengaruhi hubungan afiliasi',
                                'Penetapan daerah tujuan perjalanan dinas dan pelaksanaan RDK yang didasarkan kepentingan pribadi/ golongan tanpa ada pertimbangan profesional',
                                'Pembiaran tidak melaksanakan kewajiban tindak lanjut hasil pengawasan'
                            ];
                        @endphp
                    
                        @foreach($activityTypes as $key => $activity)
                            <label style="display: flex; align-items: center;">
                                <input type="checkbox" 
                                       id="activity_{{ $key + 1 }}" 
                                       name="activityType[]" 
                                       value="{{ $activity }}" 
                                       style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                       {{ isset($selectedActivities) && in_array($activity, $selectedActivities) ? 'checked' : '' }}>
                                {{ $activity }}
                            </label>
                            <br>
                        @endforeach
                    
                        <!-- Opsi Lainnya -->
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" 
                                   id="activity_lainnya" 
                                   name="activityType[]" 
                                   value="Lainnya"
                                   style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                   onchange="toggleActivityLainnya(this)">
                            Lainnya
                        </label>
                        <div id="activityLainnyaInput" style="margin-left: 25px; margin-top: 10px; display: none;">
                            <input type="text" 
                                   name="activityType[]" 
                                   class="form-control" 
                                   placeholder="Sebutkan jenis kegiatan lainnya..."
                                   id="activityLainnyaValue"
                                   style="width: 300px;">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Situasi/Kondisi Benturan Kepentingan <span class="text-danger">*</span></label>
                        <br>
                        @php
                            $situationTypes = [
                                'Evaluasi kinerja dilakukan dengan mengutamakan pencapaian target pimpinan, tanpa mempertimbangkan indikator objektif yang relevan dengan kinerja nyata',
                                'Pengadaan barang dan jasa yang menguntungkan pihak tertentu, tidak sesuai dengan prosedur yang transparan dan profesional',
                                'Penggunaan fasilitas yang disediakan untuk kepentingan dinas digunakan untuk kepentingan pribadi, seperti kendaraan dinas atau fasilitas kantor lainnya',
                                'Pejabat Fungsional Auditor juga bertanggung jawab mengelola keuangan, berpotensi menimbulkan benturan kepentingan antara fungsi audit dan pengelolaan',
                                'Pegawai melaksanakan kegiatan pribadi atau tugas lain selain tugas dinas pada saat perjalanan dinas',
                                'Pengawasan yang dilakukan tidak sesuai dengan standar atau prosedur yang berlaku, membuka peluang terjadinya penyimpangan',
                                'Rekomendasi yang diberikan oleh pejabat dipengaruhi oleh hubungan pribadi atau afiliasi dengan pihak yang direkomendasikan',
                                'Penetapan tujuan perjalanan dinas didasarkan pada kepentingan pribadi atau golongan tanpa pertimbangan profesional',
                                'Tindak lanjut terhadap hasil pengawasan yang terabaikan, mengakibatkan masalah yang ditemukan tidak ditangani dengan baik'
                            ];
                        @endphp
                    
                        @foreach($situationTypes as $key => $situation)
                            <label style="display: flex; align-items: center;">
                                <input type="checkbox" 
                                       id="situation_{{ $key + 1 }}" 
                                       name="situation[]" 
                                       value="{{ $situation }}" 
                                       style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                       {{ isset($selectedSituations) && in_array($situation, $selectedSituations) ? 'checked' : '' }}>
                                {{ $situation }}
                            </label>
                            <br>
                        @endforeach
                    
                        <!-- Opsi Lainnya -->
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" 
                                   id="situation_lainnya" 
                                   name="situation[]" 
                                   value="Lainnya"
                                   style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                   onchange="toggleSituationLainnya(this)">
                            Lainnya
                        </label>
                        <div id="situationLainnyaInput" style="margin-left: 25px; margin-top: 10px; display: none;">
                            <input type="text" 
                                   name="situation[]" 
                                   class="form-control" 
                                   placeholder="Sebutkan situasi lainnya..."
                                   id="situationLainnyaValue"
                                   style="width: 300px;">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Penyebab Benturan Kepentingan <span class="text-danger">*</span></label>
                        <br>
                        @php
                            $conflictTypes = [
                                'Gratifikasi',
                                'Kelemahan Sistem',
                                'Hubungan Afiliasi',
                                'Penyalahgunaan Wewenang',
                                'Vested Interest',
                                'Tekanan Politik',
                                'Keterbatasan SDM',
                                'Ketiadaan kode etik'
                            ];
                        @endphp
                    
                        @foreach($conflictTypes as $type)
                            <label style="display: flex; align-items: center;">
                                <input type="checkbox" 
                                       name="conflictType[]" 
                                       value="{{ $type }}" 
                                       style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                       {{ isset($selectedTypes) && in_array($type, $selectedTypes) ? 'checked' : '' }}>
                                {{ $type }}
                            </label>
                            <br>
                        @endforeach
                    
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" 
                                   name="conflictType[]" 
                                   value="Lainnya" 
                                   id="lainnyaCheckbox"
                                   style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                   onchange="toggleLainnya(this)">
                            Lainnya
                        </label>
                        <div id="lainnyaInput" style="margin-left: 25px; margin-top: 10px; display: none;">
                            <input type="text" 
                                   name="conflictType[]" 
                                   class="form-control" 
                                   placeholder="Sebutkan penyebab lainnya..."
                                   id="lainnyaValue"
                                   style="width: 300px;">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Penyempurnaan Aturan dan Penanganan <span class="text-danger">*</span></label>
                        <br>
                        @php
                            $penangananTypes = [
                                'Keteladanan Pimpinan',
                                'Meningkatkan kualitas Quality Assurance',
                                'Pengadaan B/J sesuai ketentuan',
                                'Mendorong Pejabat yang mempunyai benturan kepentingan untuk menyatakan ketidakindependensiannya',
                                'probity audit',
                                'Pemberian sanksi yang tegas terhadap pelanggaran dalamrangka menimbulkan efek jera',
                                'Pemutakhiran SOP pemanfaatan asset',
                                'Program diklat SDM pengelolaan keuangan (optimalisasi kapasitas SDM unit kerja ybs)',
                                'Pemisahan fungsi antara PFA yg ditugaskan sbg pengelola keuangan dgn auditor yg mengaudit keuangan unit kerja ybs',
                                'Menyempurnakan kode etik yg mengatur outside employment',
                                'Internalisasi kode etik dan aturan perilaku pegawai',
                                'Deklarasi PFA adanya potensi benturan kepentingan karena pertemanan',
                                'Piagam Audit (Audit Charter)',
                                'Perencanaan Perjalanan Dinas dan RDK yang Akuntabel',
                                'Penyempurnaan aturan dan SOP pengawasan tindak lanjut hasil pengawasan',
                                'Internalisasi Nilai-Nilai Organisasi',
                                'Menciptakan keteladanan, budaya komunikasi terbuka dan penegakan integritas'
                            ];
                        @endphp
                    
                        @foreach($penangananTypes as $key => $type)
                            <label style="display: flex; align-items: center;">
                                <input type="checkbox" 
                                       id="penanganan_{{ $key + 1 }}" 
                                       name="penanganan[]" 
                                       value="{{ $type }}" 
                                       style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                       {{ isset($selectedPenanganan) && in_array($type, $selectedPenanganan) ? 'checked' : '' }}>
                                <p>{{ $type }}</p>
                            </label>
                            <br>
                        @endforeach
                    
                        <!-- Opsi Lainnya -->
                        <label style="display: flex; align-items: center;">
                            <input type="checkbox" 
                                   id="penanganan_lainnya" 
                                   name="penanganan[]" 
                                   value="Lainnya"
                                   style="width: auto; margin-right: 8px; transform: scale(1.3);"
                                   onchange="togglePenangananLainnya(this)">
                            <p>Lainnya</p>
                        </label>
                        <div id="penangananLainnyaInput" style="margin-left: 25px; margin-top: 10px; display: none;">
                            <input type="text" 
                                   name="penanganan[]" 
                                   class="form-control" 
                                   placeholder="Sebutkan penanganan lainnya..."
                                   id="penangananLainnyaValue"
                                   style="width: 300px;">
                        </div>
                    </div>

                    <hr>

                    <!-- Bulan dan Tahun -->
                    <div class="form-group">
                        <label for="reportMonth">Bulan <span>*</span></label>
                        <select id="reportMonth" name="reportMonth" required>
                            <option value="">Pilih Bulan</option>
                            <option value="January">Januari</option>
                            <option value="February">Februari</option>
                            <option value="March">Maret</option>
                            <option value="April">April</option>
                            <option value="May">Mei</option>
                            <option value="June">Juni</option>
                            <option value="July">Juli</option>
                            <option value="August">Agustus</option>
                            <option value="September">September</option>
                            <option value="October">Oktober</option>
                            <option value="November">November</option>
                            <option value="December">Desember</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="reportYear">Tahun <span>*</span></label>
                        <input type="number" id="reportYear" name="reportYear" required placeholder="Tahun" min="2000" max="2100">
                    </div>

                    <hr>

                    <!-- Hasil Laporan -->
                    <div class="form-group">
                        <label for="reportOutcome">Hasil Laporan <span>*</span></label>
                        <select id="reportOutcome" name="reportOutcome" required>
                            <option value="">Pilih Hasil Laporan</option>
                            <option value="Nihil">Nihil</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>                        
                        <input type="text" id="reportOutcomeOther" name="reportOutcomeOther" style="display:none; margin-top:10px;" placeholder="Tulis hasil laporan lainnya...">
                    </div>

                    <hr>

                <!-- Pernyataan -->
                <div class="form-group">
                    <label style="display: flex; align-items: center;">
                        <input type="checkbox" id="declaration" name="declaration" required 
                               style="width: auto; margin-right: 8px; transform: scale(1.3);">
                        <p>Saya menyatakan bahwa informasi yang saya berikan di atas adalah benar. <span>*</span></p>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="btn-send-form">
                    <button id="submit-btn" type="submit">
                        Kirim Laporan <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectPositionSelect = document.getElementById('subjectPosition');
            const subjectPositionOtherInput = document.getElementById('subjectPositionOther');
            const reportOutcomeSelect = document.getElementById('reportOutcome');
            const reportOutcomeOtherInput = document.getElementById('reportOutcomeOther');
            
            subjectPositionSelect.addEventListener('change', function() {
                if (subjectPositionSelect.value === 'Lainnya') {
                    subjectPositionOtherInput.style.display = 'block';
                } else {
                    subjectPositionOtherInput.style.display = 'none';
                    subjectPositionOtherInput.value = ''; // Clear input if not "Lainnya"
                }
            });

            reportOutcomeSelect.addEventListener('change', function() {
                if (reportOutcomeSelect.value === 'Lainnya') {
                    reportOutcomeOtherInput.style.display = 'block';
                } else {
                    reportOutcomeOtherInput.style.display = 'none';
                    reportOutcomeOtherInput.value = ''; // Clear input if not "Lainnya"
                }
            });

            const form = document.getElementById('reportForm');
            const submitBtn = document.querySelector('#submit-btn');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                // Validate checkboxes
                const requiredCheckboxGroups = [
                    {name: 'activityType[]', message: 'Pilih minimal satu jenis kegiatan'},
                    {name: 'situation[]', message: 'Pilih minimal satu situasi'},
                    {name: 'conflictType[]', message: 'Pilih minimal satu penyebab benturan'},
                    {name: 'penanganan[]', message: 'Pilih minimal satu penanganan'}
                ];

                for (const group of requiredCheckboxGroups) {
                    const checkedBoxes = document.querySelectorAll(`input[name="${group.name}"]:checked`);
                    if (checkedBoxes.length === 0) {
                        Swal.fire({
                            title: "Error!",
                            text: group.message,
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                        return;
                    }
                }

                // Collect form data
                const formData = new FormData(form);

                Swal.fire({
                    title: "Konfirmasi Pengiriman",
                    text: "Apakah Anda yakin data yang dimasukkan sudah benar?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, kirim!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const submitBtn = document.querySelector('#submit-btn');
                        submitBtn.disabled = true;
                        submitBtn.textContent = "Mengirim...";

                        fetch('{{ route('benturan.store') }}', {
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
                                title: "Berhasil!",
                                text: "Laporan benturan kepentingan telah berhasil dikirim",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                form.reset();
                                submitBtn.disabled = false;
                                submitBtn.textContent = "Kirim Laporan";
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: "Error!",
                                text: "Terjadi kesalahan saat mengirim laporan",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                            submitBtn.disabled = false;
                            submitBtn.textContent = "Kirim Laporan";
                        });
                    }
                });
            });
        });

        function toggleLainnya(checkbox) {
    const lainnyaInput = document.getElementById('lainnyaInput');
    const lainnyaValue = document.getElementById('lainnyaValue');
    
    if (checkbox.checked) {
        lainnyaInput.style.display = 'block';
        lainnyaValue.required = true;
    } else {
        lainnyaInput.style.display = 'none';
        lainnyaValue.required = false;
        lainnyaValue.value = ''; // Reset nilai input
    }
}

// Jika ada old input, check lainnya jika diperlukan
document.addEventListener('DOMContentLoaded', function() {
    const lainnyaCheckbox = document.getElementById('lainnyaCheckbox');
    const lainnyaValue = document.getElementById('lainnyaValue');
    
    if (lainnyaValue.value) {
        lainnyaCheckbox.checked = true;
        toggleLainnya(lainnyaCheckbox);
    }
});

function togglePenangananLainnya(checkbox) {
    const lainnyaInput = document.getElementById('penangananLainnyaInput');
    const lainnyaValue = document.getElementById('penangananLainnyaValue');
    
    if (checkbox.checked) {
        lainnyaInput.style.display = 'block';
        lainnyaValue.required = true;
    } else {
        lainnyaInput.style.display = 'none';
        lainnyaValue.required = false;
        lainnyaValue.value = '';
    }
}

// Jika ada old input, check lainnya jika diperlukan
document.addEventListener('DOMContentLoaded', function() {
    const lainnyaCheckbox = document.getElementById('penanganan_lainnya');
    const lainnyaValue = document.getElementById('penangananLainnyaValue');
    
    if (lainnyaValue.value) {
        lainnyaCheckbox.checked = true;
        togglePenangananLainnya(lainnyaCheckbox);
    }
});

function toggleSituationLainnya(checkbox) {
    const lainnyaInput = document.getElementById('situationLainnyaInput');
    const lainnyaValue = document.getElementById('situationLainnyaValue');
    
    if (checkbox.checked) {
        lainnyaInput.style.display = 'block';
        lainnyaValue.required = true;
    } else {
        lainnyaInput.style.display = 'none';
        lainnyaValue.required = false;
        lainnyaValue.value = '';
    }
}

// Jika ada old input, check lainnya jika diperlukan
document.addEventListener('DOMContentLoaded', function() {
    const lainnyaCheckbox = document.getElementById('situation_lainnya');
    const lainnyaValue = document.getElementById('situationLainnyaValue');
    
    if (lainnyaValue.value) {
        lainnyaCheckbox.checked = true;
        toggleSituationLainnya(lainnyaCheckbox);
    }
});

function toggleActivityLainnya(checkbox) {
    const lainnyaInput = document.getElementById('activityLainnyaInput');
    const lainnyaValue = document.getElementById('activityLainnyaValue');
    
    if (checkbox.checked) {
        lainnyaInput.style.display = 'block';
        lainnyaValue.required = true;
    } else {
        lainnyaInput.style.display = 'none';
        lainnyaValue.required = false;
        lainnyaValue.value = '';
    }
}

// Jika ada old input, check lainnya jika diperlukan
document.addEventListener('DOMContentLoaded', function() {
    const lainnyaCheckbox = document.getElementById('activity_lainnya');
    const lainnyaValue = document.getElementById('activityLainnyaValue');
    
    if (lainnyaValue.value) {
        lainnyaCheckbox.checked = true;
        toggleActivityLainnya(lainnyaCheckbox);
    }
});
    </script>

    <style>
        .form-section {
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .form-section h4 {
            margin-bottom: 1rem;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 0.5rem;
        }
    </style>
@endsection
