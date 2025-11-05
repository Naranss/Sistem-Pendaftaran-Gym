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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('id_produk')->nullable()->constrained('keranjang')->onDelete('restrict');
            $table->foreignId('id_kontrak')->nullable()->constrained('kontrak')->onDelete('restrict');
            $table->string('membership')->nullable();
            $table->integer('jumlah_produk')->nullable();
            $table->integer('harga_produk')->nullable();
            $table->integer('harga_kontrak')->nullable();
            $table->integer('harga_membership')->nullable();
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
