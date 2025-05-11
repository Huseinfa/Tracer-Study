<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_kategori_profesi', function (Blueprint $table) {
            $table->id('id_kategori_profesi');
            $table->string('nama_kategori', 20)->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_kategori_profesi');
    }
};