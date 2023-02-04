@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Kontak Emergency</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kontak Emergency</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            List data kontak emergency yang tersimpan di sistem.
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Kontak
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.emergency.form') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus-square"></i>
                                Input Data
                            </a>
                            @if (count($emergency) > 0)
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>No Kontak Darurat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>No Kontak Darurat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach($emergency as $e)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $e->nama }}</td>
                                        <td>{{ $e->no_kontak }}</td>
                                        <td>
                                            <a href="{{ route('admin.emergency.edit', ['id_emergency' => $e->id_emergency]) }}" class="text-secondary ms-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('admin.emergency.delete', ['id_emergency' => $e->id_emergency]) }}" class="text-danger ms-2"><i class="fas fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-center bg-secondary">Data kontak emergency belum ada.</p>
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