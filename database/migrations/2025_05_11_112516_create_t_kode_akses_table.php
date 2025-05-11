<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_kode_akses', function (Blueprint $table) {
            $table->id('id_kode');
            $table->unsignedBigInteger('id_lulusan');
            $table->unsignedBigInteger('id_stakeholder');
            $table->string('kode', 6)->nullable(false);
            $table->boolean('is_used')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('id_lulusan')->references('id_lulusan')->on('t_lulusan')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('id_stakeholder')->references('id_stakeholder')->on('t_stakeholder')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_kode_akses');
    }
};