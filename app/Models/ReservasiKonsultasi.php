<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi_konsultasi';
    protected $primaryKey = 'id_reservasi_konsultasi';

    protected $fillable = [
        'id_user',
        'nama_lengkap_pasien',
        'keluhan',
        'usia_pasien',
        'jenis_kelamin',
        'berat_badan_pasien',
        'alergi_pasien',
        'tanggal_reservasi_konsultasi',
        'jam_reservasi_konsultasi',
        'harga_reservasi_konsultasi',
        'metode_transaksi_reservasi',
        'status_reservasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
