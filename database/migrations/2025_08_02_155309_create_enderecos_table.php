<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->string('uf', 2);
            $table->string('cidade');
            $table->string('bairro');
            $table->string('numero');
            $table->string('logradouro');
            $table->string('complemento')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('enderecos');
    }
};
