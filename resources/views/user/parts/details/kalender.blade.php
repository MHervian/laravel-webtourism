@include('user.parts.header', ['title_page' => $title_page])

<body>
    @include('user.parts.mainnav', ['list_transportasi' => $transportasi, 'list_akomodasi' => $akomodasi])

    <header class="bg-header">
        <div class="container pb-4">
            <div class="row py-5">
                <div class="col-lg-6">
                    <span class="mb-4 d-block">
                        <a href="{{ route('enduser.homepage') }}" class="text-white">Beranda</a>
                        <span class="text-white">/</span>
                        <a href="{{ route('enduser.kalender') }}" class="text-white">Kalender Event</a>
                        <span class="text-white">/</span>
                        <span class="text-white">{{ $detail->judul }}</span>
                    </span>
                    <h1 class="mb-2 text-white">{{ $detail->judul }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-7 col-md-8">
                    <div class="bg-white rounded p-4">
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/kalender/' . $detail->thumbnail) }}" class="img-fluid"> 
                        </div>
                        {!! $detail->deskripsi !!}
                    </div>
                </div>
                <div class="col-lg-5 col-md-4">
                    <h4>Kategori Kegiatan:</h4>
                    <ul class="nav flex-column">
                        @foreach($kalender_cat as $kc)
                        <li class="nav-item"><a href="#" class="nav-link">{{ $kc->nama_cat }}</a></li>
                        @endforeach
                    </ul>
                </div>
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