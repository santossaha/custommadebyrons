<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11)->nullable();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',100)->nullable();
            $table->longText('company_name')->nullable();
            $table->longText('address_one')->nullable();
            $table->longText('address_two')->nullable();
            $table->integer('country')->length(11)->nullable();
            $table->integer('state')->length(11)->nullable();
            $table->string('city',100)->nullable();
            $table->integer('pincode')->length(11)->nullable();
            $table->integer('default_address')->length(11)->nullable();
            $table->enum('status', array('Active', 'Inactive'))->default('Inactive')->index();
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
        Schema::dropIfExists('user_address');
    }
}
