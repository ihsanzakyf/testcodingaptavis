<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Coding AptaVis | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('lte/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body class="hold-transition sidebar-mini" style="font-family: poppins;">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    {{-- Klasemen --}}
                    @if (Request::is('klasemen'))
                        <strong><a href="{{ url('/klasemen') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                        {{-- Club --}}
                    @elseif (Request::is('club'))
                        <strong><a href="{{ url('club') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                    @elseif (Request::is('club-create'))
                        <strong><a href="{{ url('/club-create') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                    @elseif (Request::is('club-edit/*'))
                        <strong><a href="{{ url('/club-edit/*') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                        {{-- Pertandingan --}}
                    @elseif (Request::is('pertandingan_single'))
                        <strong><a href="{{ url('/pertandingan_single') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                    @elseif (Request::is('pertandingan_multiple'))
                        <strong><a href="{{ url('/pertandingan_multiple') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                    @elseif (Request::is('pertandingan-edit/*'))
                        <strong><a href="{{ url('/pertandingan-edit/*') }}"
                                class="nav-link">@yield('title')</a></strong></a></strong>
                    @endif
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto d-flex me-3">
                <!-- Navbar Search -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" onclick="showLogoutConfirmation()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li> --}}
                <!-- Perbesar / Perkecil -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link text-center d-flex flex-column align-items-center"
                style="text-decoration: none">

                <span class="brand-text fw-bold mt-2">Test Coding AptaVis</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">Klasemen</li>
                        <li class="nav-item">
                            <a href="klasemen" class="nav-link {{ Request::is('klasemen') ? 'active' : '' }}">
                                <i class="nav-icon">
                                    <img src="{{ asset('images/klasemen.png') }}" alt="Logo Klasemen" class="nav-icon"
                                        style="filter: brightness(0) invert(1);">
                                </i>
                                <p>Klasemen</p>
                            </a>
                        </li>
                        <li class="nav-header">Club</li>
                        <li class="nav-item">
                            <a
                                href="club"class="nav-link
                            @if (Request::is('club')) active
                            @elseif (Request::is('club-create')) active
                            @elseif(Request::is('club-edit/*')) active @endif">
                                <i class="nav-icon">
                                    <img src="{{ asset('images/club.png') }}" alt="Logo Club" class="nav-icon"
                                        style="filter: brightness(0) invert(1);">
                                </i>
                                <p>Club</p>
                            </a>
                        </li>
                        <li class="nav-header">Pertandingan</li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link @if (Request::is('single') || Request::is('pertandingan_single') || Request::is('pertandingan_multiple')) active menu-is-opening menu-open @endif">
                                <i class="nav-icon">
                                    <img src="{{ asset('images/match.png') }}" alt="Logo Pertandingan" class="nav-icon"
                                        style="filter: brightness(0) invert(1);">
                                </i>
                                <p>
                                    Pertandingan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview"
                                style="@if (Request::is('single') || Request::is('pertandingan_single') || Request::is('pertandingan_multiple')) display: block; @endif">
                                <li class="nav-item">
                                    <a href="{{ route('pertandingan_single') }}"
                                        class="nav-link {{ Request::is('pertandingan_single') || Request::is('') ? 'active' : '' }}">
                                        <i class="fas fa-user-cog nav-icon"></i>
                                        <p>Single Input</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pertandingan_multiple') }}"
                                        class="nav-link {{ Request::is('pertandingan_multiple') || Request::is('') ? 'active' : '' }}">
                                        <i class="fas fa-users-cog nav-icon"></i>
                                        <p>Multiple Input</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <strong>Test Coding Aptavis</strong> Version 2024
            </div>
            <!-- Default to the left -->
            Created By Ihsan Zaky Fadillah<strong> <a href="#"></a></strong>
        </footer>

        <!-- jQuery -->
        <script src=" {{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        {{-- Bootstrap 5 --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <!-- AdminLTE App -->
        <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
        {{-- J-Query --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        {{-- DataTable --}}
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
