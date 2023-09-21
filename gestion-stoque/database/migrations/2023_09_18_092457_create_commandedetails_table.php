<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandedetails', function (Blueprint $table) {
            $table->id();
            $table->String('product');
            $table->unsignedBigInteger('commande_id');
            $table->foreign('product')->references('name')->on('products')->onDelete('cascade');
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
