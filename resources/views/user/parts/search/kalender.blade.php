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
                        <span class="text-white">Kalender Event</span>
                    </span>
                    <h1 class="mb-4 text-white">Kalender Event</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5 cs-acomodation">
            <div class="mb-4">
                <form action="{{ route('enduser.kalender.search') }}" method="post" class="bg-light rounded-top p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <select name="id_kategori_kalender" class="form-control">
                                <option value="">Pilih Event..</option>
                                @foreach($kategori_kalender as $kc)
                                <option value="{{ $kc->id_kalender_cat }}">{{ $kc->nama_cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-md-0 mb-sm-3 mb-3 mb-lg-0">
                            <input type="text" class="form-control" name="nama_kalender" placeholder="Input judul event...">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-custom-cta w-100">Cari Event</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="pb-4">
                <p style="font-weight: 700;">Kategori Kalender:</p>
                <ul class="nav-category p-0 m-0">
                    @foreach($kategori_kalender as $kc)
                    <li class="bg-white border rounded mb-3">
                        <a href="{{ route('enduser.kalender.kategori', ['id_kalender_cat' => $kc->id_kalender_cat]) }}" class="btn">{{ $kc->nama_cat }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <p class="fw-bold">Hasil Pencarian Kalender Event:</p>
            <div class="row">
                @if (count($list) > 0)
                <div class="row">
                    @foreach($list as $k)
                    <div class="col-lg-3 col-md-4 col-sm-6 p-3 mb-md-4 mb-sm-4 mb-4 mb-lg-4 event-list">
                        <a href="{{ route('enduser.kalender.detail', ['id_kalender' => $k->id_kalender]) }}" class="align-items-center">
                            <div class="text-center mb-2">
                                <img src="{{ asset('uploads/kalender/' . $k->thumbnail)}}" class="img-fluid mb-md-0 mb-sm-0 mb-4 mb-lg-0">
                            </div>
                            <div class="">
                                <h5>{{ $k->judul }}</h5>
                                <p class="mt-3">Durasi: <span>13 Januari 2022</span> - <span>23 Januari 2022</span></p>
                                <span class="cs-text-blue">Detail</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-secondary text-center" role="alert">
                    Data event belum dimuat.
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