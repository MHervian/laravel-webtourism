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
                            <a href="{{ route('admin.akomodasi.kategori.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data Kategori
                            </a>
                            @if (count($akomodasi) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Gambar</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Gambar</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($akomodasi as $ak)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $ak->nama_cat }}</td>
                                        <td>{{ $ak->jenis }}</td>
                                        <td><img src="{{ asset('uploads/akomodasi/' . $ak->thumbnail) }}" style="width: 170px; height: 170px;"></td>
                                        <td>{{ $ak->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('admin.akomodasi.kategori.edit', ['id_akomodasi_cat' => $ak->id_akomodasi_cat]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.akomodasi.kategori.delete', ['id_akomodasi_cat' => $ak->id_akomodasi_cat]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
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
                            <a href="{{ route('admin.akomodasi.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data
                            </a>
                            @if (count($akomodasi) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($akomodasi as $a)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $a->judul }}</td>
                                        <td><img src="{{ asset('uploads/akomodasi/' . $a->thumbnail) }}" style="width: 170px; height: 170px;"></td>
                                        <td>
                                            <a href="{{ route('admin.akomodasi.detail', ['id_akomodasi' => $a->id_akomodasi]) }}" class="text-primary"><i class="fas fa-info-circle"></i> Detail</a>
                                            <a href="{{ route('admin.akomodasi.edit', ['id_akomodasi' => $a->id_akomodasi]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.akomodasi.delete', ['id_akomodasi' => $a->id_akomodasi]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
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