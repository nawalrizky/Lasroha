@extends('pengelolatoko.layouts.main')
@section('content')
<div class="container-fluid p-0">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-3"><strong>Kontol</strong> </h1>
    <hr>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a style="text-decoration: none" href="/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item">Akunting</li>
      <li class="breadcrumb-item active" aria-current="page">Neraca</li>
    </ol>
  </nav>
 
  <form action="" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group col-md-6 my-4">
            <select class="form-control" name="bulan">
                <option value="" disabled selected>Pilih Bulan</option> 
                <option value="01">Januari</option> 
                <option value="02">Februari</option> 
                <option value="03">Maret</option> 
                <option value="04">April</option> 
                <option value="05">Mei</option> 
                <option value="06">Juni</option> 
                <option value="07">Juli</option> 
                <option value="08">Agustus</option> 
                <option value="09">September</option> 
                <option value="10">October</option> 
                <option value="11">November</option> 
                <option value="12">Desember</option> 
            </select>
        </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="thead-light">
        <tr class="table-secondary">
            <th scope="col">Aktiva</th>
            <th scope="col">Saldo</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col"><strong>Aktiva Lancar</strong></td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Kas</td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->kas, 0, ',', '.') : '' }}</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Persediaan Barang Dagangan</td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->persediaan_barang_dagangan, 0, ',', '.') : '' }}</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Perlengkapan Toko</td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->perlengkapan_toko, 0, ',', '.') : '' }}</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Kendaraan</td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->kendaraan, 0, ',', '.') : '' }}</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col"><strong>Total Aktiva Lancar</strong></td>
            <td scope="col"></td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->total, 0, ',', '.') : '' }}</td>
        </tr>
        <tr>
            <td scope="col"><strong> Aktiva Tetap </strong></td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Inventaris</td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->inventaris, 0, ',', '.') : '' }}</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Akum.Peny.Inventaris</td>
            <td scope="col">Rp (0)</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Kendaraan</td>
            <td scope="col">Rp {{ $modalAwal ? number_format($modalAwal->kendaraan, 0, ',', '.') : '' }}</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Akum.Peny.Kendaraan</td>
            <td scope="col">Rp (0)</td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col"><strong>Total Aktiva Tetap</strong></td>
            <td scope="col"></td>
            <td scope="col" id="totalAktivaTetap">Rp {{ $modalAwal ? number_format($modalAwal->inventaris + $modalAwal->kendaraan, 0, ',', '') : '' }}</td>
        </tr>

        <tr>
            <td scope="col"><strong>Total Aktiva</strong></td>
            <td scope="col"></td>
            <td scope="col"><span id="totalAktiva">{{ $modalAwal ? 'Rp ' . number_format($modalAwal->total + $modalAwal->inventaris + $modalAwal->kendaraan, 0, ',', '') : '' }}</span></td>
        </tr>
    </tbody>
</table>


<table class="table table-bordered table table table-striped ">
    <thead class="thead-light">
        <tr class="table-secondary">
            <th scope="col">Pasiva</th>
            <th scope="col">Saldo</th>
            <th scope="col">Total</th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="col"><strong>Pasiva </strong></td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col"><strong>Total Pasiva </strong></td>
            <td scope="col"></td>
            <td scope="col">Rp 0</td>
        </tr>
        <tr>
            <td scope="col"><strong>Modal </strong></td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Modal Owner</td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Rugi Laba</td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col">Prive</td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col"><strong>Total Modal </strong></td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
        <tr>
            <td scope="col"><strong>Total Pasiva </strong></td>
            <td scope="col"></td>
            <td scope="col"></td>
        </tr>
       
    </tbody>
</table>




@endsection