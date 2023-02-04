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
                            <a href="{{ route('admin.aktivitas.kategori.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data Kategori
                            </a>
                            @if (count($dt_cat) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($dt_cat as $dc)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $dc->nama_dt }}</td>
                                        <td>{{ $dc->deskripsi }}</td>
                                        <td>
                                            <a href="{{ route('admin.aktivitas.kategori.edit', ['id_dt_cat' => $dc->id_dt_cat]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.aktivitas.kategori.delete', ['id_dt_cat' => $dc->id_dt_cat]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
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
                            <a href="{{ route('admin.aktivitas.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data
                            </a>
                            @if (count($dt) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Aktivitas</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Aktivitas</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($dt as $d)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $d->judul }}</td>
                                        <td><img src="{{ asset('uploads/dt/' . $d->thumbnail) }}" style="width: 170px; height: 170px;"></td>
                                        <td>
                                            <a href="{{ route('admin.aktivitas.detail', ['id_dt' => $d->id_dt]) }}" class="text-primary"><i class="fas fa-info-circle"></i> Detail</a>
                                            <a href="{{ route('admin.aktivitas.edit', ['id_dt' => $d->id_dt]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.aktivitas.delete', ['id_dt' => $d->id_dt]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center bg-info p-3">{{ strtolower($title_page) }} belum ada.</p>
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