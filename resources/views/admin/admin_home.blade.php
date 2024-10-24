@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<header>
    <h1>Selamat Datang, Admin SMI</h1>
</header>
<hr class="header-line">
<div class="cards-admin">
    <div class="card green">
        <h2>Pakta Integritas Pegawai</h2>
        <p>Jumlah</p>
        <a href="{{ route('admin.role', ['role' => 'pegawai']) }}">
            <h3>{{ $countPegawai ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('admin.role', ['role' => 'pegawai']) }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
    <div class="card blue">
        <h2>Pakta Integritas Penyedia Jasa</h2>
        <p>Jumlah</p>
        <a href="{{ route('admin.role', ['role' => 'penyedia-jasa']) }}">
            <h3>{{ $countPenyediaJasa ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('admin.role', ['role' => 'penyedia-jasa']) }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
    <div class="card yellow">
        <h2>Pakta Integritas Pengguna Jasa</h2>
        <p>Jumlah</p>
        <a href="{{ route('admin.role', ['role' => 'pengguna-jasa']) }}">
            <h3>{{ $countPenggunaJasa ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('admin.role', ['role' => 'pengguna-jasa']) }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
    <div class="card red">
        <h2>Pakta Integritas Auditor</h2>
        <p>Jumlah</p>
        <a href="{{ route('admin.role', ['role' => 'auditor']) }}">
            <h3>{{ $countAuditor ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('admin.role', ['role' => 'auditor']) }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
</div>
{{-- card bawah --}}
<div class="cards-admin">
    <div class="card red">
        <h2>Laporan SPG</h2>
        <p>Jumlah</p>
        <a href="{{ route('lapor.index') }}">
            <h3>{{ $countLaporSpg ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('lapor.index') }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
    <div class="card blue">
        <h2>Uji Kelayakan Penyedia Jasa</h2>
        <p>Jumlah</p>
        <a href="{{ route('penyedia-jasa.index') }}">
            <h3>{{ $countPenyediaJasaTotal ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('penyedia-jasa.index') }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
    <div class="card yellow">
        <h2>Uji Kelayakan Pengguna Jasa</h2>
        <p>Jumlah</p>
        <a href="{{ route('studi-kelayakan.index') }}">
            <h3>{{ $countStudiKelayakan ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('studi-kelayakan.index') }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
    <div class="card green">
        <h2>Laporan K3</h2>
        <p>Jumlah</p>
        <a href="{{ route('lapork3.index') }}">
            <h3>{{ $countLaporK3 ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('lapork3.index') }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
</div>
{{-- card bawah nya lagi --}}
<div class="cards-admin">
    <div class="card green">
        <h2>Laporan FKP</h2>
        <p>Jumlah</p>
        <a href="{{ route('fkp.index') }}">
            <h3>{{ $countFkp ?? 0 }}</h3>
        </a>
        <hr>
        <a href="{{ route('fkp.index') }}">
            <p>View Details <i class="fa-solid fa-chevron-right"></i></p>
        </a>
        <img src="{{ asset('assets/icon-note-white.svg') }}" alt="Document Icon">
    </div>
</div>
{{-- ini chart untuk Pakta Integritas --}}
<div class="container-chart" style="margin-bottom: 15px">  
    <div class="card-chart">
        <div class="card-header-chart">
            <i class="fa-solid fa-chart-line"></i>
            <h2>Grafik Surat Masuk Pakta Integritas</h2>
        </div>
        <div class="card-body-chart">
            <!-- Dropdown untuk kategori surat -->
            <div class="form-group-chart">
                <label for="filterSurat">Filter Kategori Surat:</label>
                <select id="filterSurat" class="form-control-chart" onchange="updateChart()">
                    <option value="semua">Keseluruhan</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="penyedia-jasa">Penyedia Jasa</option>
                    <option value="pengguna-jasa">Pengguna Jasa</option>
                    <option value="auditor">Auditor</option>
                </select>
            </div>
            <div class="chart-container-chart">
                <div class="chart-header">
                    <h3><i class="fa fa-chart-area"></i> Grafik Surat Masuk</h3>
                    <!-- Dropdown untuk tahun -->
                    <select id="filterTahun" class="form-control-chart" onchange="updateChart()"></select>
                </div>
                <canvas id="suratMasukChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- ini chart untuk uji kelayakan pengguna dan penyedia --}}
<div class="container-chart" style="margin-bottom: 15px">  
    <div class="card-chart">
        <div class="card-header-chart">
            <i class="fa-solid fa-chart-line"></i>
            <h2>Grafik Surat Masuk Uji Kelayakan</h2>
        </div>
        <div class="card-body-chart">
            <!-- Dropdown untuk kategori surat -->
            <div class="chart-container-chart">
                <div class="chart-header">
                    <h3><i class="fa fa-chart-area"></i> Grafik Surat Masuk</h3>
                    <!-- Dropdown untuk tahun -->
                    <select id="filterTahunUjiKelayakan" class="form-control-chart" onchange="updateUjiKelayakanChart()"></select>
                </div>
                <canvas id="ujiKelayakanChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- ini chart untuk lapor spg --}}
<div class="container-chart" style="margin-bottom: 15px">
    <div class="card-chart">
        <div class="card-header-chart">
            <i class="fa-solid fa-chart-line"></i>
            <h2>Grafik Surat Masuk Laporan SPG</h2>
        </div>
        <div class="card-body-chart">
            <!-- Dropdown untuk kategori surat -->
            <div class="chart-container-chart">
                <div class="chart-header">
                    <h3><i class="fa fa-chart-area"></i> Grafik Surat Masuk</h3>
                    <!-- Dropdown untuk tahun -->
                    <select id="filterTahunSpg" class="form-control-chart" onchange="updateLaporSpgChart()"></select>
                </div>
                <canvas id="laporSpgChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- ini chart untuk lapor k3 --}}
<div class="container-chart" style="margin-bottom: 15px">
    <div class="card-chart">
        <div class="card-header-chart">
            <i class="fa-solid fa-chart-line"></i>
            <h2>Grafik Surat Masuk Laporan K3</h2>
        </div>
        <div class="card-body-chart">
            <!-- Dropdown untuk kategori surat -->
            <div class="chart-container-chart">
                <div class="chart-header">
                    <h3><i class="fa fa-chart-area"></i> Grafik Surat Masuk</h3>
                    <!-- Dropdown untuk tahun -->
                    <select id="filterTahunK3" class="form-control-chart" onchange="updateLaporK3Chart()"></select>
                </div>
                <canvas id="laporK3Chart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
{{-- ini chart untuk fkp --}}
<div class="container-chart" style="margin-bottom: 15px">
    <div class="card-chart">
        <div class="card-header-chart">
            <i class="fa-solid fa-chart-line"></i>
            <h2>Grafik Surat Masuk Laporan FKP</h2>
        </div>
        <div class="card-body-chart">
            <!-- Dropdown untuk kategori surat -->
            <div class="chart-container-chart">
                <div class="chart-header">
                    <h3><i class="fa fa-chart-area"></i> Grafik Surat Masuk</h3>
                    <!-- Dropdown untuk tahun -->
                    <select id="filterTahunFkp" class="form-control-chart" onchange="updateFkpChart()"></select>
                </div>
                <canvas id="fkpChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Passing data dari controller ke JavaScript -->
<script>
    var monthlyData = {!! json_encode(array_values($monthlyData)) !!}; // Data surat keseluruhan
    var monthlyDataPegawai = {!! json_encode(array_values($monthlyDataPegawai)) !!}; // Data Pegawai
    var monthlyDataPenyedia = {!! json_encode(array_values($monthlyDataPenyedia)) !!}; // Data Penyedia Jasa
    var monthlyDataPengguna = {!! json_encode(array_values($monthlyDataPengguna)) !!}; // Data Pengguna Jasa
    var monthlyDataAuditor = {!! json_encode(array_values($monthlyDataAuditor)) !!}; // Data Auditor

    // selain Pakta Integritas
    var monthlyDataStudiKelayakan = {!! json_encode(array_values($monthlyDataStudiKelayakan)) !!}; // Data Studi Kelayakan
    var monthlyDataPenyediaJasa = {!! json_encode(array_values($monthlyDataPenyediaJasa)) !!}; // Data Penyedia Jasa
    var monthlyDataLaporSpg = {!! json_encode(array_values($monthlyDataLaporSpg)) !!}; // Data Lapor Spg
    var monthlyDataLaporK3 = {!! json_encode(array_values($monthlyDataLaporK3)) !!}; // Data Lapor K3
    var monthlyDataFkp = {!! json_encode(array_values($monthlyDataFkp)) !!}; // Data Lapor FKP
</script>

<script src="{{ asset('script/script-admin.js') }}"></script>

@endsection
