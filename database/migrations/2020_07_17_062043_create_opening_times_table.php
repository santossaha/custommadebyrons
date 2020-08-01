<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeningTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('mon_to_fri_opening')->nullable();
            $table->time('mon_to_fri_closing')->nullable();
            $table->time('opening_sat')->nullable();
            $table->time('closing_sat')->nullable();
            $table->time('opening_sun')->nullable();
            $table->time('closing_sun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opening_times');
    }
}
