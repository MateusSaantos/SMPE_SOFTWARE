<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->tinyInteger('origem_mercadoria')->default(0)->after('cofins');
            $table->decimal('aliquota_ipi', 5, 2)->default(0)->after('origem_mercadoria');
            $table->string('ipi_enquadramento', 3)->nullable()->after('aliquota_ipi');
            $table->integer('estoque_minimo')->default(0)->after('estoque');
        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn(['origem_mercadoria', 'aliquota_ipi', 'ipi_enquadramento', 'estoque_minimo']);
        });
    }
};
