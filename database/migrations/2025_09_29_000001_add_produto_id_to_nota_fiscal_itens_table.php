<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('nota_fiscal_itens', function (Blueprint $table) {
            // Se a tabela já tem dados, mantenha como nullable para migração segura
            $table->unsignedBigInteger('produto_id')->nullable()->after('nota_fiscal_id');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->index('produto_id');
        });
    }

    public function down(): void
    {
        Schema::table('nota_fiscal_itens', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropIndex(['produto_id']);
            $table->dropColumn('produto_id');
        });
    }
};
