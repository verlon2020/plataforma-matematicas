<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('module');    // 'geometry','trig','ar','karnaugh','logic', etc.
            $table->string('exercise');  // 'cube-basic','sine-graph', etc.
            $table->unsignedInteger('score')->default(0); // 0/1 o puntaje
            $table->json('data')->nullable();             // parámetros/resultados
            $table->timestamps();

            // Si quieres evitar duplicados del mismo ejercicio por usuario, descomenta:
            // $table->unique(['user_id','module','exercise']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('attempts');
    }
};
