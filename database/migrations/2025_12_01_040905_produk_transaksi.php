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
        Schema::create('produk_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaksi')->nullable()->constrained('transaksi')->onDelete('restrict');
            $table->foreignId('id_produk')->nullable()->constrained('suplemen')->onDelete('restrict');
            $table->foreignId('id_kontrak')->nullable()->constrained('kontrak')->onDelete('restrict');
            $table->foreignId('id_membership')->nullable()->constrained('membership_plan')->onDelete('restrict');
            $table->integer('jumlah_produk')->nullable();
            $table->integer('harga_produk')->nullable();
            $table->integer('harga_kontrak')->nullable();
            $table->integer('harga_membership')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
