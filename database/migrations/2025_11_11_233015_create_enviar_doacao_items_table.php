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
        Schema::create('enviar_doacao_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enviar_doacao_id')->constrained('enviar_doacaos')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('quantidade')->default(1);
            $table->date('validade')->nullable();
            $table->decimal('tamanho_valor', 10, 2)->nullable();
            $table->string('tamanho_unidade', 10)->nullable();
            $table->string('tamanho_texto')->nullable();
            $table->string('condicao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enviar_doacao_items');
    }
};
