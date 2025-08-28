<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nota_fiscal_itens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nota_fiscal_id');

            // Campos solicitados
            $table->decimal('quantidade', 12, 3);
            $table->decimal('valor_unitario', 12, 2);

            $table->unsignedBigInteger('ncm'); // FK → ncms.id
            $table->string('cest', 7)->nullable();
            $table->decimal('icms', 5, 2)->default(0);
            $table->decimal('pis', 5, 2)->default(0);
            $table->decimal('cofins', 5, 2)->default(0);

            $table->timestamps();

            $table->foreign('nota_fiscal_id')->references('id')->on('notas_fiscais')->onDelete('cascade');
            $table->foreign('ncm')->references('id')->on('ncms');
            $table->index(['nota_fiscal_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_fiscal_itens');
    }
};
