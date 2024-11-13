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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID użytkownika, który złożył odpowiedź
            $table->foreignId('challenge_id')->constrained()->onDelete('cascade'); // ID zadania, do którego należy odpowiedź
            $table->string('submitted_answer'); // Odpowiedź złożona przez użytkownika
            $table->timestamp('submitted_at'); // Czas złożenia odpowiedzi
            $table->boolean('is_correct')->default(false); // Informacja, czy odpowiedź jest poprawna
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
