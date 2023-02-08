@include('user.parts.header', ['title_page' => $title_page])

<body>
    @include('user.parts.mainnav', ['list_transportasi' => $transportasi, 'list_akomodasi' => $akomodasi])
    <header class="bg-header">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-lg-8 py-5">
                    <h1 class="mb-4 text-white">{{ $homepage->main_title }}</h1>
                    <p class="text-white">
                    {{ $homepage->desc_main }}
                    </p>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5">
            <div class="row">
                @if (count($paket) > 0)
                <div class="col-md-12 col-lg-3 order-lg-1 mb-md-4 mb-sm-4 mb-4 mb-lg-0">
                    <h2>{{ $homepage->title_paket }}</h2>
                    <p>
                        {{ $homepage->desc_paket }}
                    </p>
                    <a href="{{ route('enduser.paket') }}" class="btn btn-lg btn-custom-cta">Lihat Semua Paket</a>
                </div>
                <div class="col-md-12 col-lg-9 mb-md-4 mb-sm-4 mb-4 mb-lg-0 row">
                    @foreach($paket as $p)
                    <a href="{{ route('enduser.paket.detail', ['id_paket' => $p->id_paket]) }}" class="col-md-4 col-lg-4 card-packet mb-sm-4 mb-4 mb-lg-0">
                        <div>
                            <img src="{{ asset('uploads/paket/' . $p->poster_iklan)}}" class="img-fluid">
                            <div class="p-3 card-packet-price">
                                <p>{{ $p->judul }}</p>
                                <span>Rp {{ number_format($p->harga) }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <p class="text-center" style="font-size: 3rem;">Coming Soon!</p>
                <p class="text-center">Paket Liburan ke Bintan</p>
                @endif
            </div>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="text-center mb-3">{{ $homepage->title_peta }}</h2>
        <p class="text-center mb-5 pb-5 cs-map">{{ $homepage->desc_peta }}</p>
        <div class="row align-items-center pt-4 pb-5 mb-5">
            <div class="col-lg-4">
                @foreach($peta_wisata as $pw)
                <a href="{{ route('enduser.petawisata.detail', ['id_wisata' => $pw->id_wisata]) }}" class="rounded border p-2 mb-3 d-flex align-items-center cs-card-wisata">
                    <div class="w-50">
                        <img src="{{ asset('uploads/wisata/' . $pw->thumbnail) }}" class="img-fluid">
                    </div>
                    <div class="w-75 p-2">
                        <span class="d-block">{{ $pw->judul }}</span>
                        <span class="d-block">{{ $pw->alamat }}</span>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="col-lg-8">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid" style="width: 100%; height: 600px;" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <hr>
    </div>

    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-md-6 order-lg-1 order-md-1 mb-md-4 mb-sm-4 mb-4 mb-lg-0">
                <h2 class="mb-2">{{ $homepage->title_daya_tarik }}</h2>
                <p>{{ $homepage->desc_daya_tarik }}</p>
                <a href="{{ route('enduser.dayatarik') }}" class="btn btn-custom-cta">
                    Lihat Daya Tarik Wisata
                </a>
            </div>
            <div class="col-md-6">
                <img src="src/images/pulau-bintan.png" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-md-6 mb-md-4 mb-sm-4 mb-4 mb-lg-0">
                <h2 class="mb-2">{{ $homepage->title_transportasi }}</h2>
                <p>{{ $homepage->desc_transportasi }}</p>
                @foreach($transportasi as $tr)
                <a href="{{ route('enduser.transportasi', ['id_transportasi' => $tr->id_transportasi]) }}" class="btn btn-custom-cta mb-4">Info {{ $tr->nama }}</a>
                @endforeach
            </div>
            <div class="col-md-6">
                <img src="src/images/PngItem_3024347.png" class="img-fluid">
            </div>
        </div>
        <hr>
    </div>

    <div class="container mt-5">
        <div class="row mt-5 pt-5 pb-3">
            <div class="text-center">
                <h2>{{ $homepage->title_akomodasi }}</h2>
                <p>{{ $homepage->desc_akomodasi }}</p>
            </div>
        </div>
    </div>
    <div class="back-grey">
        <div class="container">
            <div class="row pt-5 pb-5">
                @if (count($akomodasi) > 0)
                @foreach ($akomodasi as $ak)
                <a href="{{ route('enduser.akomodasi', ['id_akomodasi_cat' => $ak->id_akomodasi_cat]) }}" class="col-lg-2 col-md-4 col-sm-6 col-12 card-accomodation mb-md-4 mb-sm-4 mb-4 mb-lg-0">
                    <div>
                        <img src="{{ asset('uploads/akomodasi/' . $ak->thumbnail ) }}" class="img-fluid p-3">
                        <p class="text-center mb-4">{{ $ak->nama_cat }}</p>
                    </div>
                </a>
                @endforeach
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Data akomodasi belum dimuat.
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