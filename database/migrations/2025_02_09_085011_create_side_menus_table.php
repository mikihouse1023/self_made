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
        Schema::create('side_menus', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 50);
            $table->string('val', 10);
            $table->text('explanation');
            $table->string('picture', 255);
            $table->string('genre', 15);
            $table->timestamps(); // created_at と updated_at を追加
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('side_menus');
    }
};
