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
    Schema::table('orders', function (Blueprint $table) {
        $table->unsignedBigInteger('product_id')->nullable()->after('user_id');

        // Nếu muốn ràng buộc khóa ngoại tới bảng products:
        // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('product_id');

        // Nếu có foreign key thì xóa thêm:
        // $table->dropForeign(['product_id']);
    });
}

};
