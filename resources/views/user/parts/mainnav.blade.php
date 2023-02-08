<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('enduser.homepage') }}">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- This navigation displays in mobile/small screens -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('enduser.homepage') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour Travel</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('enduser.paket') }}" class="dropdown-item">Paketan Wisata</a></li>
                            <li><a href="{{ route('enduser.agen') }}" class="dropdown-item">Agen Wisata</a></li>
                            <li><a href="{{ route('enduser.petawisata') }}" class="dropdown-item">Peta Wisata</a></li>
                            <li><a href="{{ route('enduser.dayatarik') }}" class="dropdown-item">DTW (Aktivitas)</a></li>
                            <li><a href="{{ route('enduser.kalender') }}" class="dropdown-item">Kalender Event</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Transportasi</a>
                        <ul class="dropdown-menu">
                            @foreach($list_transportasi as $lt)
                            <li><a href="{{ route('enduser.transportasi', ['id_transportasi' => $lt->id_transportasi]) }}" class="dropdown-item">Info {{ $lt->nama }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('enduser.emergency') }}">Emergency</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Akomodasi</a>
                        <ul class="dropdown-menu">
                            @foreach($list_akomodasi as $la)
                            <li><a href="{{ route('enduser.akomodasi', ['id_akomodasi_cat' => $la->id_akomodasi_cat]) }}" class="dropdown-item">
                                    {{ $la->nama_cat }}
                                </a></li>
                            @endforeach
                        </ul>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item">Profil</a></li>
                            <li><a href="#" class="dropdown-item">Badan Hukum</a></li>
                            <li><a href="#" class="dropdown-item">Contact</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</nav>