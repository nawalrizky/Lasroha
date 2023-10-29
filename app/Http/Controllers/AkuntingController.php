<?php

namespace App\Http\Controllers;

use App\Models\JurnalUmum;
use App\Models\ModalAwal;
use Illuminate\Http\Request;

class AkuntingController extends Controller
{
    public function inputModalAwal()
    {
        return view('pengelolatoko.akunting.inputmodal.index', [
            'active' => 'akuntingmodal',
            'title' =>'Input Modal Awal',
        ]);
    }

    public function modalAwalStore(Request $request)
{
    $validatedData = $request->validate([
        'tanggal' => 'required|date',
        'kas' => 'required|numeric',
        'inventaris' => 'required|numeric',
        'persediaan_barang_dagangan' => 'required|numeric',
        'perlengkapan_toko' => 'required|numeric',
        'kendaraan' => 'required|numeric',
    ], [
        'required' => 'Kolom :attribute wajib diisi.',
        'numeric' => 'Kolom :attribute harus berupa angka.',
        'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    ], [
        'tanggal' => 'Tanggal',
        'kas' => 'Kas',
        'inventaris' => 'Inventaris',
        'persediaan_barang_dagangan' => 'Persediaan Barang Dagangan',
        'perlengkapan_toko' => 'Perlengkapan Toko',
        'kendaraan' => 'Kendaraan',
    ]);

    // Melakukan perhitungan total
    $total = $validatedData['kas'] +
             $validatedData['inventaris'] +
             $validatedData['persediaan_barang_dagangan'] +
             $validatedData['perlengkapan_toko'] +
             $validatedData['kendaraan'];

    // Menambahkan total ke dalam data yang akan disimpan
    $validatedData['total'] = $total;

    // Menyimpan data modal awal ke dalam tabel
    ModalAwal::create($validatedData);

    return redirect('/akunting/inputmodal')->with('success', 'Data Modal Awal Berhasil di Simpan');
}


    public function persediaanAkhirBulan()
    {
        return view('pengelolatoko.akunting.persediaan.index', [
            'active' => 'akuntingpersediaan',
            'title' =>'Persediaan Akhir Bulan',
        ]);
    }

    public function jurnalUmum()
    {
        $jurnalumum = JurnalUmum::all();
        return view('pengelolatoko.akunting.jurnalumum.index', compact( 'jurnalumum'),[
            'active' => 'akuntingjurnalumum',
            'title' =>'Jurnal Umum',
           
        ]);
    }

    public function jurnalUmumCreate()
    {
        
        return view('pengelolatoko.akunting.jurnalumum.create', [
            'active' => 'akuntingjurnalumum',
            'title' =>'Jurnal Umum',
            'jurnalumum'
        ]);
    }
    public function jurnalUmumStore(Request $request) {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'nama_perkiraan' => 'required|string|max:255',
            'debit' => 'required|numeric',
            'kredit' => 'required|numeric',
            'keterangan' => 'required|string|max:255',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh melebihi :max karakter.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
        ], [
            'tanggal' => 'Tanggal',
            'nama_perkiraan' => 'Nama Perkiraan',
            'debit' => 'Debit',
            'kredit' => 'Kredit',
            'keterangan' => 'Keterangan',
        ]);
    
        // Peroleh saldo debit dan kredit yang tersimpan dalam tabel
        $saldoDebitTersimpan = JurnalUmum::sum('debit');
        $saldoKreditTersimpan = JurnalUmum::sum('kredit');
    
        // Perbarui saldo debit dan kredit
        $debit = $validatedData['debit'];
        $kredit = $validatedData['kredit'];
        $saldoDebit = $saldoDebitTersimpan + $debit;
        $saldoKredit = $saldoKreditTersimpan + $kredit;
    
        // Simpan nilai saldo debit dan kredit ke dalam tabel jurnal umum
        $jurnalUmum = new JurnalUmum([
            'tanggal' => $validatedData['tanggal'],
            'nama_perkiraan' => $validatedData['nama_perkiraan'],
            'debit' => $debit,
            'kredit' => $kredit,
            'keterangan' => $validatedData['keterangan'],
            'saldo_debit' => $saldoDebit,
            'saldo_kredit' => $saldoKredit,
        ]);
        $jurnalUmum->save();
    
        return redirect('/akunting/jurnalumum')->with('pesan', 'Data Jurnal Umum Berhasil di Simpan');
    }
    
    

    public function jurnalUmumDestroy($id)
{
    $jurnalumum = JurnalUmum::find($id);

    if (!$jurnalumum) {
        return redirect('/akunting/jurnalumum')->with('error', 'Data Jurnal Umum tidak ditemukan');
    }

    $jurnalumum->delete();

    return redirect('/akunting/jurnalumum')->with('success', 'Data Jurnal Umum berhasil dihapus');
}

    
public function bukuBesar()
    {
        // Mengambil semua data Jurnal Umum
        $jurnalumum = JurnalUmum::all();

        // Initialize running totals for debit and credit
        $saldoDebit = 0;
        $saldoKredit = 0;

        // Iterate through Jurnal Umum entries to calculate running totals
        foreach ($jurnalumum as $entry) {
            $saldoDebit += $entry->debit;
            $saldoKredit += $entry->kredit;
            // You can also update the entry with these running totals for display
            $entry->saldoDebit = $saldoDebit;
            $entry->saldoKredit = $saldoKredit;
        }

        return view('pengelolatoko.akunting.bukubesar.index', [
            'active' => 'akuntingbukubesar',
            'title' => 'Buku Besar',
            'jurnalumum' => $jurnalumum,
            'saldoDebit' => $saldoDebit,
            'saldoKredit' => $saldoKredit,
        ]);
    }

    public function laporanRugiLaba()
    {
        return view('pengelolatoko.akunting.laporan.index', [
            'active' => 'akuntinglaporan',
            'title' =>'Laporan Laba Rugi',
        ]);
    }

    public function neraca(Request $request)
    {
        if ($request->isMethod('post')) {
            $bulan = $request->input('bulan'); // Mengambil nilai bulan dari permintaan POST
    
            // Mengambil data modal awal dari database berdasarkan bulan
            $modalAwal = ModalAwal::whereMonth('tanggal', $bulan)->first();
    
            if (!$modalAwal) {
                // Data modal awal tidak ditemukan, Anda dapat menangani ini sesuai kebutuhan Anda
                return redirect()->back()->with('error', 'Data modal awal tidak ditemukan untuk bulan yang dipilih.');
            }
        } else {
            // Jika tidak ada permintaan POST (belum memilih  bulan), set nilai default untuk $bulan
            $bulan = date('m'); // Ini akan mengambil bulan saat ini sebagai nilai default. Sesuaikan dengan kebutuhan Anda.
        }
    
        // Mengembalikan tampilan Neraca dengan data modal awal yang sesuai
        return view('pengelolatoko.akunting.neraca.index', [
            'active' => 'akuntingneraca',
            'title' => 'Neraca',
            'modalAwal' => $modalAwal ?? null, // Menggunakan operator null coalescing untuk menghindari kesalahan undefined variable
            'bulan' => $bulan,
        ]);
    }
    
    

    public function neracaCoba() {
        return view('pengelolatoko.akunting.neraca.coba', [
            'active' => 'akuntingneraca',
            'title' =>'Laporan Rugi Laba',
        ]);
    }
    
    
    
    




}
