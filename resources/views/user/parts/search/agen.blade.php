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
                <form action="{{ route('enduser.agen.search') }}" method="post" class="bg-light rounded-top p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="offset-md-2 col-md-5 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <input type="text" class="form-control" name="nama_agen" placeholder="Input nama agen...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-custom-cta w-100">Cari Agen Wisata</button>
                        </div>
                    </div>
                </form>
            </div>
            <p class="fw-bold">List hasil pencarian agen wisata:</p>
            <div class="row">
                @if (count($list) > 0)
                @foreach($list as $ls)
                <a href="{{ route('enduser.agen.detail', ['id_agen_wisata' => $ls->id_agen_wisata]) }}" class="col-lg-3 col-md-4 col-6 mb-md-4 mb-sm-4 mb-4 mb-lg-4 card-accomodation">
                    <div>
                        @if ($ls->thumbnail !== null)
                        <div class="p-3">
                            <img src="{{ asset('uploads/agen/' . $ls->thumbnail) }}" class="img-fluid">
                        </div>
                        @endif
                        <div class="p-2">
                            <p class="m-0">{{ $ls->nama }}</p>
                            <span class="d-block mb-2" style="font-size: 15px;">{{ $ls->alamat }}</span>
                            <span class="d-block mb-2" style="font-size: 15px;">{{ $ls->no_kontak }}</span>
                            <span style="font-size: 17px; color: blue;">Buka Detail</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Data hasil pencarian tidak ditemukan.
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