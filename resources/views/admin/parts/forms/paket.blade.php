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
                        <li class="breadcrumb-item"><a href="{{ route('admin.paket') }}">Paket Wisata</a></li>
                        <li class="breadcrumb-item active">{{ $title_page }}</li>
                    </ol>
                    <form action="{{ route($form_action) }}" method="post" enctype="multipart/form-data">
                        <div class="card mb-4">
                            <div class="card-body">
                                @csrf
                                @if (isset($detail))
                                <input type="hidden" name="id_paket" value="{{ $detail->id_paket }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Judul Paket</label>
                                            <input type="text" id="nama" class="form-control" name="nama" value="{{ $detail->judul }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_sub" class="form-label">Subjudul Paket</label>
                                            <input type="text" id="nama_sub" class="form-control" name="nama_sub" value="{{ $detail->subjudul }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga Paket</label>
                                            <input type="text" id="harga" class="form-control" name="harga" value="{{ $detail->harga }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="durasi" class="form-label">Durasi Liburan</label>
                                            <input type="text" id="durasi" class="form-control" name="durasi" value="{{ $detail->durasi }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi">{{ $detail->deskripsi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Agen Wisata</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <option value="">Pilih Agen</option>
                                                @foreach($kategori as $kg)
                                                @if ($detail->id_agen_wisata === $kg->id_agen_wisata)
                                                <option value="{{ $kg->id_agen_wisata }}" selected>{{ $kg->nama }}</option>
                                                @else
                                                <option value="{{ $kg->id_agen_wisata }}">{{ $kg->nama }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Poster Iklan</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Judul Paket</label>
                                            <input type="text" id="nama" class="form-control" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_sub" class="form-label">Subjudul Paket</label>
                                            <input type="text" id="nama_sub" class="form-control" name="nama_sub">
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga Paket</label>
                                            <input type="text" id="harga" class="form-control" name="harga">
                                        </div>
                                        <div class="mb-3">
                                            <label for="durasi" class="form-label">Durasi Liburan</label>
                                            <input type="text" id="durasi" class="form-control" name="durasi">
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Agen Wisata</label>
                                            <select id="kategori" name="kategori" class="form-control">
                                                <option value="">Pilih Agen</option>
                                                @foreach($kategori as $kg)
                                                <option value="{{ $kg->id_agen_wisata }}">{{ $kg->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Poster Iklan</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
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