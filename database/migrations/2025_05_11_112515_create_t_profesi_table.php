<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_profesi', function (Blueprint $table) {
            $table->id('id_profesi');
            $table->unsignedBigInteger('id_kategori_profesi');
            $table->string('nama_profesi', 30)->nullable(false);
            $table->timestamps();
            $table->foreign('id_kategori_profesi')->references('id_kategori_profesi')->on('t_kategori_profesi')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_profesi');
    }
};