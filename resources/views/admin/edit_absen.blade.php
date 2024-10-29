@extends('layouts.admin')
@section('title', 'Edit Form Absensi Kegiatan')
@section('content')
<header>
    <h1>Edit Formulir Absensi Kegiatan</h1>
</header>
<hr class="header-line">
<div class="isi-form" id="isi-form">
    <form id="attendanceForm" action="{{ route('absen.update', ['id' => $attendance->id]) }}" method="POST" class="form-container" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>FORMULIR ABSENSI KEGIATAN</h3>
        <div class="img-form">
            <img src="{{ asset('assets/pembatas.png') }}" alt="">
        </div>

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

        <!-- Detail Kegiatan -->
        <div class="form-group">
            <label for="activityName">Nama Kegiatan <span>*</span></label>
            <input type="text" id="activityName" name="activityName" value="{{ old('activityName', $attendance->activity_name) }}" required>
        </div>

        <div class="form-group">
            <label for="activityDate">Hari dan Tanggal <span>*</span></label>
            <input type="date" id="activityDate" name="activityDate" value="{{ old('activityDate', $attendance->activity_date) }}" required>
        </div>

        <div class="form-group">
            <label for="responsible">Penanggung Jawab Kegiatan <span>*</span></label>
            <input type="text" id="responsible" name="responsible" value="{{ old('responsible', $attendance->responsible) }}" required>
        </div>

        <div class="form-group">
            <label for="participantCount">Jumlah Peserta/Undangan <span>*</span></label>
            <input type="number" id="participantCount" name="participantCount" value="{{ old('participantCount', $attendance->participant_count) }}" required>
        </div>

        <div class="form-group">
            <label for="accountCode">Kode Akun Kegiatan</label>
            <input type="text" id="accountCode" name="accountCode" value="{{ old('accountCode', $attendance->account_code) }}">
        </div>

        <!-- Term of Reference -->
        <div class="form-group">
            <label for="objective">Deskripsi Tujuan <span>*</span></label>
            <textarea id="objective" name="objective" rows="4" required>{{ old('objective', $attendance->objective) }}</textarea>
        </div>

        <!-- Ringkasan Hasil -->
        <div class="form-group">
            <label for="summary">Ringkasan Hasil Pelaksanaan Kegiatan <span>*</span></label>
            <textarea id="summary" name="summary" rows="4" required>{{ old('summary', $attendance->summary) }}</textarea>
        </div>

        <!-- Daftar Hadir -->
        <h4>Daftar Hadir Peserta</h4>
        <div id="participantList">
            @foreach ($attendance->participants as $index => $participant)
            <div class="participant-entry">
                <div class="form-group">
                    <label>Nama Peserta <span>*</span></label>
                    <input type="text" name="participants[{{ $index }}][name]" value="{{ old('participants.'.$index.'.name', $participant->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Jabatan/Asal Instansi <span>*</span></label>
                    <input type="text" name="participants[{{ $index }}][position]" value="{{ old('participants.'.$index.'.position', $participant->position) }}" required>
                </div>
                <div class="form-group">
                    <label>Nomor Handphone/WhatsApp <span>*</span>
                        <small>Contoh: 81234567899</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">+62</div>
                        <input type="text" 
                               name="participants[{{ $index }}][no_telepon]" 
                               class="form-control phone-input"
                               value="{{ old('participants.'.$index.'.no_telepon', $participant->phone_number) }}"
                               placeholder="81234567899"
                               maxlength="13"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               required>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" id="addParticipant" class="btn-secondary">
            Tambah Peserta <i class="fas fa-plus"></i>
        </button>

        <!-- Submit Button -->
        <div class="btn-send-form">
            <button id="submit-btn" type="submit">
                Update <i class="fa-solid fa-save"></i>
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('attendanceForm');
    const addParticipantBtn = document.getElementById('addParticipant');
    const participantList = document.getElementById('participantList');
    let participantCount = {{ count($attendance->participants) }};

    // Function to validate phone number
    function validatePhoneNumber(input) {
        const value = input.value.replace(/[^0-9]/g, '');
        if (value.length < 8 || value.length > 13) {
            input.setCustomValidity('Nomor telepon harus 8-13 digit');
        } else if (!value.match(/^8/)) {
            input.setCustomValidity('Nomor telepon harus dimulai dengan angka 8');
        } else {
            input.setCustomValidity('');
        }
        input.reportValidity();
    }

    // Add event listener for existing phone inputs
    document.querySelectorAll('.phone-input').forEach(input => {
        input.addEventListener('input', function() {
            validatePhoneNumber(this);
        });
    });

    // Add new participant fields
    addParticipantBtn.addEventListener('click', function() {
        const newEntry = document.createElement('div');
        newEntry.className = 'participant-entry';
        newEntry.innerHTML = `
            <div class="form-group">
                <label>Nama Peserta <span>*</span></label>
                <input type="text" name="participants[${participantCount}][name]" required>
            </div>
            <div class="form-group">
                <label>Jabatan/Asal Instansi <span>*</span></label>
                <input type="text" name="participants[${participantCount}][position]" required>
            </div>
            <div class="form-group">
                <label>Nomor Handphone/WhatsApp <span>*</span>
                    <small>Contoh: 81234567899</small>
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">+62</div>
                    <input type="text" 
                        name="participants[${participantCount}][no_telepon]" 
                        class="form-control phone-input"
                        placeholder="81234567899"
                        maxlength="13"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required>
                </div>
            </div>
            <button type="button" class="remove-participant btn-danger">
                Hapus <i class="fas fa-trash"></i>
            </button>
        `;
        participantList.appendChild(newEntry);
        
        // Add event listener for new phone input
        const newPhoneInput = newEntry.querySelector('.phone-input');
        newPhoneInput.addEventListener('input', function() {
            validatePhoneNumber(this);
        });

        // Add remove functionality to new entry
        newEntry.querySelector('.remove-participant').addEventListener('click', function() {
            newEntry.remove();
        });

        participantCount++;
    });

    // Form submit handler
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Validate all phone numbers before submit
        const phoneInputs = form.querySelectorAll('.phone-input');
        let isValid = true;

        phoneInputs.forEach(input => {
            validatePhoneNumber(input);
            if (input.validity.customError) {
                isValid = false;
            }
        });

        if (!isValid) {
            return;
        }

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
                        text: "Data absensi berhasil disimpan.",
                        icon: "success",
                        showConfirmButton: true
                    }).then(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Update <i class="fa-solid fa-save"></i>';
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
                    submitBtn.innerHTML = 'Update <i class="fa-solid fa-save"></i>';
                });
            }
        });
    });
});
</script>
@endsection