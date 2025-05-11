<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('t_user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username', 30)->nullable(false);
            $table->string('nama_user', 100)->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_user');
    }
};