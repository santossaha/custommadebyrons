<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11)->nullable();
            $table->string('order_id')->nullable();
            $table->string('total_amount')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('shipping_charge')->nullable();
            $table->string('message')->nullable();
            $table->integer('order_status')->length(11)->nullable();
            $table->enum('order_type',['online','cod'])->nullable();
            $table->string('token')->nullable();
            $table->string('Payer_id')->nullable();
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
        Schema::dropIfExists('order_status');
    }
}
