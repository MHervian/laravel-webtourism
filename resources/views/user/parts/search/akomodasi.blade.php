@include('user.parts.header', ['title_page' => $title_page])

<body>
    @include('user.parts.mainnav', ['list_transportasi' => $transportasi, 'list_akomodasi' => $akomodasi])

    <header class="bg-header">
        <div class="container pb-4">
            <div class="row py-5">
                <div class="col-lg-8">
                    <span>
                        <a href="#" class="text-white">Beranda</a>
                        <span class="text-white">/</span>
                        <span class="text-white">Pencarian Akomodasi : {{ ($nama_kategori)? $nama_kategori : null }}</span>
                    </span>
                    <h1 class="mb-4 text-white">Pencarian Akomodasi : {{ ($nama_kategori)? $nama_kategori : null }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5 cs-acomodation">
            <div class="mb-5">
                <form action="{{ route('enduser.akomodasi.search') }}" method="post" class="bg-light rounded-top p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <select name="kategori" class="form-control">
                                <option value="">Kategori Akomodasi ...</option>
                                @foreach($kategori_akomodasi as $ka)
                                <option value="{{ $ka->id_akomodasi_cat }}">{{ $ka->nama_cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <input type="text" class="form-control" name="nama_akomodasi" placeholder="Input nama akomodasi ...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-custom-cta w-100">Cari Akomodasi</button>
                        </div>
                    </div>
                </form>
            </div>
            <p>Hasil Proses Pencarian <span class="fw-bold">{{ ($nama_kategori)? "Kategori $nama_kategori" : $search_nama }}</span></p>
            <div class="row">
                @if ( count($list) > 0 )
                @foreach($list as $ls)
                <a href="{{ route('enduser.akomodasi.detail', ['id_akomodasi_cat' => $ls->id_kategori, 'id_akomodasi' => $ls->id_akomodasi, 'kategori' => $nama_kategori]) }}" class="col-lg-3 col-md-4 col-6 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-accomodation">
                    <div>
                        <img src="{{ asset('uploads/akomodasi/' . $ls->thumbnail) }}" class="img-fluid">
                        <div class="p-2">
                            <div class="card-acco-categories mb-2" style="color: grey; font-size: 0.85rem;">
                                Kategori: <span class="text-primary">{{ $ls->nama_cat }}</span>
                            </div>
                            <p class="m-0">{{ $ls->judul }}</p>
                            <span class="d-block mb-2">{{ $ls->alamat }}</span>
                            <span class="cs-text-blue">Buka Detail</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Data akomodasi kategori ini belum ada.
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
</body>

</html>