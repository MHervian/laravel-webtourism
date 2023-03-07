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
                        <span class="text-white">Paket Wisata</span>
                    </span>
                    <h1 class="mb-4 text-white">Paket Wisata</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5 cs-acomodation">
            <div class="mb-5">
                <form action="{{ route('enduser.paket.search') }}" method="post" class="bg-light rounded-top p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <select name="id_agen" class="form-control">
                                <option value="">Pilih Agen Wisata..</option>
                                @foreach($agen as $aw)
                                <option value="{{ $aw->id_agen_wisata }}">{{ $aw->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <input type="text" class="form-control" name="nama_paket" placeholder="Input nama paket...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-custom-cta w-100">Cari Paket Wisata</button>
                        </div>
                    </div>
                </form>
            </div>
            <p class="fw-bold">Hasil Pencarian Paket Wisata:</p>
            <div class="row">
                @if (count($paket) > 0)
                @foreach ($paket as $p)
                <a href="{{ route('enduser.paket.detail', ['id_paket' => $p->id_paket]) }}" class="col-md-4 col-lg-3 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-packet">
                    <div>
                        <img src="{{ asset('uploads/paket/' . $p->poster_iklan) }}" class="img-fluid">
                        <div class="p-2 card-packet-price">
                            <p class="m-0">{{ $p->judul }}</p>
                            <span class="mb-3 d-block">Rp {{ number_format($p->harga) }}</span>
                            <span class="d-block cs-text-blue" style="font-size: 16px;">Buka Detail</span>
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