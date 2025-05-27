<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_lulusan', function (Blueprint $table) {
            $table->id('id_lulusan');
            $table->unsignedBigInteger('id_program_studi');
            $table->string('nim', 15)->nullable(false);
            $table->string('nama_lulusan', 100)->nullable(false);
            $table->string('email', 25)->nullable(false);
            $table->string('nomor_hp', 20)->nullable(false);
            $table->date('tanggal_lulus')->nullable(false);
            $table->boolean('sudah_mengisi')->nullable(false);
            $table->timestamps();
            $table->foreign('id_program_studi')->references('id_program_studi')->on('t_program_studi')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_lulusan');
    }
};