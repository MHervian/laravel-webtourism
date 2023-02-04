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
                        <li class="breadcrumb-item"><a href="{{ route('admin.kalender') }}">Kalender</a></li>
                        <li class="breadcrumb-item active">{{ $detail->judul }}</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            Detail Konten {{ $detail->judul }}
                            <a href="{{ route('admin.kalender.edit', ['id_kalender' => $detail->id_kalender]) }}" class="btn btn-primary btn-sm ms-2">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <a href="{{ route('admin.kalender.delete', ['id_kalender' => $detail->id_kalender]) }}" class="btn btn-danger btn-sm ms-2">
                                <i class="fas fa-trash"></i>
                                Delete</a>
                        </div>
                        <div class="card-body">
                            <div class="row rounded mb-5">
                                <div class="col-lg-7 col-md-8">
                                    <div class="bg-white rounded p-4">
                                        {!! $detail->deskripsi !!}
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-8">
                                    <img src="{{ asset('uploads/kalender/' . $detail->thumbnail) }}" class="img-fluid">
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