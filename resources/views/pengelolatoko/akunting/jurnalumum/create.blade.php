@extends('pengelolatoko.layouts.main')
@section('content')
<div class="container-fluid p-0">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-3"><strong>Tambah Jurnal Umum</strong> </h1>
    <hr>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a style="text-decoration: none" href="/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item">Akunting</li>
      <li class="breadcrumb-item"><a style="text-decoration: none" href="/akunting/jurnalumum">Jurnal Umum</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Jurnal Umum</li>
    </ol>
  </nav>
  <form action="{{ route('akunting.jurnalUmumStore') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
        <div class="form-group col-md-8">
            <label for="tanggal" class="col-form-label"><strong>Tanggal</strong></label>
            <input type="date" name="tanggal" class="form-control" placeholder="" id="tanggal" 
                >
        </div>
        <div class="form-group col-md-8">
            <label for="nama" class="col-form-label"><strong>Nama Perkiraan</strong></label>
            <input type="text" name="nama_perkiraan" class="form-control" placeholder="" >
        </div>
        <div class="form-group col-md-8">
            <label for="debit" class="col-form-label"><strong>Debit</strong></label>
            <input type="text" name="debit" class="form-control" placeholder="" >
        </div>
        <div class="form-group col-md-8">
            <label for="kredit" class="col-form-label"><strong>Kredit</strong></label>
            <input type="number" name="kredit" class="form-control" placeholder="" >
        </div>
        <div class="form-group col-md-8">
            <label for="keterangan" class="col-form-label"><strong>Keterangan</strong></label>
            <input type="text" name="keterangan" class="form-control" placeholder="" >
        </div>
       
       


    <div class="py-5">
        <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Reset</button>

<button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Simpan</button>
    </div>
</form>


   

    <hr>

</div>

@endsection