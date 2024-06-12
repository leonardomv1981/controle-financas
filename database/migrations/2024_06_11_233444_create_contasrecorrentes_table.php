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
        Schema::create('contasrecorrentes', function (Blueprint $table) {
            $table->id();
            $table->integer('dia_vencimento');
            $table->foreignId('id_categoria')->constrained('categoriagastos');
            $table->decimal('valor', 10, 2);
            $table->string('descricao');
            $table->date('ultimo_pagamento')->nullable();
            $table->enum('situacao', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contasrecorrentes');
    }
};
