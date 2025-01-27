<nav class="container-navbar">
    <a href="/">
        <div class="logo">
            <img src="assets/logo smi.png" alt="Logo Image" class="logo-img">
            <h3>SMI BPMSPH</h3>
        </div>
    </a>
    <div id="icon-nav" class="icon-nav">
        <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
    </div>
    <ul id="menu-list" class="hidden">
        <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
        <li class="dropdown">
            <div class="dropdown-i">
                <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Studi Kelayakan</a>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <ul class="dropdown-content">
            <li><a href="/studi-kelayakan" class="{{ request()->is('studi kelayakan') ? 'active' : '' }}">Pengguna Jasa</a></li>
            <li><a href="/penyedia-jasa" class="{{ request()->is('penyedia-jasa') ? 'active' : '' }}">Penyedia Jasa</a></li>
            </ul>
        </li>
        <li><a href="/lapor" class="{{ request()->is('lapor') ? 'active' : '' }}">Lapor</a></li>
        <li class="dropdown">
            <div class="dropdown-i">
                <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Pedoman dan Prosedur SMI</a>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <ul class="dropdown-content">
                <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/pedoman-smi">Pedoman
                        SMI</a></li>
                <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/prosedur-smi">Prosedur
                        SMI</a></li>
                <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/formulir-smi">Formulir
                        SMI</a></li>
                <li><a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi/ikk-smi">IKK</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <div class="dropdown-i">
                <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Agenda Sosialisasi PK</a>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <ul class="dropdown-content">
                <li><a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk/audit-internal">Audit
                        Internal</a></li>
                <li><a href="https://sites.google.com/view/smapbpmsph/agenda-sosialisasi-pk/audit-eksternal">Audit
                        Eksternal</a></li>
                <li><a href="/Pelatihan">Pelatihan</a></li>
                <li><a href="/Survei">Survei</a></li>
                <li><a href="/Rekaman">Rekaman Kegiatan</a></li>
                <li><a href="/Laporan-&-Monev-Dumas">Laporan & Monev Dumas</a></li>
                <li><a href="/Laporan-Benturan">Laporan Benturan Kepentingan</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <div class="dropdown-i">
                <a href="https://sites.google.com/view/smapbpmsph/pedoman-dan-prosedur-mi">Kebijakan dan Sasaran</a>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <ul class="dropdown-content">
                <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/kebijakan">Kebijakan</a>
                </li>
                <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/sasaran">Sasaran</a></li>
                <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/pedoman-dan-prosedur-mi">Pedoman
                        Prosedur & Formulir</a></li>
                <li><a href="https://sites.google.com/view/smapbpmsph/kebijakan-sasaran/struktur">Struktur</a></li>
            </ul>
        </li>
        <li> <a href="https://simin.bpmsph.org/">Login</a>
        </li>
        </li>
        <li> <a href="/web" class="{{ request()->is('web') ? 'active' : '' }}">Web</a>
        </li>
        <li> <a href="/faq" class="{{ request()->is('faq') ? 'active' : '' }}">FAQ</a>
        </li>
    </ul>
</nav>

<!-- icon langsung ke top -->
<i id="scrollToTopBtn" title="Go to top" class="fa-solid fa-circle-up"></i>

