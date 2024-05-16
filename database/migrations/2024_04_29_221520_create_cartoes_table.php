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
        Schema::create('cartoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('id_banco')->constrained('bancos');
            $table->foreignId('id_bandeira')->constrained('bandeiras');
            $table->integer('dia_vencimento');
            $table->date('fatura_atual')->nullable();
            $table->enum('situacao', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartoes');
    }
};
