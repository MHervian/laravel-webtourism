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
                        <span class="text-white">{{ $bread_main_title }}</span>
                    </span>
                    <h1 class="mb-4 text-white">{{ $bread_main_title }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5 cs-acomodation">
            <div class="mb-5">
                <form action="{{ route('enduser.petawisata.search') }}" method="post" class="bg-light rounded-top p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <select name="kategori_peta" class="form-control">
                                <option value="">Pilih Wilayah Wisata..</option>
                                @foreach($wilayah_wisata as $ws)
                                <option value="{{ $ws->id_wisata_cat }}">{{ $ws->kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <input name="nama_peta" type="text" class="form-control" placeholder="Input nama lokasi wisata...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-custom-cta w-100">Cari Lokasi</button>
                        </div>
                    </div>
                </form>
            </div>
            <p class="fw-bold">List hasil pencarian destinasi:</p>
            <div class="row">
                @if (count($list) > 0)
                @foreach($list as $w)
                <a href="{{ route('enduser.petawisata.detail', ['id_wisata' => $w->id_wisata]) }}" class="col-lg-3 col-md-4 col-6 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-accomodation">
                    <div>
                        <img src="{{ asset('uploads/wisata/' . $w->thumbnail) }}" class="img-fluid">
                        <div class="p-2">
                            <p class="m-0">{{ $w->judul }}</p>
                            <span class="d-block mb-2" style="font-size: 15px;">{{ $w->alamat }}</span>
                            <span style="font-size: 17px; color: blue;">Buka Detail</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Hasil pencarian tidak ditemukan.
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row pt-4 pb-5 mb-5">
            <h2 class="text-center mb-3">Peta Wisata</h2>
            <p class="text-center mb-5 pb-5 cs-map">
                Bintan Resorts International (BRI) bertanggung jawab atas
                investasi dan pemasaran destinasi untuk Bintan Resorts.
                Bekerja sama dengan travel trade dan mitra media, BRI
                membuka jalan bagi Bintan Resorts dan pulau itu untuk
                menjangkau audiens global melalui upaya dan aktivitas
                pemasaran yang berkelanjutan. Perusahaan juga berfungsi

                sebagai perencana pengembangan pariwisata dan konsultan
                manajemen Bintan Resorts.</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d510623.53749404545!2d104.14084880347531!3d0.9701504529757412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d97070dc436f5b%3A0xdb8214e8b5e9cd18!2sPulau%20Bintan!5e0!3m2!1sid!2sid!4v1668910249536!5m2!1sid!2sid" style="width: 100%; height: 600px;" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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