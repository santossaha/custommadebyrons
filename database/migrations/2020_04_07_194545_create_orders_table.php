<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11)->nullable();
            $table->string('order_id')->nullable();
            $table->integer('product_id')->length(11)->nullable();
            $table->integer('billing_id')->length(11)->nullable();
            $table->integer('shipping_id')->length(11)->nullable();
            $table->string('product_code',100)->nullable();
            $table->string('product_name',255)->nullable();
            $table->string('product_alias',255)->nullable();
            $table->float('product_price')->nullable();
            $table->integer('quantity')->length(11)->nullable();
            $table->float('total_price')->nullable();
            $table->float('original_price')->nullable();
            $table->integer('discount')->length(11)->nullable();
            $table->string('product_image',255)->nullable();
            $table->enum('status', array('Active', 'Inactive'))->default('Active')->index();
            $table->integer('payment_mode')->length(11)->nullable();
            $table->integer('order_status')->length(11)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
