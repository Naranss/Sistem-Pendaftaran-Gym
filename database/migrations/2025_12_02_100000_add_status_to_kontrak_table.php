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
        Schema::table('kontrak', function (Blueprint $table) {
            // Add status column to track contract payment status
            if (!Schema::hasColumn('kontrak', 'status')) {
                $table->enum('status', ['pending', 'active', 'expired', 'cancelled'])->default('pending')->after('tanggal_berakhir');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kontrak', function (Blueprint $table) {
            if (Schema::hasColumn('kontrak', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
