<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_stakeholder', function (Blueprint $table) {
            $table->id('id_stakeholder');
            $table->unsignedBigInteger('id_lulusan')->nullable(false);
            $table->string('nama_atasan', 100)->nullable(false);
            $table->string('jabatan_atasan', 25)->nullable(false);
            $table->string('email_atasan', 50)->nullable(false);
            $table->string('kode_atasan', 6)->nullable();
            $table->boolean('sudah_mengisi')->nullable(false);
            $table->timestamps();

            $table->foreign('id_lulusan')->references('id_lulusan')->on('t_lulusan')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_stakeholder');
    }
};