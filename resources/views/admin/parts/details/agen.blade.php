@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $detail->nama }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.agen') }}">Agen Wisata</a></li>
                        <li class="breadcrumb-item active">{{ $detail->nama }}</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            Detail Informasi {{ $detail->nama }}
                            <a href="{{ route('admin.agen.edit', ['id_agen_wisata' => $detail->id_agen_wisata]) }}" class="btn btn-primary btn-sm ms-2">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <a href="{{ route('admin.agen.delete', ['id_agen_wisata' => $detail->id_agen_wisata]) }}" class="btn btn-danger btn-sm ms-2">
                                <i class="fas fa-trash"></i>
                                Delete</a>
                        </div>
                        <div class="row rounded mb-5">
                            <div class="col-lg-5">
                                <div class="bg-white rounded p-3">
                                    <img src="{{ asset('uploads/agen/' . $detail->thumbnail) }}" class="img-fluid mb-3">
                                    <h2>Deskripsi Agen</h2>
                                    {!! $detail->deskripsi !!}
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="bg-white rounded p-3">
                                    <h2>Lokasi Kantor</h2>
                                    <p>{{ $detail->alamat }}</p>
                                    {!! $detail->lokasi !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="p-3">
                            <div class="text-center">
                                <h2>Paket Wisata</h2>
                                <p>Daftar paket wisata yang diadakan oleh agen wisata.</p>
                            </div>
                        </div>
                        <div class="row">
                            @if (count($paket) > 0)
                            @foreach ($paket as $p)
                            <a href="{{ route('admin.paket.detail', ['id_paket' => $p->id_paket]) }}" class="col-lg-3 col-md-4 col-6 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-accomodation">
                                <div>
                                    <img src="{{ asset('uploads/paket/' . $p->poster_iklan) }}" class="img-fluid">
                                    <div class="p-2">
                                        <p class="m-0">{{ $p->judul }}</p>
                                        <span class="d-block mb-2 mt-1">Rp.{{ number_format($p->harga) }}</span>
                                        <span class="cs-text-blue">Buka Detail</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            @else
                            <p class="col-md-12 alert alert-secondary text-center" role="alert">
                                Data paket wisata belum dimuat.
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('admin.parts.footer')
</body>

</html>