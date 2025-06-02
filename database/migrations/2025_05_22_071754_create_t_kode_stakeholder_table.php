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
        Schema::create('t_kode_stakeholder', function (Blueprint $table) {
            $table->id('id_kode_stakeholder');
            $table->string('email', 60)->nullable(false);
            $table->string('kode_atasan', 6)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kode_stakeholder');
    }
};
