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
        Schema::create('user_interests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('interest'); // naturaleza, comida_tipica, historia, etc.
            $table->timestamps();

            // Relación con usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Índice único: un usuario no puede tener el mismo interés duplicado
            $table->unique(['user_id', 'interest']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interests');
    }
};
