<div class="sidebar-admin">
    <a href="/">
        <div class="logo">
            <img src="{{ asset('assets/logo smi.png') }}" alt="Logo Image" class="logo-img">
            <h3>Sistem Manajemen Integrasi</h3>
        </div>
    </a>
    <a href="/admin/home">
        <div class="box-admin">
            <i class="fa-solid fa-house"></i>
            <h4>Beranda</h4>
        </div>
    </a>
    <br>
    <hr>
    <h5>Menu</h5>
    <!-- Pakta Integritas Dropdown -->
    <div class="dropdown-admin">
        <div class="select-admin">
            <i class="fas fa-file-alt"></i>
            <h4 class="selected">Pakta Integritas</h4>
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <ul class="menu-admin">
            <a href="/admin/pegawai">
                <li>Pegawai</li>
            </a>
            <a href="/admin/penyedia-jasa">
                <li>Penyedia Jasa</li>
            </a>
            <a href="/admin/pengguna-jasa">
                <li>Pengguna Jasa</li>
            </a>
            <a href="/admin/auditor">
                <li>Auditor</li>
            </a>
        </ul>
    </div>
    
    <div class="dropdown-uji-kelayakan">
        <div class="select-uji-kelayakan">
            <i class="fas fa-file-alt"></i>
            <h4 class="selected-uji-kelayakan">Uji Kelayakan</h4>
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <ul class="menu-uji-kelayakan">
            <a href="/admin/penggunaJasa">
                <li>Pengguna Jasa</li>
            </a>
            <a href="/admin/penyediaJasa">
                <li>Penyedia Jasa</li>
            </a>
        </ul>
    </div>

    <div class="dropdown-laporan">
        <div class="select-laporan">
            <i class="fas fa-file-alt"></i>
            <h4 class="selected">Laporan</h4>
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <ul class="menu-laporan">
            <a href="/admin/lapor">
                <li>Lapor Spg</li>
            </a>
            <a href="/admin/k3">
                <li>Lapor K3</li>
            </a>
            <a href="/admin/fkp">
                <li>Lapor FKP</li>
            </a>
            <a href="/admin/benturan">
                <li>Lapor benturan</li>
            </a>
        </ul>
    </div>
    
    <a href="/admin/absen">
        <div class="box-admin-akun">
            <i class="fas fa-file-alt"></i>
            <h4>Absensi</h4>
        </div>
    </a>
    <a href="/admin/dumas">
        <div class="box-admin-akun">
            <i class="fas fa-file-alt"></i>
            <h4>Dumas</h4>
        </div>
    </a>
    <a href="/admin/spip">
        <div class="box-admin-akun">
            <i class="fas fa-file-alt"></i>
            <h4>SPI-P</h4>
        </div>
    </a>
    <a href="{{ route('admin.account') }}">
        <div class="box-admin-akun">
            <i class="fa-solid fa-gear"></i>
            <h4>Pengaturan Akun</h4>
        </div>
    </a>
</div>
