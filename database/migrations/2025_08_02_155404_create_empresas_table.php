<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('empresas', function (Blueprint $table) {
            $table->string('cnpj')->primary();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('telefone');
            $table->foreignId('endereco_id')->constrained('enderecos')->onDelete('cascade');
            $table->string('inscricao_estadual');
            $table->date('data_abertura');
            $table->string('porte');
            $table->string('email');
            $table->string('regime_tributario');
            $table->string('cnae');
            $table->boolean('optante_mei');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('empresas');
    }
};
