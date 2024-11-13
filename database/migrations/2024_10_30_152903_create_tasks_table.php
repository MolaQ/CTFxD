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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')->constrained()->onDelete('cascade'); // Powiązanie z konkursem
            $table->string('title'); // Tytuł zadania
            $table->text('description')->nullable(); // Opis zadania
            $table->string('solution'); // Oczekiwane rozwiązanie
            $table->integer('points')->default(0); // Punkty za zadanie
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
