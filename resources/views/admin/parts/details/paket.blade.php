@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $detail->judul }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.paket') }}">Paket Wisata</a></li>
                        <li class="breadcrumb-item active">{{ $detail->judul }}</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            Detail Informasi Paket
                            <a href="{{ route('admin.paket.edit', ['id_paket' => $detail->id_paket]) }}" class="btn btn-primary btn-sm ms-2">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <a href="{{ route('admin.paket.delete', ['id_paket' => $detail->id_paket]) }}" class="btn btn-danger btn-sm ms-2">
                                <i class="fas fa-trash"></i>
                                Delete</a>
                        </div>
                        <div class="card-body">
                            <div class="row rounded mb-5">
                                <div class="col-lg-5">
                                    <div class="bg-white rounded p-3">
                                        <h2>Deskripsi Paket Wisata</h2>
                                        <h5>{{ $detail->subjudul }}</h5>
                                        <p>Rp.{{ number_format($detail->harga, 0, '.', ',') }}</p>
                                        <p>Durasi Liburan: {{ $detail->durasi }} Hari</p>
                                        {!! $detail->deskripsi !!}
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="bg-white rounded p-3">
                                        <img src="{{ asset('uploads/paket/' . $detail->poster_iklan) }}" class="img-fluid mb-3">
                                    </div>
                                </div>
                            </div>
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