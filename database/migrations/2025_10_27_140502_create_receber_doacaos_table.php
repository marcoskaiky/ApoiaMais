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
        Schema::create('receber_doacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doador_id')->constrained('doadors')->onDelete('cascade');
            $table->foreignId('campanha_id')->nullable()->constrained('tipo_campanhas')->nullOnDelete();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receber_doacaos');
    }
};
