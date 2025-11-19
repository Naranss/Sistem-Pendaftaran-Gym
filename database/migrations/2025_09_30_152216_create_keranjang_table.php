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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_akun')->constrained('akun')->onDelete('restrict');
            $table->foreignId('id_suplemen')->nullable()->constrained('suplemen')->onDelete('restrict');
            $table->string('membership')->nullable();
            $table->integer('harga_membership')->nullable();
            $table->integer('jumlah_produk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
