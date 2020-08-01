<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code')->nullable();
            $table->integer('category_id')->length(11)->nullable();
            $table->integer('sub_cat_id')->length(11)->nullable();
            $table->integer('brand_id')->length(11)->nullable();
            $table->integer('new_arrival')->length(11)->nullable();
            $table->integer('latest_collection')->length(11)->nullable();
            $table->integer('best_selling')->length(11)->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_alias')->nullable();
            $table->float('price')->nullable();
            $table->integer('discount')->length(11)->nullable();
            $table->longText('description')->nullable();
            $table->string('warranty')->nullable();
            $table->enum('status', array('Active', 'Inactive'))->default('Active')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
