@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Agen Wisata</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Agen Wisata</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            List data agen wisata yang tersimpan di sistem.
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Agen
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.agen.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data
                            </a>
                            @if (count($agen) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Agen</th>
                                        <th>Logo</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Agen</th>
                                        <th>Logo</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($agen as $ag)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $ag->nama }}</td>
                                        <td><img src="{{ asset('uploads/agen/' . $ag->thumbnail) }}" style="width: 180px; height: 70px;"></td>
                                        <td>{{ $ag->alamat }}</td>
                                        <td>
                                            <a href="{{ route('admin.agen.detail', ['id_agen_wisata' => $ag->id_agen_wisata]) }}" class="text-primary"><i class="fas fa-info-circle"></i> Detail</a>
                                            <a href="{{ route('admin.agen.edit', ['id_agen_wisata' => $ag->id_agen_wisata]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.agen.delete', ['id_agen_wisata' => $ag->id_agen_wisata]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center bg-secondary">Data agen belum ada.</p>
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