@extends('pengelolatoko.layouts.main')
@section('content')

<div class="justify-content-center mb-3 border-bottom">
    <h1 class="h2">Pengadaan Barang</h1>
</div>
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a style="text-decoration: none" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pengadaan Barang</li>
    </ol>
</nav>
<div>

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('primary'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        {{ session('primary') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('danger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session('danger') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

<div class="container-fluid pb-2">
    <a href="/pengadaanbarang/tambah" class="btn btn-success">Ajukan Pengadaan Barang</a>
</div>

<div class="card container-fluid">
    <div class="card-header">
        <h5 class="card-title mb-0 py-2">Daftar Pengadaan Barang</h5>
    </div>
    <tbody>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Oleh</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @php $no=1; @endphp
            @foreach($pengadaan as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)); }}</td>
                <td>{{ $item->karyawan_id }} - {{$item->karyawan->namalengkap}}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="/pengadaanbarang/item/{{ $item->id }}" class="badge bg-primary"
                        style="text-decoration: none">Lihat</a>
                    <a href="/pengadaanbarang/review/{{ $item->id }}" class="badge bg-warning"
                        style="text-decoration: none">Review</a>
                    <form action="/pengadaanbarang/hapus/{{ $item->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="badge bg-danger" style="border: none"
                            onclick="return confirm('Hapus item?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </tbody>
    </table>
</div>

@endsection