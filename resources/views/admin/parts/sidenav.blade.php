<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Homepage</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.edithomepage') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Edit Homepage
                </a>
                <div class="sb-sidenav-menu-heading">Travel, Agen, & Wisata</div>
                <a class="nav-link" href="{{ route('admin.paket') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Data Paket
                </a>
                <a class="nav-link" href="{{ route('admin.agen') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Data Agen
                </a>
                <a class="nav-link" href="{{ route('admin.wisata') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Data Destinasi
                </a>
                <a class="nav-link" href="{{ route('admin.aktivitas') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Data Aktivitas/Daya Tarik
                </a>
                <a class="nav-link" href="{{ route('admin.kalender') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Data Kalender/Event
                </a>
                <a class="nav-link" href="{{ route('admin.wisata.kategori') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Kategori Destinasi
                </a>
                <a class="nav-link" href="{{ route('admin.aktivitas.kategori') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Kategori Aktivitas/Daya Tarik
                </a>
                <a class="nav-link" href="{{ route('admin.kalender.kategori') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Kategori Kalender/Event
                </a>
                <div class="sb-sidenav-menu-heading">Data Akomodasi</div>
                <a class="nav-link" href="{{ route('admin.akomodasi') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Data
                </a>
                <a class="nav-link" href="{{ route('admin.akomodasi.kategori') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Kategori
                </a>
                <div class="sb-sidenav-menu-heading">Data Lainnya</div>
                <a class="nav-link" href="{{ route('admin.transportasi') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Transportasi
                </a>
                <a class="nav-link" href="{{ route('admin.emergency') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-circle"></i></div>
                    Kontak Emergency
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ $login_user }}
        </div>
    </nav>
</div>