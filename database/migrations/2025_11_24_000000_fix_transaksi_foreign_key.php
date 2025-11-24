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
        // Drop the old foreign key constraint
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
        });

        // Re-add with onDelete('cascade') to allow deletion
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('id_produk')
                ->references('id')
                ->on('keranjang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original constraint
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('id_produk')
                ->references('id')
                ->on('keranjang')
                ->onDelete('restrict');
        });
    }
};
