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
            $table->string('nama_atasan', 100)->nullable(false);
            $table->string('instansi', 100)->nullable(false);
            $table->string('jabatan', 25)->nullable(false);
            $table->string('email', 50)->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_stakeholder');
    }
};