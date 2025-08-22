<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ncms', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 8)->unique();  // 8 dígitos
            $table->string('descricao');
            $table->timestamps();

            $table->index('descricao');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ncms');
    }
};
