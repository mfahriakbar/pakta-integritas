@extends('layouts.admin')

@section('title', 'Edit Form Konsultasi dan Partisipasi')

@section('content')
    <header>
        <h1>Edit Form Konsultasi dan Partisipasi</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <div class="form-container-wrapper">
            <form action="{{ route('fkp.update', ['id' => $fkpForm->id]) }}" method="POST" class="form-container">
                @csrf
                @method('PUT')

                <h3>FORM KONSULTASI DAN PARTISIPASI</h3>
                <div class="img-form"><img src="{{ asset('assets/pembatas.png') }}" alt=""></div>
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
                    <label for="messageType">Jenis Pesan: <span>*</span></label>
                    <select id="messageType" name="messageType" required>
                        <option value="Konsultasi" {{ old('messageType', $fkpForm->message_type) == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                        <option value="Partisipasi" {{ old('messageType', $fkpForm->message_type) == 'Partisipasi' ? 'selected' : '' }}>Partisipasi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="employeeName">Nama Pegawai: <span>*</span></label>
                    <input type="text" id="employeeName" name="employeeName" value="{{ old('employeeName', $fkpForm->employee_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="employeeId">NIP: <span>*</span></label>
                    <input type="text" id="employeeId" name="employeeId" value="{{ old('employeeId', $fkpForm->employee_id) }}" required>
                </div>

                <div class="form-group">
                    <label for="company">Perusahaan:</label>
                    <input type="text" id="company" name="company" value="{{ old('company', $fkpForm->company) }}">
                </div>

                <div class="form-group">
                    <label for="position">Jabatan: <span>*</span></label>
                    <input type="text" id="position" name="position" value="{{ old('position', $fkpForm->position) }}" required>
                </div>

                <div class="form-group">
                    <label for="department">Bagian: <span>*</span></label>
                    <input type="text" id="department" name="department" value="{{ old('department', $fkpForm->department) }}" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subjek: <span>*</span></label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject', $fkpForm->subject) }}" required>
                </div>

                <div class="form-group">
                    <label for="problemDescription">Deskripsi Masalah: <span>*</span></label>
                    <textarea id="problemDescription" name="problemDescription" rows="4" required>{{ old('problemDescription', $fkpForm->problem_description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="proposedSolution">Solusi yang Diusulkan: <span>*</span></label>
                    <textarea id="proposedSolution" name="proposedSolution" rows="4" required>{{ old('proposedSolution', $fkpForm->proposed_solution) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="reporterEmail">Email Pelapor: <span>*</span></label>
                    <input type="email" id="reporterEmail" name="reporterEmail" value="{{ old('reporterEmail', $fkpForm->reporter_email) }}" required>
                </div>

                <div class="form-group">
                    <label for="notes">Catatan:</label>
                    <textarea id="notes" name="notes" rows="3">{{ old('notes', $fkpForm->notes) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="preparedBy">Dipersiapkan Oleh:</label>
                    <input type="text" id="preparedBy" name="preparedBy" value="{{ old('preparedBy', $fkpForm->prepared_by) }}">
                </div>

                <div class="form-group">
                    <label for="executor">Pelaksana:</label>
                    <input type="text" id="executor" name="executor" value="{{ old('executor', $fkpForm->executor) }}">
                </div>

                <div class="form-group">
                    <label for="secretaryApproval">Persetujuan Sekretaris:</label>
                    <input type="text" id="secretaryApproval" name="secretaryApproval" value="{{ old('secretaryApproval', $fkpForm->secretary_approval) }}">
                </div>

                <div class="form-group">
                    <label for="chairmanApproval">Persetujuan Ketua:</label>
                    <input type="text" id="chairmanApproval" name="chairmanApproval" value="{{ old('chairmanApproval', $fkpForm->chairman_approval) }}">
                </div>

                <div class="btn-send-form">
                    <button type="submit">Update <i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group label span {
            color: red;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-send-form {
            text-align: right;
            margin-top: 20px;
        }

        .btn-send-form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-send-form button:hover {
            background-color: #218838;
        }
    </style>
@endsection