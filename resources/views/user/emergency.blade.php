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
                        <span class="text-white">Emergency</span>
                    </span>
                    <h1 class="mb-4 text-white">Bantuan Darurat</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="back-grey">
        <div class="container py-5 cs-acomodation">
            <div class="row">
                @if (count($emergency) > 0)
                @foreach($emergency as $e)
                <div class="col-lg-3 col-md-6 mb-3 card-accomodation">
                    <div class="p-2">
                        <p class="m-0" style="font-size: 17px;font-weight: 400;">{{ $e->nama }}</p>
                        <span class="d-block mb-2" style="font-size: 23px;font-weight: 700;">
                            <i class="fa fa-phone" style="font-size:23px"></i> {{ $e->no_kontak }}
                        </span>
                    </div>
                </div>
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
</body>

</html>