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
        Schema::table('transaksi', function (Blueprint $table) {
            // Add user_id if it doesn't exist
            if (!Schema::hasColumn('transaksi', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('akun')->onDelete('cascade');
            }
            
            // Add status if it doesn't exist
            if (!Schema::hasColumn('transaksi', 'status')) {
                $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi', 'user_id')) {
                $table->dropForeignIdFor('akun');
                $table->dropColumn('user_id');
            }
            
            if (Schema::hasColumn('transaksi', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
