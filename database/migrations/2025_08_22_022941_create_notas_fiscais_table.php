<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 15);
            $table->string('serie', 5)->nullable();
            $table->date('data_emissao')->nullable();

            $table->string('cnpj_dest', 14)->nullable(); // somente dígitos
            $table->string('fornecedor_cnpj', 14);       // FK → fornecedores.cnpj

            $table->decimal('valor_total', 12, 2)->default(0);
            $table->decimal('frete', 12, 2)->nullable()->default(0);
            $table->decimal('outras_despesas', 12, 2)->nullable()->default(0);

            $table->string('chave_acesso', 44)->nullable()->unique();
            $table->enum('status', ['rascunho','lancada','cancelada'])->default('rascunho');
            $table->date('data_entrada')->nullable();
            $table->enum('tipo', ['entrada','saida'])->default('entrada');

            $table->text('observacao')->nullable();
            $table->timestamps();

            $table->index(['numero', 'serie']);
            $table->index('fornecedor_cnpj');
            $table->foreign('fornecedor_cnpj')->references('cnpj')->on('fornecedores');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas_fiscais');
    }
};
