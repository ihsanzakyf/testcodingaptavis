@extends('template.main-layout')
@section('title', 'Pertandingan')
@section('content')
    {{-- DataTable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if ($create = Session::get('create'))
        <script>
            Swal.fire({
                title: 'Tambah Data Berhasil!',
                text: '{{ session('create') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 2500,
                timerProgressBar: true
            });
        </script>
    @elseif ($update = Session::get('update'))
        <script>
            Swal.fire({
                title: 'Update Data Berhasil!',
                text: '{{ session('update') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 2500,
                timerProgressBar: true
            });
        </script>
    @elseif ($deled = Session::get('deled'))
        <script>
            Swal.fire({
                title: 'Hapus Data Berhasil!',
                text: '{{ session('deled') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 2500,
                timerProgressBar: true
            });
        </script>
    @endif
    <div class="row mb-2">
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pertandingan</li>
            </ol>
        </div>
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }} <!-- Menggunakan 'error' sebagai kunci untuk mengambil pesan -->
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <h4 class="my-auto">Tabel Pertandingan
                                {{-- <a href="{{ route('create-customer') }}" class="float-end btn btn-sm btn-primary"><i
                                        class="fas fa-plus"></i>
                                    Tambah Customer</a> --}}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                                href="#custom-tabs-four-home" role="tab"
                                                aria-controls="custom-tabs-four-home" aria-selected="true">Single Input</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <!-- Form untuk satu per satu -->
                                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-home-tab">
                                            <form action="{{ route('store-single') }}" method="POST">
                                                @csrf
                                                <div class="form-row align-items-center ">
                                                    <div class="col-2">
                                                        <label for="id_club_1">Klub 1</label>
                                                        <select
                                                            class="form-select form-select-sm @error('id_club_1') is-invalid @enderror"
                                                            id="id_club_1" name="id_club_1">
                                                            <option value="">--Pilih Klub--</option>
                                                            @foreach ($club as $klub)
                                                                <option value="{{ $klub->id }}">{{ $klub->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_club_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mx-3 text-center">
                                                        <label style="margin-top: 35px">-</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="id_club_2">Klub 2</label>
                                                        <select
                                                            class="form-select form-select-sm @error('id_club_1') is-invalid @enderror"
                                                            id="id_club_2" name="id_club_2">
                                                            <option value="">--Pilih Klub--</option>
                                                            @foreach ($klubs as $klub)
                                                                <option value="{{ $klub->id }}">{{ $klub->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_club_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <i class="text-xs">Note: Silahkan pilih klub 1 terlebih dahulu</i>
                                                </div>
                                                <div class="form-row mb-3">
                                                    <div class="col-2">
                                                        <label for="skor_club_1">Score 1</label>
                                                        <input type="number"
                                                            class="form-control form-control-sm @error('skor_club_1') is-invalid @enderror"
                                                            id="skor_club_1" name="skor_club_1" placeholder="Masukan Score">
                                                        @error('skor_club_1')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mx-3 text-center">
                                                        <label class="" style="margin-top: 35px">-</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="skor_club_2">Score 2</label>
                                                        <input type="number"
                                                            class="form-control form-control-sm @error('skor_club_2') is-invalid @enderror"
                                                            id="skor_club_2" name="skor_club_2" placeholder="Masukan Score">
                                                        @error('skor_club_2')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm rounded-3"
                                                    style="width: 100px">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            {{-- {{-- SweetAlert ---2}} --}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            {{-- DataTable --}}
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script>
                // DataTables
                $(document).ready(function() {
                    // DataTables
                    $('#datatables').DataTable();

                });

                // Delete Confirm
                document.querySelectorAll('.delete-form').forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            html: 'Data ini akan diakan dihapus!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                            }
                        });
                    });
                });
                // End Delete Confirm

                // Single Input
                $(document).ready(function() {
                    $('#id_club_2').prop('disabled', true);

                    $('#id_club_1').change(function() {
                        var club1Id = $(this).val();
                        if (club1Id) {
                            $.get('{{ route('getAvailableClubs') }}', {
                                    club1_id: club1Id
                                })
                                .done(function(data) {
                                    var club2Select = $('#id_club_2');
                                    club2Select.empty();
                                    club2Select.append(
                                        '<option value="">-- Pilih Klub --</option>');
                                    $.each(data, function(id, nama) {
                                        club2Select.append('<option value="' + id + '">' +
                                            nama +
                                            '</option>');
                                    });
                                    $('#id_club_2').prop('disabled',
                                        false);
                                });
                        } else {
                            $('#id_club_2').prop('disabled',
                                true);
                        }
                    });
                });
                // End Single Input
            </script>
        @endsection
