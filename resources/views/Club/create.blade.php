@extends('Template.main-layout')
@section('title', 'Tambah Data Club')
@section('content')
    <div class="row mb-2">
        <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left ml-2">
                <a href="/club" class="btn btn-md btn-primary ml-2"><i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali</a>
            </ol>
            <ol class="breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="/">Klasemen</a></li>
                <li class="breadcrumb-item"><a href="/club">Club</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">@yield('title')</h5>
                        </div>
                        <div class="card-body ">
                            <form action="{{ route('store-club') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Club</label>
                                            <input type="text"
                                                class="form-control form-control-sm @error('nama') is-invalid @enderror"
                                                placeholder="Masukkan Nama Club" name="nama" id="nama"
                                                value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kota">Kota Club</label>
                                            <input type="text"
                                                class="form-control form-control-sm @error('kota') is-invalid @enderror"
                                                placeholder="Masukkan Kota Club" name="kota" id="kota"
                                                value="{{ old('kota') }}">
                                            @error('kota')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for=""></label>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn w-50 btn-sm btn-primary mx-auto">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- J-Query --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>
@endsection
