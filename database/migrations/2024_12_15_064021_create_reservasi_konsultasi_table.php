<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservasi_konsultasi', function (Blueprint $table) {
            $table->id('id_reservasi_konsultasi');
            $table->foreignId('id_user')->constrained('users');
            $table->string('nama_lengkap_pasien');
            $table->text('keluhan');
            $table->integer('usia_pasien');
            $table->string('jenis_kelamin');
            $table->float('berat_badan_pasien');
            $table->string('alergi_pasien')->nullable();
            $table->date('tanggal_reservasi_konsultasi');
            $table->time('jam_reservasi_konsultasi');
            $table->decimal('harga_reservasi_konsultasi', 10, 2);
            $table->string('metode_transaksi_reservasi');
            $table->string('status_reservasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservasi_konsultasi');
    }
};
