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
                        <li class="breadcrumb-item"><a href="{{ route('admin.aktivitas') }}">Aktivitas</a></li>
                        <li class="breadcrumb-item active">{{ $detail->judul }}</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            Detail Informasi {{ $detail->judul }}
                            <a href="{{ route('admin.aktivitas.edit', ['id_dt' => $detail->id_dt]) }}" class="btn btn-primary btn-sm ms-2">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <a href="{{ route('admin.aktivitas.delete', ['id_dt' => $detail->id_dt]) }}" class="btn btn-danger btn-sm ms-2">
                                <i class="fas fa-trash"></i>
                                Delete</a>
                        </div>
                        <div class="card-body">
                            <div class="row rounded mb-5">
                                <div class="col-lg-5">
                                    <div class="bg-white rounded p-3">
                                        <img src="{{ asset('uploads/dt/' . $detail->thumbnail) }}" class="img-fluid mb-3">
                                        <h2>Deskripsi Aktivitas/Daya Tarik</h2>
                                        {!! $detail->deskripsi !!}
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="bg-white rounded p-3">
                                        <h2>Lokasi Aktivitas/Daya Tarik</h2>
                                        <p>{{ $detail->alamat }}</p>
                                        {!! $detail->lokasi !!}
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="text-center">
                                    <h2>Galeri Aktivitas/Daya Tarik Wisata</h2>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                $list_gambar = explode(";", $detail->galeri_src);
                                @endphp
                                @foreach($list_gambar as $gambar)
                                <div class="col-lg-4 col-md-6">
                                    <img src="{{ asset('uploads/dt/' . $gambar) }}" class="img-fluid mb-md-4 mb-sm-4 mb-4 mb-lg-4">
                                </div>
                                @endforeach
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