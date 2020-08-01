<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultipleColumnToCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
           $table->string('product_code',100)->nullable();
           $table->string('product_name',255)->nullable();
           $table->string('product_alias',255)->nullable();
           $table->float('product_price')->nullable();
           $table->float('total_price')->nullable();
           $table->float('original_price')->nullable();
           $table->integer('discount')->length(11)->nullable();
           $table->string('product_image',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
             $table->dropColumn(['product_code',  'product_name', 'product_alias','product_price','total_price','original_price','discount','product_image']);
        });
    }
}
