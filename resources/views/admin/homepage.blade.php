@include('admin.parts.header')

<body class="sb-nav-fixed">
    @include('admin.parts.nav')
    <div id="layoutSidenav">
        @include('admin.parts.sidenav')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Homepage</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Homepage</li>
                    </ol>
                    <form action="{{ route('admin.edithomepage.update') }}" method="post">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <input type="hidden" name="id_content" value="{{ $detail->id_content }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="main_title" class="form-label">Main Title</label>
                                            <input type="text" id="main_title" class="form-control" name="main_title" value="{{ $detail->main_title }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc_main" class="form-label">Deskripsi Main Title</label>
                                            <textarea class="form-control" id="desc_main" name="desc_main">{{ $detail->desc_main }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_paket" class="form-label">Title Paket</label>
                                            <input type="text" id="title_paket" class="form-control" name="title_paket" value="{{ $detail->title_paket }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc_paket" class="form-label">Deskripsi Paket</label>
                                            <textarea class="form-control" id="desc_paket" name="desc_paket">{{ $detail->desc_paket }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_peta" class="form-label">Title Peta</label>
                                            <input type="text" id="title_peta" class="form-control" name="title_peta" value="{{ $detail->title_peta }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc_peta" class="form-label">Deskripsi Peta</label>
                                            <textarea class="form-control" id="desc_peta" name="desc_peta">{{ $detail->desc_peta }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_daya_tarik" class="form-label">Title Daya Tarik</label>
                                            <input type="text" id="title_daya_tarik" class="form-control" name="title_daya_tarik" value="{{ $detail->title_daya_tarik }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc_daya_tarik" class="form-label">Deskripsi Daya Tarik</label>
                                            <textarea class="form-control" id="desc_daya_tarik" name="desc_daya_tarik">{{ $detail->desc_daya_tarik }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_transportasi" class="form-label">Title Transportasi</label>
                                            <input type="text" id="title_transportasi" class="form-control" name="title_transportasi" value="{{ $detail->title_transportasi }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc_transportasi" class="form-label">Deskripsi Transportasi</label>
                                            <textarea class="form-control" id="desc_transportasi" name="desc_transportasi">{{ $detail->desc_transportasi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title_akomodasi" class="form-label">Title Transportasi</label>
                                            <input type="text" id="title_akomodasi" class="form-control" name="title_akomodasi" value="{{ $detail->title_akomodasi }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc_akomodasi" class="form-label">Deskripsi Akomodasi</label>
                                            <textarea class="form-control" id="desc_akomodasi" name="desc_akomodasi">{{ $detail->desc_akomodasi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-secondary">Kosongkan Form</button>
                        <button type="submit" class="btn btn-primary">Proses Data</button>
                    </form>
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