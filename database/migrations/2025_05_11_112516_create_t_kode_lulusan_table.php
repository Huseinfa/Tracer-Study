<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_kode_lulusan', function (Blueprint $table) {
            $table->id('id_kode_lulusan');
            $table->string('email', 60)->nullable(false);
            $table->string('kode_lulusan', 6)->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_kode_lulusan');
    }
};