<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_kuisioner_stakeholder', function (Blueprint $table) {
            $table->id('id_kuisioner_stakeholder');
            $table->unsignedBigInteger('id_lulusan');
            $table->unsignedBigInteger('id_stakeholder');
            $table->enum('kerjasama_tim', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->enum('keahlian_it', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->enum('kemampuan_bahasa_asing', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->enum('kemampuan_komunikasi', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->enum('pengembangan_diri', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->enum('kepemimpinan', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->enum('etos_kerja', ['1', '2', '3', '4', '5'])->nullable(false);
            $table->string('kompetensi_yang_belum_dipenuhi', 255)->nullable(false);
            $table->string('saran_kurikulum_prodi', 255)->nullable(false);
            $table->timestamps();
            $table->foreign('id_lulusan')->references('id_lulusan')->on('t_lulusan')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_stakeholder')->references('id_stakeholder')->on('t_stakeholder')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_kuisioner_stakeholder');
    }
};