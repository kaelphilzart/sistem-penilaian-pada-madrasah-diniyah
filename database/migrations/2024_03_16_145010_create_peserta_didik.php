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
        Schema::create('peserta_didik', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tahun');
            $table->string('kode_peserta');
            $table->string('nama_peserta');
            $table->string('alamat_peserta');
            $table->date('ttl_peserta');
            $table->integer('no_hp_peserta');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_didik');
    }
};
