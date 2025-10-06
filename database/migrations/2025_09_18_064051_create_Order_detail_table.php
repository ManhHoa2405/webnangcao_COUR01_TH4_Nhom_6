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
        Schema::create('Order_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('order_id')->index('order_id');
            $table->integer('product_id')->index('id');
            $table->string('product_name', 150)->nullable();
            $table->decimal('product_price', 12)->nullable();
            $table->integer('quantity');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Order_detail');
    }
};
