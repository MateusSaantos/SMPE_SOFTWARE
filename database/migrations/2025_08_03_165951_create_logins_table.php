<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj');
            $table->string('email')->unique();
            $table->string('senha');
            $table->timestamps();

            $table->foreign('cnpj')->references('cnpj')->on('empresas')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('logins');
    }
};
