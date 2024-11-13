<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tytuł zadania
            $table->text('description'); // Opis zadania
            $table->string('answer'); // Odpowiedź na zadanie
            $table->timestamp('available_from')->useCurrent();; // Czas, kiedy zadanie jest dostępne
            $table->timestamp('available_until')->useCurrent();; // Czas, kiedy zadanie przestaje być dostępne
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
