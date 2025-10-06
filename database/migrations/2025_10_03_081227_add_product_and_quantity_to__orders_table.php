<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Orders', function (Blueprint $table) {
            // Thêm product_id
            if (!Schema::hasColumn('Orders', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('user_id');
            }

            // Thêm quantity
            if (!Schema::hasColumn('Orders', 'quantity')) {
                $table->integer('quantity')->default(1)->after('product_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('Orders', function (Blueprint $table) {
            if (Schema::hasColumn('Orders', 'product_id')) {
                $table->dropColumn('product_id');
            }
            if (Schema::hasColumn('Orders', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });
    }
};
