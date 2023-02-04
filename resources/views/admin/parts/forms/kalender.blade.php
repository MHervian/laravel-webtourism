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
                        <li class="breadcrumb-item"><a href="{{ route($route_kalender) }}">{{ $title_page_bread }}</a></li>
                        <li class="breadcrumb-item active">{{ $title_page }}</li>
                    </ol>
                    <form action="{{ route($form_action) }}" method="post" enctype="multipart/form-data">
                        <div class="card mb-4">
                            <div class="card-body">
                                @csrf
                                @if (isset($display))
                                @if (isset($detail))
                                <input type="hidden" name="id_kalender_cat" value="{{ $detail->id_kalender_cat }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Kategori Kalender</label>
                                            <input type="text" id="nama" class="form-control" name="nama" value="{{ $detail->nama_cat }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control">{{ $detail->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Kategori Kalender</label>
                                            <input type="text" id="nama" class="form-control" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @else
                                @if (isset($detail))
                                <input type="hidden" name="id_kalender" value="{{ $detail->id_kalender }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Judul Event/Kalender</label>
                                            <input type="text" id="nama" class="form-control" name="nama" value="{{ $detail->judul }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori Kalender</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategori as $kg)
                                                @if ($detail->id_kalender_cat === $kg->id_kalender_cat)
                                                <option value="{{ $kg->id_kalender_cat }}" selected>{{ $kg->nama_cat }}</option>
                                                @else
                                                <option value="{{ $kg->id_kalender_cat }}">{{ $kg->nama_cat }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Konten</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi" style="height: 45rem;">{{ $detail->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Judul Event/Kalender</label>
                                            <input type="text" id="nama" class="form-control" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori Kalender</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategori as $kg)
                                                <option value="{{ $kg->id_kalender_cat }}">{{ $kg->nama_cat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Konten</label>
                                            <textarea name="deskripsi" class="form-control h-100" id="deskripsi" style="height: 45rem;"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @endif
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