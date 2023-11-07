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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_buku')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('rak')->nullable();
            $table->string('judul')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('isbn')->nullable();
            $table->string('jmlhal')->nullable();
            $table->string('jmlbuku')->nullable();
            $table->string('tahun')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
