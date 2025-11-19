<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gambar_suplemen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suplemen_id')->constrained('suplemen')->onDelete('cascade');
            $table->string('path');
            $table->string('img_alt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete all image files from storage before dropping the table
        if (Schema::hasTable('gambar_suplemen')) {
            $images = DB::table('gambar_suplemen')->get();
            foreach ($images as $image) {
                if ($image->path && Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
            }
        }

        Schema::dropIfExists('gambar_suplemen');
    }
};
