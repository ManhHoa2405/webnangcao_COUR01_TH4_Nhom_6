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
        Schema::create('Products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->string('category', 100)->nullable();
            $table->string('name', 150);
            $table->decimal('price', 12);
            $table->string('image_url')->nullable();
            $table->enum('status', ['available', 'not available'])->nullable()->default('available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Products');
    }
};
