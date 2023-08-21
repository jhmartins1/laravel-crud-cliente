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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11)->unique();
            $table->string('nome');
            $table->date('data_nascimento');
            $table->enum('sexo', ['masculino', 'feminino'])->nullable();
            $table->string('endereco')->nullable();
            $table->string('estado');
            $table->string('cidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
