<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Thêm timestamps vào bảng products
        Schema::table('products', function (Blueprint $table) {
            $table->timestamps(); // tạo 2 cột created_at và updated_at
        });

        // ... thêm các bảng khác của bạn ở đây
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropTimestamps();
        });

        // ... xóa cho các bảng khác
    }
};
