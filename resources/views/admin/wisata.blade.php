@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">{{ $title_page }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title_page }}</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            List {{ strtolower($title_page) }} yang tersimpan di sistem.
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel {{ $title_page }}
                        </div>
                        <div class="card-body">
                            @if (isset($display))
                            <a href="{{ route('admin.wisata.kategori.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data Kategori
                            </a>
                            @if (count($wisata) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kecamatan</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Kacamatan</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($wisata as $ws)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $ws->kecamatan }}</td>
                                        <td>{{ $ws->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('admin.wisata.kategori.edit', ['id_wisata_cat' => $ws->id_wisata_cat]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.wisata.kategori.delete', ['id_wisata_cat' => $ws->id_wisata_cat]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center bg-secondary">{{ strtolower($title_page) }} belum ada.</p>
                            @endif
                            @else
                            <a href="{{ route('admin.wisata.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data
                            </a>
                            @if (count($wisata) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tempat Wisata</th>
                                        <th>Gambar</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tempat Wisata</th>
                                        <th>Gambar</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($wisata as $ws)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $ws->judul }}</td>
                                        <td><img src="{{ asset('uploads/wisata/' . $ws->thumbnail) }}" style="width: 170px; height: 170px;"></td>
                                        <td>{{ $ws->alamat }}</td>
                                        <td>
                                            <a href="{{ route('admin.wisata.detail', ['id_wisata' => $ws->id_wisata]) }}" class="text-primary"><i class="fas fa-info-circle"></i> Detail</a>
                                            <a href="{{ route('admin.wisata.edit', ['id_wisata' => $ws->id_wisata]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.wisata.delete', ['id_wisata' => $ws->id_wisata]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center bg-secondary">{{ strtolower($title_page) }} belum ada.</p>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('admin.parts.footer')
</body>

</html>