@include('user.parts.header', ['title_page' => $title_page])

<body>
    @include('user.parts.mainnav', ['list_transportasi' => $transportasi, 'list_akomodasi' => $akomodasi])

    <header class="bg-header">
        <div class="container pb-4">
            <div class="row py-5">
                <div class="col-lg-6">
                    <span>
                        <a href="{{ route('enduser.homepage') }}" class="text-white">Beranda</a>
                        <span class="text-white">/</span>
                        <span class="text-white">Aktivitas (Daya Tarik Wisata)</span>
                    </span>
                    <h1 class="mb-4 text-white">Aktivitas (Daya Tarik Wisata)</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5 cs-acomodation">
            <div class="mb-5">
                <form action="{{ route('enduser.dayatarik.search') }}" method="post" class="bg-light rounded-top p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <select name="id_kategori" class="form-control">
                                <option value="">Pilih Kategori Aktivitas..</option>
                                @foreach($dt_cat as $dc)
                                <option value="{{ $dc->id_dt_cat }}">{{ $dc->nama_dt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <input type="text" name="nama_aktivitas" class="form-control" placeholder="Input aktivitas...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-custom-cta w-100">Cari Aktivitas</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                @if (count($dt) > 0)
                @foreach($dt as $d)
                <a href="{{ route('enduser.dayatarik.detail', ['id_dt' => $d->id_dt, 'id_dt_cat' => $d->id_dt_cat]) }}" class="col-lg-3 col-md-4 col-6 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-accomodation">
                    <div>
                        <img src="{{ asset('uploads/dt/' . $d->thumbnail) }}" class="img-fluid">
                        <div class="p-2">
                            <p class="m-0">{{ $d->judul }}</p>
                            <span class="d-block mb-2" style="font-size: 15px;">{{ $d->alamat }}</span>
                            <span style="font-size: 17px; color: blue;">Buka Detail</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Data belum dimuat.
                </div>
                @endif
            </div>
        </div>
    </div>

    <footer class="bg-dark">
        <div class="container py-4">
            <div class="col-md-12 text-center text-white">
                <p class="m-0">&copy;Copyright 2022 Travel &amp; Tourism Bintan Indonesia</p>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ url('src/vendor/jquery/jquery-3.6.1.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ url('src/vendor/bootstrap5/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('app.js') }}"></script>
</body>

</html>