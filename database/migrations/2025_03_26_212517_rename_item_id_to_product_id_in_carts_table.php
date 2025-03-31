<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('carts', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->renameColumn('item_id', 'product_id');
        });
    }
    
    public function down()
    {
        Schema::table('carts', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->renameColumn('product_id', 'item_id');
        });
    }
    
};
