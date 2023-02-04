@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $title_page }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.emergency') }}">Emergency</a></li>
                        <li class="breadcrumb-item active">{{ $title_page }}</li>
                    </ol>
                    <form action="{{ $form_action }}" method="post">
                        <div class="card mb-4">
                            <div class="card-body">
                                @csrf
                                @if (isset($detail))
                                <input type="hidden" name="id_emergency" value="{{ $detail->id_emergency }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Darurat/Emergency</label>
                                            <input type="text" id="nama" class="form-control" name="nama" value="{{ $detail->nama }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kontak" class="form-label">No Kontak</label>
                                            <input type="text" id="kontak" class="form-control" name="kontak" value="{{ $detail->no_kontak }}">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Darurat/Emergency</label>
                                            <input type="text" id="nama" class="form-control" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kontak" class="form-label">No Kontak</label>
                                            <input type="text" id="kontak" class="form-control" name="kontak">
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <button type="reset" class="btn btn-secondary">Kosongkan Form</button>
                        <button type="submit" class="btn btn-primary">Proses Data</button>
                    </form>
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