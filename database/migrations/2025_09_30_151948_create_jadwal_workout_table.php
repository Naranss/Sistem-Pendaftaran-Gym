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
        Schema::create('jadwal_workout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_client')->constrained('akun')->onDelete('restrict');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->string('jenis_workout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_workout');
    }
};
