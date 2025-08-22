<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('codigo_barras', 14)->nullable()->unique(); // EAN/UPC (8–14 dígitos)

            // chaves para categoria e ncm, nos nomes solicitados
            $table->unsignedBigInteger('categoria_produto'); // -> categorias.id
            $table->unsignedBigInteger('ncm');               // -> ncms.id

            $table->decimal('margem_lucro', 5, 2)->default(0); // %
            $table->string('cest', 7)->nullable();             // 7 dígitos
            $table->string('unidade_medida', 10)->default('UN');

            $table->decimal('preco_custo', 12, 2)->default(0);
            $table->decimal('preco_venda', 12, 2)->default(0);
            $table->integer('estoque')->default(0);

            $table->decimal('icms', 5, 2)->default(0);   // %
            $table->decimal('pis', 5, 2)->default(0);    // %
            $table->decimal('cofins', 5, 2)->default(0); // %
            $table->boolean('ativo')->default(true);

            $table->timestamps();

            $table->index(['descricao']);
            $table->index(['categoria_produto']);
            $table->index(['ncm']);

            $table->foreign('categoria_produto')->references('id')->on('categorias');
            $table->foreign('ncm')->references('id')->on('ncms');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
