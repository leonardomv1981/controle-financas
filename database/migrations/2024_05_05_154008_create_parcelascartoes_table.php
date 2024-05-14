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
        Schema::create('parcelascartoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cartao')->constrained('cartoes');
            $table->date('data_inicial');
            $table->date('data_final');
            $table->integer('valor');
            $table->integer('valor_parcela');
            $table->integer('quantidade_parcelas');
            $table->integer('parcelas')->nullable();
            $table->enum('situacao', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelascartoes');
    }
};
