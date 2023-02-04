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
                        <li class="breadcrumb-item"><a href="{{ route($route_aktivitas) }}">{{ $title_page_bread }}</a></li>
                        <li class="breadcrumb-item active">{{ $title_page }}</li>
                    </ol>
                    <form action="{{ route($form_action) }}" method="post" enctype="multipart/form-data">
                        <div class="card mb-4">
                            <div class="card-body">
                                @csrf
                                @if (isset($display))
                                @if (isset($detail))
                                <input type="hidden" name="id_dt_cat" value="{{ $detail->id_dt_cat }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Kategori Daya Tarik</label>
                                            <input type="text" id="nama" class="form-control" name="nama" value="{{ $detail->nama_dt }}">
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
                                            <label for="nama" class="form-label">Nama Kategori Daya Tarik</label>
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
                                <input type="hidden" name="id_dt" value="{{ $detail->id_dt }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Aktivitas</label>
                                            <input type="text" id="nama" class="form-control" name="nama" value="{{ $detail->judul }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi">{{ $detail->deskripsi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori Aktivitas</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategori as $kg)
                                                @if ($detail->id_dt_cat === $kg->id_dt_cat)
                                                <option value="{{ $kg->id_dt_cat }}" selected>{{ $kg->nama_dt }}</option>
                                                @else
                                                <option value="{{ $kg->id_dt_cat }}">{{ $kg->nama_dt }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea id="alamat" class="form-control" name="alamat">{{ $detail->alamat }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasi" class="form-label">Lokasi Map</label>
                                            <textarea id="lokasi" class="form-control" name="lokasi">{{ $detail->lokasi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="galeri" class="form-label">Galeri</label>
                                            <input type="file" name="galeri[]" id="galeri" class="form-control" multiple>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Aktivitas</label>
                                            <input type="text" id="nama" class="form-control" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori Aktivitas</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategori as $kg)
                                                <option value="{{ $kg->id_dt_cat }}">{{ $kg->nama_dt }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea id="alamat" class="form-control" name="alamat"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasi" class="form-label">Lokasi Map</label>
                                            <textarea id="lokasi" class="form-control" name="lokasi"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="galeri" class="form-label">Galeri</label>
                                            <input type="file" name="galeri[]" id="galeri" class="form-control" multiple>
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