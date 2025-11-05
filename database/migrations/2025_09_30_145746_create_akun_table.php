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
        Schema::create('akun', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('password');
            $table->string('email');
            $table->string('no_telp');
            $table->enum('jenis_kelamin', ['LAKI-LAKI', 'PEREMPUAN']);
            $table->enum('role', ['PENGUNJUNG', 'MEMBER', 'TRAINER', 'ADMIN']);
            $table->dateTime('membership_end')->nullable();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
