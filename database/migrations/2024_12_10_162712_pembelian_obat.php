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
            'pembelian_obat',
            function (Blueprint $table) {
                $table->id('id_pembelian_obat');
                $table->foreignId('id_transaksi')->constrained('transaksi', 'id_transaksi')->onDelete('cascade');
                $table->foreignId('id_obat')->constrained('obats', 'id')->onDelete('cascade');
                $table->double('harga_obat');
                $table->integer('jumlah_obat');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('pembelian_obat');
    }
};
