@extends('layouts.admin')
@section('title', 'Tambah Form Konsultasi dan Partisipasi')
@section('content')
    <header>
        <h1>Silahkan Isi Formulir Konsultasi dan Partisipasi</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <form action="{{ route('fkp.submit') }}" method="POST" enctype="multipart/form-data" id="form-container"
            class="form-container">
            @csrf
            <input type="hidden" name="is_admin" value="true">
            
            <h3>FORMULIR KONSULTASI DAN PARTISIPASI</h3>
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

            <div class="form-group">
                <label for="messageType">Jenis Pesan <span>*</span></label>
                <select id="messageType" name="messageType" required>
                    <option value="">Pilih Jenis Pesan</option>
                    <option value="Konsultasi" {{ old('messageType') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                    <option value="Partisipasi" {{ old('messageType') == 'Partisipasi' ? 'selected' : '' }}>Partisipasi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="employeeName">Nama Pegawai <span>*</span></label>
                <input type="text" id="employeeName" name="employeeName" maxlength="100" value="{{ old('employeeName') }}" required>
            </div>

            <div class="form-group">
                <label for="employeeId">ID Pegawai <span>*</span></label>
                <input type="text" id="employeeId" name="employeeId" maxlength="50" value="{{ old('employeeId') }}" required>
            </div>

            <div class="form-group">
                <label for="company">Perusahaan</label>
                <input type="text" id="company" name="company" maxlength="100" value="{{ old('company') }}">
            </div>

            <div class="form-group">
                <label for="position">Jabatan <span>*</span></label>
                <input type="text" id="position" name="position" value="{{ old('position') }}" required>
            </div>

            <div class="form-group">
                <label for="department">Departemen <span>*</span></label>
                <input type="text" id="department" name="department" value="{{ old('department') }}" required>
            </div>

            <div class="form-group">
                <label for="subject">Subjek <span>*</span></label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
            </div>

            <div class="form-group">
                <label for="problemDescription">Deskripsi Masalah <span>*</span></label>
                <textarea id="problemDescription" name="problemDescription" required>{{ old('problemDescription') }}</textarea>
            </div>

            <div class="form-group">
                <label for="proposedSolution">Solusi yang Diusulkan <span>*</span></label>
                <textarea id="proposedSolution" name="proposedSolution" required>{{ old('proposedSolution') }}</textarea>
            </div>

            <div class="form-group">
                <label for="reporterEmail">Email Pelapor <span>*</span></label>
                <input type="email" id="reporterEmail" name="reporterEmail" value="{{ old('reporterEmail') }}"
                    placeholder="example@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="notes">Catatan</label>
                <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
            </div>

            <div class="form-group">
                <label for="preparedBy">Dipersiapkan Oleh</label>
                <input type="text" id="preparedBy" name="preparedBy" maxlength="100" value="{{ old('preparedBy') }}">
            </div>

            <div class="form-group">
                <label for="executor">Pelaksana</label>
                <input type="text" id="executor" name="executor" maxlength="100" value="{{ old('executor') }}">
            </div>

            <div class="form-group">
                <label for="secretaryApproval">Persetujuan Sekretaris</label>
                <input type="text" id="secretaryApproval" name="secretaryApproval" maxlength="100" value="{{ old('secretaryApproval') }}">
            </div>

            <div class="form-group">
                <label for="chairmanApproval">Persetujuan Ketua</label>
                <input type="text" id="chairmanApproval" name="chairmanApproval" maxlength="100" value="{{ old('chairmanApproval') }}">
            </div>

            <div class="btn-send-form">
                <button id="submit-btn" type="submit">
                    Kirim <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
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

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
@endsection