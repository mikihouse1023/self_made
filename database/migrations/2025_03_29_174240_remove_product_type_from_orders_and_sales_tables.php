<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('product_type')->nullable(); // 必要に応じて型・nullableなど調整
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->string('product_type')->nullable();
        });
    }
};
