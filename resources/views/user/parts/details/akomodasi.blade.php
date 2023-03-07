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
                        <a href="{{ route('enduser.akomodasi', ['id_akomodasi_cat' => $id_kategori]) }}" class="text-white">Akomodasi {{ $nama_kategori }}</a>
                        <span class="text-white">/</span>
                        <span class="text-white">{{ $detail->judul }}</span>
                    </span>
                    <h1 class="text-white">{{ $detail->judul }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5">
            <div class="row rounded mb-5">
                <div class="col-lg-5">
                    <img src="{{ asset('uploads/akomodasi/' . $detail->thumbnail) }}" class="img-fluid mb-3">
                    <div class="bg-white rounded p-3">
                        {!! $detail->deskripsi !!}
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="bg-white rounded p-3">
                        <h2>Lokasi</h2>
                        <p>{!! $detail->alamat !!}</p>
                        {!! $detail->lokasi !!}
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="text-center">
                    <h2>Galeri Akomodasi</h2>
                </div>
            </div>
            <div class="row">
                @php
                $list_gambar = explode(";", $detail->galeri_src);
                @endphp
                @if (count($list_gambar) > 0)
                @foreach($list_gambar as $gambar)
                <div class="col-lg-4 col-md-6">
                    <img src="{{ asset('uploads/akomodasi/' . $gambar ) }}" class="img-fluid mb-md-4 mb-sm-4 mb-4 mb-lg-4">
                </div>
                @endforeach
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Galeri gambar belum ada.
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