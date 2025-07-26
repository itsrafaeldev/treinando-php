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
        Schema::create('regras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
        });

        Schema::create('regras_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId(column: 'id_user')->references('id')->on('users');
            $table->foreignId(column: 'id_regra')->references('id')->on('regras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regras');
        Schema::dropIfExists('regras_users');
    }
};
