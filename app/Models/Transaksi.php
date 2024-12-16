<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    public $timestamps = false;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_user',
        'status_pengiriman',
        'total_harga',
        'metode_transaksi',
        'total_bayar',
        'status_transaksi'
    ];
}
