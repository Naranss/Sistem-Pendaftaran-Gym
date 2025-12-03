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
            $table->string('tabel_jadwal');
            $table->integer("minggu_ke")->nullable();
            $table->integer("hari")->nullable();
            $table->string('jenis_workout')->default('-');
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
