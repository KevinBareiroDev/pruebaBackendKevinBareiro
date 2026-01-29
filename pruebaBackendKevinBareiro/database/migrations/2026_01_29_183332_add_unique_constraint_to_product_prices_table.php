<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Agrega un constraint único compuesto para garantizar que un producto
     * solo pueda tener un precio por moneda.
     * 
     * Requisitos: MySQL 5.6+ / MariaDB 10.0+ (compatible con Laravel 12)
     */
    public function up(): void
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->unique(['product_id', 'currency_id'], 'product_currency_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->dropUnique('product_currency_unique');
        });
    }
};
