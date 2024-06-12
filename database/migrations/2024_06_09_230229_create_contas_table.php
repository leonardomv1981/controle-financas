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
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('id_categoria')->constrained('categoriagastos');
            $table->integer('id_conta_pai')->nullable();
            $table->enum('tipo', ['recorrente', 'eventual']);
            $table->decimal('valor', 10, 2);
            $table->string('descricao');
            $table->enum('pago', ['sim', 'nao']);
            $table->enum('situacao', ['ativo', 'inativo'])->default('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas');
    }
};
