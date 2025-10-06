<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('product_id'); // 👈 xóa cột
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('product_id')->nullable(); // 👈 rollback sẽ thêm lại
        });
    }
};
