@extends('pengelolatoko.layouts.main')
@section('content')
<div class="container-fluid p-0">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-3"><strong>Input Modal</strong> </h1>
    <hr>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
    aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a style="text-decoration: none" href="/dashboard">Dashboard</a></li>
      <li class="breadcrumb-item">Akunting</li>
      <li class="breadcrumb-item active" aria-current="page">Input Modal Awal</li>
    </ol>
  </nav>
  <form action="{{ route('akunting.modalAwalStore') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group col-md-8">
        <label for="tanggal" class="col-form-label"><strong>Tanggal</strong></label>
        <input type="date" name="tanggal" class="form-control" placeholder="" id="tanggal">
    </div>
    <div class="form-group col-md-8">
        <label for="kas" class="col-form-label"><strong>Kas</strong></label>
        <input type="text" name="kas" class="form-control" placeholder="" id="kas">
    </div>
    <div class="form-group col-md-8">
        <label for="inventaris" class="col-form-label"><strong>Inventaris</strong></label>
        <input type="text" name="inventaris" class="form-control" placeholder="" id="inventaris">
    </div>
    <div class="form-group col-md-8">
        <label for="persediaan_barang_dagangan" class="col-form-label"><strong>Persediaan Barang Dagangan</strong></label>
        <input type="text" name="persediaan_barang_dagangan" class="form-control" placeholder="" id="persediaan_barang_dagangan">
    </div>
    <div class="form-group col-md-8">
        <label for="perlengkapan_toko" class="col-form-label"><strong>Perlengkapan Toko</strong></label>
        <input type="text" name="perlengkapan_toko" class="form-control" placeholder="" id="perlengkapan_toko">
    </div>
    <div class="form-group col-md-8">
        <label for="kendaraan" class="col-form-label"><strong>Kendaraan</strong></label>
        <input type="text" name="kendaraan" class="form-control" placeholder="" id="kendaraan">
    </div>
    <div class="form-group col-md-8">
        <label for="total" class="col-form-label"><strong>Total</strong></label>
        <input type="text" name="total" class="form-control" placeholder="" id="total" readonly>
    </div>

    <div class="py-5">
        <button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Reset</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Simpan</button>
    </div>
</form>
</div>


<!-- Script to calculate and update total -->
<script>
    const kasInput = document.getElementById('kas');
    const inventarisInput = document.getElementById('inventaris');
    const persediaanInput = document.getElementById('persediaan_barang_dagangan');
    const perlengkapanInput = document.getElementById('perlengkapan_toko');
    const kendaraanInput = document.getElementById('kendaraan');
    const totalInput = document.getElementById('total');

    // Add input event listeners to update total whenever input changes
    kasInput.addEventListener('input', calculateTotal);
    inventarisInput.addEventListener('input', calculateTotal);
    persediaanInput.addEventListener('input', calculateTotal);
    perlengkapanInput.addEventListener('input', calculateTotal);
    kendaraanInput.addEventListener('input', calculateTotal);

    function calculateTotal() {
        const kas = parseFloat(kasInput.value.replace(/\D/g, '')) || 0;
        const inventaris = parseFloat(inventarisInput.value.replace(/\D/g, '')) || 0;
        const persediaan = parseFloat(persediaanInput.value.replace(/\D/g, '')) || 0;
        const perlengkapan = parseFloat(perlengkapanInput.value.replace(/\D/g, '')) || 0;
        const kendaraan = parseFloat(kendaraanInput.value.replace(/\D/g, '')) || 0;

        const total = kas + inventaris + persediaan + perlengkapan + kendaraan;

        // Format total as currency and update the input value
        totalInput.value = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        // You can remove this if you don't want to display it as "Rp XXXX"
        totalInput.value = totalInput.value;
    }

    // Initial calculation when the page loads
    calculateTotal();
</script>

@endsection
