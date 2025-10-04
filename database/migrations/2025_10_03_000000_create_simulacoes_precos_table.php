<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('simulacoes_precos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')
                  ->nullable()
                  ->constrained('produtos')
                  ->nullOnDelete();

            $table->decimal('preco_custo', 15, 2);
            $table->decimal('frete', 15, 2)->default(0);
            $table->decimal('outras_despesas', 15, 2)->default(0);

            $table->decimal('icms', 5, 4)->default(0);   // 0.1800 = 18%
            $table->decimal('pis', 5, 4)->default(0);
            $table->decimal('cofins', 5, 4)->default(0);

            $table->decimal('margem_lucro', 5, 4)->default(0.00); // alvo
            $table->enum('margem_calculo', ['markup', 'margin'])->default('markup');

            $table->enum('tipo_simulacao', ['promocao','oferta','baixar_preco','aumentar_lucro'])->nullable();

            $table->decimal('preco_sugerido', 15, 2)->nullable();
            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('simulacoes_precos');
    }
};
