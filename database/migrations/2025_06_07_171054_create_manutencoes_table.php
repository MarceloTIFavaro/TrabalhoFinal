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
        Schema::create('manutencoes', function (Blueprint $table) {
            $table->id();
            // Define a chave estrangeira para a tabela 'equipamentos'
            // onDelete('cascade') garante que, ao deletar um equipamento, suas manutenções relacionadas também sejam deletadas.
            $table->foreignId('equipamento_id')->constrained('equipamentos')->onDelete('cascade');
            $table->date('data_manutencao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutencoes');
    }
};