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
        Schema::create('useraddress', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('homeAddress');
            $table->unsignedInteger('province_id')->nullable()->index('province_id');
            $table->unsignedInteger('district_id')->nullable()->index('id');
            $table->unsignedInteger('ward_id')->nullable()->index('ward_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('useraddress');
    }
};
