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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Powiązanie z użytkownikiem
            $table->foreignId('task_id')->constrained()->onDelete('cascade'); // Powiązanie z zadaniem
            $table->string('response'); // Odpowiedź użytkownika
            $table->boolean('is_correct')->default(false); // Czy odpowiedź jest poprawna
            $table->float('points', 4, 3)->default(0); // Czy odpowiedź jest poprawna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
