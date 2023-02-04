@include('user.parts.header', ['title_page' => $title_page])

<body>
    @include('user.parts.mainnav', ['list_transportasi' => $transportasi, 'list_akomodasi' => $akomodasi])

    <header class="bg-header">
        <div class="container">
            <div class="row py-5">
                <div class="col-lg-6">
                    <span>
                        <a href="{{ route('enduser.homepage') }}" class="text-white">Beranda</a>
                        <span class="text-white">/</span>
                        <a href="{{ route('enduser.paket') }}" class="text-white">Paket Wisata</a>
                        <span class="text-white">/</span>
                        <span class="text-white">Detail Paket Wisata</span>
                    </span>
                    <h1 class="text-white">{{ $paket->judul }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5">
            <div class="row rounded mb-5">
                <div class="col-lg-5">
                    <div class="bg-white rounded p-3">
                        <h2>Deskripsi Paket Wisata</h2>
                        {!! $paket->deskripsi !!}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="bg-white rounded p-3">
                        <img src="{{ asset('storage/paket/' . $paket->poster_iklan) }}" class="img-fluid mb-3">
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="text-center">
                    <h2>Paket Destinasi Wisata</h2>
                    <p>Semua destinasi yang dikunjungi nanti dalam paket.</p>
                </div>
            </div>
            <div class="mb-5 pb-4 row">
                @if (false)
                @foreach ($destinasi as $d)
                <a href="{{ route('enduser.petawisata.detail', ['id_wisata' => $d->id_wisata]) }}" class="col-lg-3 col-md-4 col-6 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-accomodation">
                    <div>
                        <img src="{{ asset('storage/wisata/' . $d->thumbnail ) }}" class="img-fluid">
                        <div class="p-2">
                            <p class="m-0">{{ $d->judul }}</p>
                            <span class="d-block mb-2">{{ $d->alamat }}</span>
                            <span class="btn btn-sm btn-custom-cta rounded">Lihat</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif
            </div>
            <hr>
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