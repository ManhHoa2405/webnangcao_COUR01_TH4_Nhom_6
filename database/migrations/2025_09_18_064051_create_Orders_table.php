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
        Schema::create('Orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('fk_orders_user');
            $table->decimal('total_amount', 12)->default(0);
            $table->enum('status', ['new', 'paid', 'cancelled'])->nullable()->default('new');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Orders');
    }
};
