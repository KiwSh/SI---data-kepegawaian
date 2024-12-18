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
        Schema::create('profile_perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');       // Kolom Nama Perusahaan
            $table->string('alamat');     // Kolom Alamat
            $table->string('bidang');     // Kolom Bidang
            $table->timestamps();         // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_perusahaans');
    }
};