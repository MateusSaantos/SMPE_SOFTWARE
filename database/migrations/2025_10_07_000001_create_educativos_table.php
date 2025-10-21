<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('educativos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();               // url estável
            $table->string('titulo');                      // título
            $table->text('descricao')->nullable();         // descrição/resumo
            $table->longText('conteudo')->nullable();      // corpo (markdown/HTML)
            $table->json('links')->nullable();             // [{titulo,url},...]
            $table->string('categorias')->nullable();      // CSV: "cnpj,tributacao,precos"
            $table->text('condicao_exibicao')->nullable(); // opcional (texto ou JSON)
            $table->boolean('visivel')->default(true);     // liga/desliga global
            $table->boolean('visitado')->default(false);   // flag global simples
            $table->enum('status', ['rascunho','publicado','arquivado'])->default('publicado');
            $table->integer('ordem')->default(0)->index(); // ordenação manual
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('educativos'); }
};
