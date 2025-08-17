<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->string('cnpj', 14)->primary(); // apenas dígitos
            $table->string('razao_social', 160);
            $table->string('nome_fantasia', 160)->nullable();
            $table->string('inscricao_estadual', 30)->nullable();
            $table->string('telefone', 20)->nullable();

            $table->foreignId('endereco_id')
                  ->constrained('enderecos') // mesma tabela já usada por empresa
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
