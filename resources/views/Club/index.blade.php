@extends('template.main-layout')
@section('title', 'Club')
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
                <li class="breadcrumb-item"><a href="/klasemen">Klasemen</a></li>
                <li class="breadcrumb-item active">Club</li>
            </ol>
        </div><!-- /.col -->
        <div class="row mt-1" style="margin-bottom: -20px">
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
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <h4 class="my-auto">Tabel Club
                                <a href="{{ route('create-club') }}" class="float-end btn btn-sm btn-primary"><i
                                        class="fas fa-plus"></i>
                                    Tambah Club</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatables" class="text-center table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Klub</th>
                                            <th>Kota Klub</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item['nama'])
                                                        {{ $item['nama'] }}
                                                    @else
                                                        <p>[NORECORD]</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item['kota'])
                                                        {{ $item['kota'] }}
                                                    @else
                                                        <p>[NORECORD]</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('edit-club', $item->id) }}"
                                                            class="btn btn-sm btn-warning"><i
                                                                class="fas fa-edit"></i></a>&nbsp;
                                                        <form action="{{ route('destroy-club', $item->id) }}" method="POST"
                                                            class="delete-form">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            {{-- SweetAlert --}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            {{-- DataTable --}}
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#datatables').DataTable()
                });

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
                                // Jika pengguna mengklik "Ya, hapus!", submit form secara manual
                                this.submit();
                            }
                        });
                    });
                });
            </script>
        @endsection
