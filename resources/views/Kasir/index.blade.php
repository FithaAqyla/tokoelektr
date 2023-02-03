<!DOCTYPE html>
<html>

<head>
    <title>PRAKTIKUM LARAVEL CRUD</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/kasir">Kasir</a>
                    </li>
                    </li><li class="nav-item">
                        <a class="nav-link" href="/barang">Barang</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{
route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{
route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link 
dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{
route('logout') }}" onclick="event.preventDefault();
document.getElementB
yId('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{
route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</head>

<body>
<div class="container mt-3">
        @if (session('Sukses'))
            <div class="alert alert-success" role="alert">
                {{ session('Sukses') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6 my-3">
                <h1>Data Kasir</h1>
            </div>
            <div class="col-6 my-4" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm float right" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Tambah Kasir
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ($dataKasir as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->Nama }}</td>
                                <td>{{ $item->Telepon }}</td>
                                <td>
                                    <a href="/kasir/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="/kasir/delete/{{ $item->id }}"class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah anda ingin menghapus nomor {{ $loop->iteration }}')">
                                        Delete
                                    </a>
                                    <button type="button" class="btn btn-light btn-sm"><a
                                            href="/kasir/exportpdf">PDF</a></button>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Kasir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Form Modal --}}
                    <form action="{{ route('tambah.kasir') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="Nama" name="Nama"
                                placeholder="Nurlinda">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="form-label">Telepon Kasir</label>
                            <input type="text" class="form-control" id="Telepon" name="Telepon"
                                placeholder="08114413333">
                        </div>
                        {{-- Form Modal --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-
q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.m
in.js" integrity="sha384-
ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.
js" integrity="sha384-
ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>