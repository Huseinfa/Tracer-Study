<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_kuisioner_lulusan', function (Blueprint $table) {
            $table->id('id_kuisioner_lulusan');
            $table->unsignedBigInteger('id_lulusan');
            $table->unsignedBigInteger('id_kategori_profesi');
            $table->unsignedBigInteger('id_profesi');
            $table->date('tanggal_pertama_berkerja')->nullable(false);
            $table->date('tanggal_berkerja_instansi_sekarang')->nullable(false);
            $table->string('jenis_instansi', 25)->nullable(false);
            $table->string('skala_instansi', 15)->nullable(false);
            $table->string('nama_instansi', 30)->nullable(false);
            $table->string('lokasi_instansi', 255)->nullable(false);
            $table->string('nama_atasan', 100)->nullable(false);
            $table->string('jabatan_atasan', 30)->nullable(false);
            $table->string('email_atasan', 100)->nullable(false);
            $table->boolean('bersedia_mengisi')->nullable(false);
            $table->timestamps();
            $table->foreign('id_lulusan')->references('id_lulusan')->on('t_lulusan')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_kategori_profesi')->references('id_kategori_profesi')->on('t_kategori_profesi')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_profesi')->references('id_profesi')->on('t_profesi')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_kuisioner_lulusan');
    }
};