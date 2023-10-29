@extends('pengelolatoko.layouts.main')
@section('content')
<div class="container-fluid p-0">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-3"><strong>Buku Besar</strong></h1>
    <hr>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="text-decoration: none" href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">Akunting</li>
            <li class="breadcrumb-item active" aria-current="page">Buku Besar</li>
        </ol>
    </nav>
    <table class="table table-bordered table table table-striped">
        <thead class="thead-light">
            <tr class="table-secondary">
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Perkiraan</th>
                <th scope="col">Debit</th>
                <th scope="col">Kredit</th>
                <th scope="col">Saldo Debit</th>
                <th scope="col">Saldo Kredit</th>
            </tr>
        </thead>
        <tbody>
            @php
            $saldoDebit = 0;
            $saldoKredit = 0;
            @endphp
            @foreach ($jurnalumum as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->nama_perkiraan }}</td>
                <td>{{ $data->debit }}</td>
                <td>{{ $data->kredit }}</td>
                @php
                $saldoDebit += $data->debit;
                $saldoKredit += $data->kredit;
                @endphp
                <td>{{ $saldoDebit }}</td>
                <td>{{ $saldoKredit }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
