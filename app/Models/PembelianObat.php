<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianObat extends Model
{
    //
    public $timestamps = false;
    protected $table = 'pembelian_obat';
    protected $primaryKey = 'id_pembelian_obat';

    protected $fillable = [
        'id_transaksi',
        'id_obat',
        'total_harga',
        'harga_obat',
        'jumlah_obat'
    ];
}
