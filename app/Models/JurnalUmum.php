<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    use HasFactory;
    protected $table = 'jurnal_umum';
    protected $fillable = ['tanggal', 'nama_perkiraan', 'debit', 'kredit', 'saldo_debit', 'saldo_kredit', 'keterangan'];
}
