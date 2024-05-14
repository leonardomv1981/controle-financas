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
        Schema::create('movimentacaocartoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cartao')->constrained('cartoes');
            $table->foreignId('id_categoria')->constrained('categoriagastos');
            $table->date('data');
            $table->decimal('valor', 10, 2);
            $table->date('mes_referencia');
            $table->string('descricao');
            $table->enum('parcelado', ['sim', 'nao']);
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
        Schema::dropIfExists('movimentacaocartoes');
    }
};
