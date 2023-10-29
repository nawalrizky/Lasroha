@extends('pengelolatoko.layouts.main')
@section('content')
<div class="container-fluid p-0">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-3"><strong>Jurnal Umum</strong> </h1>
    <hr>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a style="text-decoration: none" href="/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item">Akunting</li>
      <li class="breadcrumb-item active" aria-current="page">Jurnal Umum</li>
    </ol>
  </nav>
  <a href="/akunting/jurnalumum/create" class="btn btn-primary mb-3"><svg xmlns="http://www.w3.org/2000/svg"
    width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
    <path fill-rule="evenodd"
        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
</svg></i> Tambah </a>
  
<table class="table table-bordered table table table-striped">
    <thead class="thead-light">
        <tr class="table-secondary">
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama Perkiraan</th>
            <th scope="col">Debit</th>
            <th scope="col">Kredit</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jurnalumum as $key => $data)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $data->tanggal }}</td>
            <td>{{ $data->nama_perkiraan }}</td>
            <td>{{ $data->debit }}</td>
            <td>{{ $data->kredit }}</td>
            <td>{{ $data->keterangan }}</td>
            <td>
                <form action="{{ route('akunting.jurnalUmumDestroy', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus Jurnal Umum ini?')">Hapus</button>
                </form>
                
            </td>
        </tr>
    @endforeach
    
    </tbody>
</table>

</div>

@endsection