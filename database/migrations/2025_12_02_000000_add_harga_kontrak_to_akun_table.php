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
        Schema::table('akun', function (Blueprint $table) {
            // Add harga_kontrak column for trainers only - monthly contract fee
            $table->decimal('harga_kontrak', 10, 2)->nullable()->default(100000)->comment('Monthly contract fee for trainers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akun', function (Blueprint $table) {
            $table->dropColumn('harga_kontrak');
        });
    }
};
