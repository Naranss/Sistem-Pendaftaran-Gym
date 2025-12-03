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
        Schema::create('membership_plan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket_id')->nullable();
            $table->string('nama_paket_en')->nullable();
            $table->string('deskripsi_id')->nullable();
            $table->string('deskripsi_en')->nullable();
            $table->integer('durasi')->default(1); // in months
            $table->integer('harga');
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
