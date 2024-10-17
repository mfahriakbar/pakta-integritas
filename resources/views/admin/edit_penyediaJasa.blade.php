@extends('layouts.admin')

@section('title', 'Edit Studi Kelayakan')

@section('content')
    <header>
        <h1>Edit Studi Kelayakan</h1>
    </header>
    <hr class="header-line">

    <div class="isi-form" id="isi-form">
        <div class="form-container-wrapper">
            <form action="{{ route('penyedia-jasa.update', $data->id) }}" method="POST" enctype="multipart/form-data" id="form-container" class="form-container">
                @csrf
                @method('PUT')

                <h3>FORMULIR EDIT STUDI KELAYAKAN</h3>

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

                <h3>IDENTITAS PENGGUNA JASA</h3>

                <div class="form-group">
                    <label for="nama_rekan">Nama Rekan Bisnis: <span>*</span></label>
                    <input type="text" id="nama_rekan" name="nama_rekan" value="{{ old('nama_rekan', $data->nama_rekan) }}" required>
                </div>
            
                <div class="form-group">
                    <label for="alamat">Alamat: <span>*</span></label>
                    <textarea id="alamat" name="alamat" required>{{ old('alamat', $data->alamat) }}</textarea>
                </div>
            
                <div class="form-group">
                    <label for="hubungan">Hubungan dengan BPMSPH: <span>*</span></label>
                    <input type="text" id="hubungan" name="hubungan" value="{{ old('hubungan', $data->hubungan) }}" required>
                </div>
            
                <div class="form-group">
                    <label for="pegawai_penghubung">Pegawai Penghubung: <span>*</span></label>
                    <input type="text" id="pegawai_penghubung" name="pegawai_penghubung" value="{{ old('pegawai_penghubung', $data->pegawai_penghubung) }}" required>
                </div>
            
                <div class="form-group">
                    <label for="no_whatsapp">Nomor Handphone/WhatsApp <span>*</span>
                        <small>Contoh: 81234567899</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">+62</div>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control" value="{{ old('no_telepon', $data->no_telepon) }}"
                            placeholder="81234567899" pattern="^\d{8,13}$" required>
                    </div>
                </div>
            
                <table>
                    <tr>
                        <th>NO</th>
                        <th>KRITERIA</th>
                        <th>HASIL EVALUASI <span style="color: red">*</span></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Legalitas yang dimiliki</td>
                        <td>
                            <select name="legalitas" required>
                                <option value="">Pilih...</option>
                                <option value="Sesuai" {{ old('legalitas', $data->legalitas) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                <option value="Tidak Sesuai" {{ old('legalitas', $data->legalitas) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kualifikasi rekan bisnis</td>
                        <td>
                            <select name="kualifikasi" required>
                                <option value="">Pilih...</option>
                                <option value="Unit Dagang" {{ old('kualifikasi', $data->kualifikasi) == 'Unit Dagang' ? 'selected' : '' }}>Unit Dagang</option>
                                <option value="CV" {{ old('kualifikasi', $data->kualifikasi) == 'CV' ? 'selected' : '' }}>CV</option>
                                <option value="PT" {{ old('kualifikasi', $data->kualifikasi) == 'PT' ? 'selected' : '' }}>PT</option>
                                <option value="Lainnya" {{ old('kualifikasi', $data->kualifikasi) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sumber daya yang dimiliki rekan bisnis</td>
                        <td>
                            <select name="sumber_daya" required>
                                <option value="">Pilih...</option>
                                <option value="Sesuai" {{ old('sumber_daya', $data->sumber_daya) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                <option value="Tidak Sesuai" {{ old('sumber_daya', $data->sumber_daya) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Apakah rekan bisnis menerapkan sistem manajemen anti penyuapan</td>
                        <td>
                            <select name="anti_penyuapan" required>
                                <option value="">Pilih...</option>
                                <option value="Iya" {{ old('anti_penyuapan', $data->anti_penyuapan) == 'Iya' ? 'selected' : '' }}>Iya</option>
                                <option value="Tidak" {{ old('anti_penyuapan', $data->anti_penyuapan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Apakah rekan bisnis pernah terlibat kasus penyuapan</td>
                        <td>
                            <select name="kasus_penyuapan" required>
                                <option value="">Pilih...</option>
                                <option value="Iya" {{ old('kasus_penyuapan', $data->kasus_penyuapan) == 'Iya' ? 'selected' : '' }}>Iya</option>
                                <option value="Tidak" {{ old('kasus_penyuapan', $data->kasus_penyuapan) == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Mekanisme transaksi dan pembayaran</td>
                        <td><input type="text" id="mekanisme_transaksi" name="mekanisme_transaksi" value="{{ old('mekanisme_transaksi', $data->mekanisme_transaksi) }}" required></td>
                    </tr>
                </table>
    
                <div class="form-group">
                    <label for="nib">Nomor Induk Berusaha (NIB): <span>*</span></label>
                    <input type="text" id="nib" name="nib" value="{{ old('nib', $data->nib) }}" required>
                </div>
            
                <div class="form-group">
                    <label for="kesimpulan">Kesimpulan Uji Kelayakan: <span>*</span></label>
                    <select id="kesimpulan" name="kesimpulan" required>
                        <option value="">Pilih...</option>
                        <option value="Memenuhi Persyaratan" {{ old('kesimpulan', $data->kesimpulan) == 'Memenuhi Persyaratan' ? 'selected' : '' }}>Memenuhi Persyaratan</option>
                        <option value="Tidak Memenuhi Persyaratan" {{ old('kesimpulan', $data->kesimpulan) == 'Tidak Memenuhi Persyaratan' ? 'selected' : '' }}>Tidak Memenuhi Persyaratan</option>
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="tempat">Tempat: <span>*</span></label>
                    <input type="text" id="tempat" name="tempat" value="{{ old('tempat', $data->tempat) }}" required>
                </div>
            
                <div class="form-group">
                    <label for="tanggal">Tanggal: <span>*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $data->tanggal) }}" required>
                </div>
            
                <div class="form-group">
                    <label for="tim_kepatuhan">Tim Kepatuhan: <span>*</span></label>
                    <input type="text" id="tim_kepatuhan" name="tim_kepatuhan" value="{{ old('tim_kepatuhan', $data->tim_kepatuhan) }}" required>
                </div>
            
                <div class="btn-send-form">
                    <button id="submit-btn" type="submit"> Kirim <i class="fa-solid fa-paper-plane"></i>
                    </button>
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
    </style>

@endsection