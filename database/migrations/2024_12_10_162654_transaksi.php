<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create(
            'transaksi',
            function (Blueprint $table) {
                $table->id('id_transaksi');
                $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
                $table->string('status_pengiriman');
                $table->double('total_harga');
                $table->string('metode_transaksi');
                $table->double('total_bayar');
                $table->string('status_transaksi');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('transaksi');
    }
};
