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
            // Check if membership_start column doesn't exist, then add it
            if (!Schema::hasColumn('akun', 'membership_start')) {
                $table->timestamp('membership_start')->nullable()->after('role');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akun', function (Blueprint $table) {
            if (Schema::hasColumn('akun', 'membership_start')) {
                $table->dropColumn('membership_start');
            }
        });
    }
};
